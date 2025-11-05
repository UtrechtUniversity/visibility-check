<?php

/**
 * Derived from: https://raw.githubusercontent.com/Svish/php-cross-domain-proxy/master/proxy.php
 *
 *
 * @param whitelist
 * @param curl_opts
 * @param zlib
 */


/***
 * Config
 *
 */

define('API_URL', 'http://localhost:9000/api/index.php');

// Include for debugging
include_once __DIR__ . '/inc/helpers.php';

/**
 * Allowed origin: string
 * ex: http://localhost:3000/
 */
$allowedOrigin = 'http://localhost:3000';

/*
 * Proxy = true
 * only use this value in development in case you use a Socks5 proxy
 * or another type of proxy
 * Modify the $proxy as needed
 */
$proxy = 'localhost:8088';
$enable_proxy = $_GET['proxy'] ?? false;

// The url of the target API
$url     = API_URL;

// List of resources that are allowed to be used
$allowedResources = ['/questions', '/user', '/user/answer', '/user/score', '/test/url'];

$extra_headers = [
    'Access-Control-Allow-Origin' => 'http://localhost:3000/'
];


// Get normalized headers and such
$headers  = array_change_key_case(getallheaders());
$method   = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$cookie   = $headers['x-proxy-cookie'] ?? null;
$resource = $_GET['resource'] ?? null;


// Check that we have a URL
if( ! $url)
    failure(400, "No api url defined, read the docs!");

// Check that the URL looks like an absolute URL
if( ! parse_url($url, PHP_URL_SCHEME))
    failure(400, "Not an absolute URL: $url");

if( ! $resource)
    failure(400, "No resource specified");


// Check whitelist, if not empty
if( ! in_array($resource, $allowedResources))
    failure(403, "Resource $resource not allowed");


// Remove ignored headers
$ignore = [
    'cookie',
    'content-length',
    'host',
    'x-proxy-url',
    'x-proxy-cookie',
];
$headers = array_diff_key($headers, array_flip($ignore));



// Set proxied cookie if we got one
if($cookie)
    $headers['Cookie'] = $cookie;

// Format headers for curl
foreach($headers as $key => &$value)
    $value = ucwords($key, '-').": $value";

//echo '<pre>';
//print_r($headers);
//die();


// Init curl
$curl = curl_init();
$maxredirs = $opts[CURLOPT_MAXREDIRS] ?? 20;
do
{
    // Set options
    curl_setopt_array($curl,
        [
            CURLOPT_URL => $url . $resource,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_HEADER => true,
        ]
        + ($curl_opts ?? []) +
        [
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS => $maxredirs,
        ]);

    // Method specific options
    switch($method)
    {
        case 'HEAD':
            curl_setopt($curl, CURLOPT_NOBODY, true);
            break;

        case 'GET':
            break;

        case 'PUT':
        case 'POST':
        case 'DELETE':
        default:
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
            curl_setopt($curl, CURLOPT_POSTFIELDS, file_get_contents('php://input'));
            break;
    }

    // enable socks5 proxy for local development
    if ($enable_proxy) {
        curl_setopt($curl, CURLOPT_PROXY, $proxy);
        curl_setopt($curl, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
    }

    // Perform request
    ob_start();
    curl_exec($curl);
    $out = ob_get_clean();

    // Light error handling
    if(curl_errno($curl))
        switch(curl_errno($curl))
        {
            // Connect timeout => Service Unavailable
            case 7:
                failure(503, $curl);

            // Operation timeout => Gateway Timeout
            case 28:
                failure(504, $curl);

            // Other errors => Service Unavailable
            default:
                failure(503, $curl);
        }

    // HACK: Workaround if not following, which happened once...
    $url = curl_getinfo($curl, CURLINFO_REDIRECT_URL);
}
while($url and --$maxredirs > 0);



// Get curl info and close handler
$info = curl_getinfo($curl);
curl_close($curl);



// Remove any existing headers
header_remove();

// Use zlib, if acceptable
ini_set('zlib.output_compression', $zlib ?? 'On');

// Get content and headers
$content = substr($out, $info['header_size']);
$headers = substr($out, 0, $info['header_size']);

// Rename Set-Cookie header
$headers = preg_replace('/^Set-Cookie:/im', 'X-Proxy-Set-Cookie:', $headers);

// Output headers
foreach(explode("\r\n", $headers) as $h)
    // HACK: Prevent chunked encoding issues (Issue #1)
    if( ! preg_match('/^Transfer-Encoding:/i', $h))
        header($h, false);

// HACK: Prevent gzip issue (Issue #1)
header('Content-Length: '.strlen($content), true);

// Access control
if($allowedOrigin) {
    header("Access-Control-Allow-Origin: $allowedOrigin");
}

// Output content
echo $content;


function failure(int $status, $text)
{
    if(is_resource($text))
        $text = sprintf('[%s] %s', curl_errno($text), curl_error($text));
    http_response_code($status);
    header("X-Proxy-Curl-Error: $text");
    exit($text);
}


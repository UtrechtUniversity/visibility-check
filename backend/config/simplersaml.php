<?php

return [
    // Configured SP name that this application will use
    'sp' => env('SIMPLESAMLPHP_SP_NAME'),

    // Configured IDP to authenticate against
    'idp' => env('SIMPLESAMLPHP_SP_IDP'),

    // User Model to use for easy saml attribute mapping
    'model' => 'App\Models\UU\SamlUser',

    // Enable the built in routes for saml authentication (default: true)
    'enableRoutes' => true,

    // Prefix for saml login/logout routes ie saml => host.com/saml/login and host.com/saml/logout
    'routePrefix' => 'saml',

    // Location to redirect to after login
    'loginRedirect' => '/',

    // Location to redirect to after logout
    'logoutRedirect' => '/saml/login',

    // Path to simplesaml installation
    'spPath' => '/var/www/html/simplesamlphp',

    // path to simplesaml configuration
    'simpleSamlConfigDir' => '/var/www/html/simplesamlphp/config',
];

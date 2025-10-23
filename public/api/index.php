<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../includes/helpers.php';
use Symfony\Component\Yaml\Yaml;

header('Access-Control-Allow-Origin: http://localhost:3000');
//header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,PUT,POST,DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Cache-control, Authorization');
header('Access-Control-Allow-Credentials: true');

header('Content-Type: application/json');

// Leggi il file YAML


$config = Yaml::parseFile(__DIR__ .'/questions.yaml');

// Converti l'array PHP in JSON
$json = json_encode($questions, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

// Stampa il JSON
echo $json;


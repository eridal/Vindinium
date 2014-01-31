<?php

ini_set('display_errors', 1);
error_reporting(E_ALL | E_STRICT);

$loader = require 'vendor/autoload.php';
$loader->add('', 'bots/');
$loader->register(true);

if (count($argv) < 1) {
    echo "USAGE: {$argv[0]} bot-class [key-file]\n";
    echo "ie: {$argv[0]} Bots\\Random key.txt\n";
    exit;
}

if (!class_exists($class = $argv[1])) {
    $file = strtr($class, '\\', '/');
    echo "Class not found: bots/$file.php is missing\n";
    exit;
}

if (count($argv) < 2) {
    $argv[2] = 'key.txt';
}

if (false === $key = file_get_contents($argv[2])) {
    exit;
}

$client = new Vindinium\Client(new $class, $key);
$state = $client->createGame();

do {
    $state = $client->play(
        $bot->getAction($state, new ActionBuilder())
    );
    sleep(10);
} while ($state->game->hasTurns());

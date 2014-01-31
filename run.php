<?php

ini_set('display_errors', 1);
error_reporting(E_ALL | E_STRICT);

$loader = require 'vendor/autoload.php';
$loader->add('', __DIR__);
$loader->register(true);

if (count($argv) < 1) {
    echo "USAGE: {$argv[0]} bot-class [key-file]\n";
    echo "ie: {$argv[0]} Bots\\Random key.txt\n";
    exit;
}

if (is_file($file = $argv[1])) {
    include $file;
    $class = strtr(substr($file, 0, -4), '/', '\\');
    do {
        if (class_exists($class, false)) {
            break;
        }
    } while ($class = substr($class, strpos($class, '\\')));
} else {
    $class = $argv[1];
}

if (!$class or !class_exists($class)) {
    echo "ERROR: unable to find class: {$argv[1]}\n";
    exit;
}

if (empty($argv[2])) {
    $argv[2] = 'key.txt';
}


if (false === $key = file_get_contents($argv[2])) {
    exit;
}

$client = new Vindinium\Client($key);
$action = new Vindinium\Action();
$robot = new $class;
$state = $client->createGame();

echo "Game Created";
exec("firefox --new-tab {$state->viewUrl}");

do {

    try {
        $robot->play($state, $action);
    } catch(\Exception $e) {
        echo $e, PHP_EOL;
    }

    $state = $client->send($state->playUrl, $action);

    echo ($state->game->turn % 25) === 0 ? ".\n" : ".";

} while ($state->game->hasTurns());

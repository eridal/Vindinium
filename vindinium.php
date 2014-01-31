<?php

namespace Vindinium;

ini_set('display_errors', 1);
error_reporting(E_ALL | E_STRICT);

$loader = require 'vendor/autoload.php';
$loader->add('', getcwd());
$loader->register(true);

if (count($argv) < 1) {
    echo <<<EOT
USAGE: {$argv[0]} bot-class
Examples:
> php {$argv[0]} Bots\\Random
> php {$argv[0]} path/to/Bots/Random.php

EOT;
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

$robot = new $class;

if (!($robot instanceof Robot)) {
    echo "ERROR: class $class must implement Vindinium\\Robot\n";
    exit;
}

$client = new Client($robot->key());
$action = new Action();
$state = $client->createGame();

echo "Game Created: {$state->viewUrl}\n";
exec("firefox --new-tab {$state->viewUrl}");

do {

    try {
        $robot->play($state, $action);
    } catch(\Exception $e) {
        echo $e, PHP_EOL;
    }

    $state = $client->send($state->playUrl, $action);

} while ($state->game->hasTurns() and !$state->hero->crashed);

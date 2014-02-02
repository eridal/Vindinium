<?php

namespace Vindinium;

ini_set('display_errors', 1);
error_reporting(E_ALL | E_STRICT);

if (count($argv) < 2) {
    echo <<<EOT
USAGE: {$argv[0]} bot-class
Examples:
> php {$argv[0]} Bots\\Random
> php {$argv[0]} path/to/Bots/Random.php

EOT;
    exit;
}

$composer = require 'vendor/autoload.php';
$loader = new Client\Loader($composer, getcwd());

try {
    $robot = $loader->findRobot($argv[1]);
} catch(\Exception $error) {
    $message = $error->getMessage();
    exit ("ERROR: {$message}\n");
}

do {
    $match = new Client\Match($robot);

    echo "Match Created: {$match} - ", date('r'), PHP_EOL;
    exec("firefox --new-tab {$match}");

    while (!$match->finished()) {
        if ($match->play()) {
            break;
        }
    }

    echo "Match Finished - ", date('r'), PHP_EOL;

} while (true);

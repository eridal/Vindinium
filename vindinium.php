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

$robot = $loader->findRobot($argv[1]);
echo "Robot: ", get_class($robot), PHP_EOL;

try {
    start:
    $start = time();
    $match = new Client\Match($robot);

    echo "Playing $match\n";
    exec("firefox --new-tab $match");

    while (!$match->finished()) {
        $match->play();
    }

    $finish = time() - $start;

    echo "Winner is {$match->winner()}\n",
         "Match took {$match->state->game->turn} turns, $finish seconds\n";

    // goto start;

} catch(\Exception $error) {
    exit ("ERROR: {$error->getMessage()}\n");
}

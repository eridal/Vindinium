<?php

namespace Vindinium\Client;

use Vindinium\Robot;

use Prelude\Check;
use Prelude\Files;

class Loader {

    /**
     * @var Composer
     */
    private $composer;

    /**
     * @param Composer $composer
     * @param string $path
     */
    function __construct($composer, $path) {
        $this->composer = $composer;
        $this->path = $path;
    }

    /**
     * @param string $path
     * @return string
     */
    function findRobot($pathOrClass) {

        if (is_file($pathOrClass)) {
            list($class, $root) = $this->splitPath($pathOrClass);
            $this->composer->add('', $root);
            $this->composer->register(true);
        } else {
            $class = $pathOrClass;
        }

        return $this->newRobot($class);
    }

    /**
     * Return the
     *
     * example: "src/Ns/Class.inc.php" => array("Ns\Class",  "src/")
     *
     * @param string $path [description]
     * @return array [string class, string path]
     */
    private function splitPath($path) {
        // This section became litle cryptic, so lets go slowly..

        // 1. include the class, as we will avoid autoloaders
        include $path;

        // 2. let's pretend `$path` is a `$class`
        $class = $this->toClassName($path);

        // 3. $class still contains fragments of path?
        while ($class and !class_exists($class, false)) {
            // on failure.. remove until the next namespace separator
            $class = substr($class, strpos($class, '\\') + 1);
        }

        if ($class) {
            // 4. success!!
            $root = substr($path, 0, strrpos($path, strtr($class, '\\', '/')));
            // we believe `$class` is stored at `$root`, using psr-0 style
            return array($class, $root);
        }

        // well.. seems like `$class` is not using psr-0 style
        throw new ClientException("unable to detect class at $path");
    }

    /**
     * @param string $class
     * @return Robot
     */
    private function newRobot($Class) {

        Check::argument(
            $Class and class_exists($Class),
            new ClientException("Robot class not found: $Class")
        );

        $robot = new $Class;

        if ($robot instanceof Robot) {
            return $robot;
        }

        throw new ClientException("class $Class is not a Vindinium\\Robot");
    }


    /**
     * @param string $path
     * @return string
     */
    private function toClassName($path) {

        // 1. remove the extension(s)
        // ie: "src/Robot.inc.php" => "src/Robot"
        while ($extension = Files::type($path)) {
            $path = substr($path, 0, -1 * (strlen($extension) + 1)); # +1 to include '.'
        }

        // 2. change path into Namespace\\Class
        //
        // we can't diferentiate between file path and namespaces fragments
        // so we assume it all belongs to the namespace
        //
        // example: "src/Vindinium/Client.php" => "src\\Vindinium\\Client"
        return strtr($path, '/', '\\');
    }
}

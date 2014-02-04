# Vindinium

  Four legendary heroes were fighting for the land of Vindinium
  Making their way in the dangerous woods
  Slashing goblins and stealing gold mines
  And looking for a tavern where to drink their gold

**Vindinium** is an Artificial Intelligence programming challenge. You have to take the control of a *legendary hero* using the programming language of your choice. You will fight with other AI for a predetermined number of turns and the hero with the *greatest amount of gold* will win.


# Install and Run

Download and install using [Composer](https://packagist.org/packages/eridal/vindinium)

1. Install Composer:
    ```sh
    curl -s https://getcomposer.org/installer | php
    ```

1. Add Vindinium as a dependency to your `composer.json`
    ```json
    {
        "require": {
            "eridal/vindinium": "master-dev"
        }
    }
    ```

1. Install
    ```
    php composer.phar install
    ```

1. Execute your Robot
    ```
    php vendor/bin/vindinium.php path/to/RobotClass.php
    ```

# Robots

1. Register your robot at [vindinium](http://vindinium.org/register).
    > Tip: Use one key per robot, or stats will be shared.

1. Create a class, and implement the [Robot](https://github.com/eridal/Vindinium/blob/master/src/Robot.php) interface

## Getting Started
```php
/**
 * This hero will randomly move
 */
class Random implements \Vindinium\Robot {

    /**
     * Robots's secret key.
     *
     * Secret as in "Keep. It. Secret."
     *
     * @return string
     */
    function secretKey() {
        return "<your-secret-key-here>";
    }

    /**
     * Your robot logic goes here
     *
     * On each turn this method will be called with the game `$state`
     * for you to decide what to do next.
     */
    function play(\Vindinium\State $state, \Vindinium\Move $to) {
        $to->random();
    }
}
```


# Feedback
Yes, please!

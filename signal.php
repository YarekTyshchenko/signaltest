#!/usr/bin/php
<?php
// tick use required as of PHP 4.3.0
declare(ticks = 1);
// signal handler function
function sig_handler($signo)
{
     switch ($signo) {
        case SIGINT:
            echo "Interrupted via terminal".PHP_EOL;
            exit;
            break;
         case SIGTERM:
            // handle shutdown tasks
            echo "Caught SIGTERM".PHP_EOL;
            echo "Shutting down in 20 seconds".PHP_EOL;
            $c = 20;
            while ($c--) {
                echo $c.PHP_EOL;
                sleep(1);
            }
            exit;

            break;
        case SIGHUP:
            echo "Caught SIGHUP".PHP_EOL;
            break;
         default:
            // handle all other signals
            echo "Caught signal ".$signo.PHP_EOL;
            break;
     }

}

echo "Installing signal handler...\n";

// setup signal handlers
pcntl_signal(SIGTERM, "sig_handler");
pcntl_signal(SIGINT, "sig_handler");
pcntl_signal(SIGHUP, "sig_handler");

// or use an object, available as of PHP 4.3.0
// pcntl_signal(SIGUSR1, array($obj, "do_something"));

while (true) {
    echo '.'.PHP_EOL;
    sleep(1);
}
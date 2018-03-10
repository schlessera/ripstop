#!/usr/bin/env php
<?php namespace Ripstop;

/**
 * If we're running from phar load the phar autoload file.
 */
$pharPath = \Phar::running(true);
if ($pharPath) {
    require_once "$pharPath/vendor/autoload.php";
} else {
    if (file_exists(__DIR__ . '/vendor/autoload.php')) {
        require_once __DIR__ . '/vendor/autoload.php';
    } elseif (file_exists(__DIR__ . '/../../autoload.php')) {
        require_once __DIR__ . '/../../autoload.php';
    }
}

use Robo\Robo;

$input       = new \Symfony\Component\Console\Input\ArgvInput($argv);
$output      = new \Symfony\Component\Console\Output\ConsoleOutput();
$config      = Robo::createConfiguration(['ripstop.yml']);
$app         = new Ripstop($config, $input, $output);
$status_code = $app->run($input, $output);
exit($status_code);

#!/usr/bin/env php
<?php

foreach (array(__DIR__ . '/../../../autoload.php', __DIR__ . '/../vendor/autoload.php', __DIR__ . '/vendor/autoload.php') as $file) {
    if (file_exists($file)) {
        define('COMPOSER_INSTALL', $file);

        break;
    }
}

unset($file);

if (!defined('COMPOSER_INSTALL')) {
    fwrite(STDERR,
        'You need to set up the project dependencies using the following commands:' . PHP_EOL .
        'wget http://getcomposer.org/composer.phar' . PHP_EOL .
        'php composer.phar install' . PHP_EOL
    );

    die(1);
}

require COMPOSER_INSTALL;

$app = new NilPortugues\BackslashFixer\Application;
$app->runWithTry($argv);

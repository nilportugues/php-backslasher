<?php

require __DIR__ . '/../vendor/autoload.php';

$app = new NilPortugues\BackslashFixer\Application;
$app->runWithTry($argv);

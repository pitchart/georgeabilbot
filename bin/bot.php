#!/usr/bin/env php
<?php
require __DIR__.'/../vendor/autoload.php';
use Symfony\Component\Console\Application;
$application = new Application('George Abilbot', '0.1~dev');
$application->run();

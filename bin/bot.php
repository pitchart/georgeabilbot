#!/usr/bin/env php
<?php
require __DIR__.'/../vendor/autoload.php';
use Pitchart\GeorgeAbilbot\Application;
use Pitchart\GeorgeAbilbot\Command;
use Symfony\Component\DependencyInjection\ContainerBuilder;

$container = new ContainerBuilder();

$application = (new Application('George Abilbot', '0.1~dev'))
    ->setContainer($container)
;

$application->addCommands([
    new Command\Info(),
    new Command\Bot(),
]);
$application->setDefaultCommand('info');
$application->run();

#!/usr/bin/env php
<?php
require __DIR__.'/../vendor/autoload.php';
use Pitchart\GeorgeAbilbot\Application;
use Pitchart\GeorgeAbilbot\Command;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

$container = new ContainerBuilder();
$loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../config/'));
$loader->load('parameters.yml');
$loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../config/'));
$loader->load('services.xml');

$container->compile();

$application = (new Application('George Abilbot', '0.1~dev'))
    ->setContainer($container)
;

$application->addCommands([
    new Command\Info(),
    new Command\Test(),
    new Command\Bot(),
]);
$application->setDefaultCommand('info');
$application->run();

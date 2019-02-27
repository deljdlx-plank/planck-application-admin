<?php

define('PLK_CURRENT_PATH', getcwd());
define('PLK_APPLICATION_FILEPATH_ROOT', realpath(__DIR__.'/..'));


$planckApplicationBootstrap = require(__DIR__.'/../bootsrap.php');

if(!isset($argv[1])) {
    throw new Exception('You must specify an existing path for build');
}

$deployDestination = $argv[1];

if(!is_dir($deployDestination)) {
    throw new Exception('Path "'.$deployDestination.'" does not exist. You must create this folder manualy');
}


$applicationRegistry = new \Planck\Application\ApplicationRegistry();

/**
 * @var $application \PlanckeyBlog\Application
 */
$application = $applicationRegistry->buildApplication(realpath(__DIR__.'/..'), \PlanckeyBlog\Application::class);
$application->initialize();


$builder = new \Planck\ApplicationBuilder\Builder($application);
$builder->build($deployDestination);



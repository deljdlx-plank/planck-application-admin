<?php

define('PLK_CURRENT_PATH', getcwd());
define('PLK_APPLICATION_FILEPATH_ROOT', realpath(__DIR__));


$planckApplicationBootstrap = require(__DIR__.'/bootstrap.php');



chdir(realpath(__DIR__.'/..'));




$applicationRegistry = new \Planck\Application\ApplicationRegistry();

/**
 * @var $application \PlanckeyBlog\Application
 */
$application = $applicationRegistry->buildApplication(__DIR__, \PlanckeyBlog\Application::class);




$application->initialize();



$application->run();



$application->sendHeaders();
echo $application->render();


chdir(PLK_CURRENT_PATH);





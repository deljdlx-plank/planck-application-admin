<?php

define('PLK_CURRENT_PATH', getcwd());
define('PLK_APPLICATION_FILEPATH_ROOT', realpath(__DIR__.'/..'));

/**
 * @var PlanckApplicationBootstrap $planckApplicationBootstrap
 */
$planckApplicationBootstrap = require(__DIR__.'/../bootsrap.php');
$planckApplicationBootstrap->buildSymlinks();




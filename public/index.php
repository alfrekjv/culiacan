<?php

ini_set('display_errors', 1);

// All relative paths start from the main directory, not from /public/
chdir(dirname(__DIR__));

// Lets include PPI
include('app/init.php');
include('app/siteManager.php');

// Initialise our PPI App
$sm  = new SiteManager();
$app = new PPI\App();

$config                           = include($sm->getConfigFile());
$config['datasource.connections'] = include($sm->getDataSource());

$app->moduleConfig = include($sm->getModuleConfig());
$app->config       = $config;

//$app->moduleConfig = include 'app/modules.config.php';
//$app->config = include 'app/app.config.php';

// Do you want twig engine enabled?
//$app->templatingEngine = 'twig';

// If you are using the DataSource component, enable this
$app->useDataSource = true;
$app->boot()->dispatch();
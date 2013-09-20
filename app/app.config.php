<?php
$config = array(
    'environment'            => 'development',
    'templating.engines'     => array('php'),
    'templating.globals'     => array
    (
        'ga_tracking' => 'UA-XXXXX-X'
    ),
    'datasource.connections' => ''
);

// Are we in debug mode ?
if ($config['environment'] !== 'development') {
    $config['debug']     = $config['environment'] === 'development';
    $config['cache_dir'] = __DIR__ . '/cache';
}
return $config; // Very important

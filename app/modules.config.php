<?php
return array(
    'activeModules'   => array(
        'Framework',
        'Application',
        'UserModule',
        'AdminModule',
        'ContactModule'
    ),
    'listenerOptions' => array(
        'module_paths'   => array('./modules'),
        'routingEnabled' => true
    ),
);
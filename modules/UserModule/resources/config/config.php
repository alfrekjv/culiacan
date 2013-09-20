<?php
$config = array();

$config['emailConfig'] = array(
    'firstname' => '',
    'lastname'  => '',
    'email'     => '@'
);

$config['adminEmailConfig'] = array(
    'firstname' => '',
    'lastname'  => '',
    'email'     => '@'
);

$config['signupEmail']            = array('subject' => 'Activa tu cuenta.');
$config['forgotEmail']            = array('subject' => 'Solicita nuevo password.');
$config['authSalt']               = 'x92lEU;f4-H=21]mD;e8qw]3A$Fv#^mi';
$config['user_avatar_upload_dir'] = 'public/uploads/gallery/';

// hybridath
$config['hybridauth'] = array(
    'base_url'  => 'http://culiacan.cloudadmin.mx/user/social/endpoint',
    'providers' => array(
        'Twitter'  => array(
            'enabled' => true,
            'keys'    => array(
                'key'    => '',
                'secret' => ''
            )
        ),
        'Facebook' => array(
            'enabled' => true,
            'keys'    => array(
                'id'     => '',
                'secret' => ''
            ),
            'scope'   => 'email'
        )
    )
);

return $config;
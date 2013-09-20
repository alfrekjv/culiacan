<?php
$config = array(
    'menuMap' => array(
        'Home'            => array(
            'Admin_Index'
        ),
        'User_Management' => array(
            'Admin_Users_Index',
            'Admin_User_Create',
            'Admin_User_Edit'
        )
    )
);

$config['slider_upload_dir']         = 'store/uploads/sliders/';
$config['distribuidores_upload_dir'] = 'store/uploads/distribuidores/';

return $config;
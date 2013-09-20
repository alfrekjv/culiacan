<?php
namespace UserModule;

use PPI\Module\Module as BaseModule;
use PPI\Autoload;

class Module extends BaseModule
{
    protected $_moduleName = 'UserModule';

    public function init($e)
    {
        Autoload::add(__NAMESPACE__, dirname(__DIR__));
    }
    
    /**
     * Get the configuration for this module
     *
     * @return array
     */
    public function getConfig()
    {
        return include(__DIR__ . '/resources/config/config.php');
    }

    /**
     * Get the routes for this module
     *
     * @return \Symfony\Component\Routing\RouteCollection
     */
    public function getRoutes()
    {
        return $this->loadYamlRoutes(__DIR__ . '/resources/config/routes.yml');
    }
    
    public function getServiceConfig()
    {
        return array('factories' => array(
            
            'user.storage' => function($sm) {
                 return new \UserModule\Storage\User($sm->get('datasource'));
             },
            
            'user.security' => function($sm) {
                $us = new \UserModule\Classes\UserSecurity();
                $us->setSession($sm->get('session'));
                $us->setUserStorage($sm->get('user.storage'));
                $us->setConfig($sm->get('config'));
                return $us;
            },
            
            'user.security.templating.helper' => function($sm) {
                return new \UserModule\Classes\UserSecurityTemplatingHelper($sm->get('user.security'));
            },

            'user.account.helper' => function($sm) {
                $config = $sm->get('config');
                $helper = new \UserModule\Classes\AccountHelper();
                $helper->setUploadPath(realpath($config['user_avatar_upload_dir']));
                return $helper;
            },

            'hybridauth' => function($sm) {
                require_once getcwd() . '/vendor/hybridauth/Hybrid/Auth.php';

                $conf   = $sm->get('config');
                $social = $conf['hybridauth'];

                return new \Hybrid_Auth($social);
            },

            'social.signup.cache' => function($sm) {
                return new \Doctrine\Common\Cache\ApcCache();
            }
            
        ));
    }



}

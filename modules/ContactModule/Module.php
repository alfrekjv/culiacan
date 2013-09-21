<?php
namespace ContactModule;

use PPI\Module\Module as BaseModule,
    PPI\Autoload;

class Module extends BaseModule
{
    protected $_moduleName = 'ContactModule';

    public function init($e)
    {
        Autoload::add(__NAMESPACE__, dirname(__DIR__));
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

    /**
     * Get the configuration for this module
     *
     * @return array
     */
    public function getConfig()
    {
        return $this->loadYamlConfig(__DIR__ . '/resources/config/config.yml');
    }
    
    public function getServiceConfig()
    {
        return array('factories' => array(
            
            'contact.helper' => function($sm) {
                $config = $sm->get('config');
                $helper = new \ContactModule\Classes\ContactHelper();
                $helper->setConfig($config['contact']);
                return $helper;
            },
            'email.helper' => function($sm) {
                return new \ContactModule\Classes\EmailHelper();
            }
            
        ));
    }

}

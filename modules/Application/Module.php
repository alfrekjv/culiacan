<?php
namespace Application;

use PPI\Module\RoutesProviderInterface,
    PPI\Module\Module as BaseModule,
    PPI\Autoload,
    PPI\Module\Service;

class Module extends BaseModule
{
    protected $_moduleName = 'Application';

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
        return include(__DIR__ . '/resources/config/config.php');
    }
    
    public function getServiceConfig()
    {

        return array('factories' => array(

            'email.helper' => function($sm) {
                return new \Application\Classes\Email();
            },

            'lugar.storage' => function($sm) {
                return new \Application\Storage\Lugar($sm->getService('datasource'));
            },

            'necesidad.storage' => function($sm) {
                return new \Application\Storage\Necesidad($sm->getService('datasource'));
            },

            'noticia.storage' => function($sm) {
                return new \Application\Storage\Noticia($sm->getService('datasource'));
            },

            'persona.storage' => function($sm) {
                return new \Application\Storage\Persona($sm->getService('datasource'));
            },

            'municipios.storage' => function($sm) {
                return new \Application\Storage\Municipios($sm->getService('datasource'));
            },

            'colonias.storage' => function($sm) {
                return new \Application\Storage\Colonias($sm->getService('datasource'));
            }

        ));
    }

}

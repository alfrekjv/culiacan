<?php
namespace ContactModule\Controller;

use PPI\Module\Controller as BaseController;

class Shared extends BaseController
{

    /**
     * Render a template
     *
     * @param  string $template The template to render
     * @param  array  $params   The params to pass to the renderer
     * @param  array  $options  Extra options
     * @return string
     */
    protected function render($template, array $params = array(), array $options = array())
    {
        return parent::render($template, $params, $options);
    }

    public function createResponse($data)
    {
        $this->getService('response')->headers->set('Content-type', 'application/json');

        return json_encode($data);
    }

    protected function getUser()
    {
        return $this->getService('user.security')->getUser();
    }
    
    protected function isLoggedIn()
    {
        return $this->getService('user.security')->isLoggedIn();
    }
    
}
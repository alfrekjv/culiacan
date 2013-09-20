<?php
namespace AdminModule\Controller;

use PPI\Module\Controller as BaseController;
use AdminModule\Entity\User as UserEntity;
use AdminModule\Entity\AuthUser as AuthUserEntity;

class Shared extends BaseController
{

    /**
     * Get the config options for emailing
     * 
     * @return mixed
     */
    protected function getEmailConfig()
    {
        $config = $this->getConfig();
        return $config['emailConfig'];
    }

    /**
     *
     * Returns an Slug of a given string.
     *
     * @param $str The String
     *
     * @return string The Slug
     */
    public function slug($str)
    {

        $str = trim($str);
        $str = preg_replace('/[^a-z0-9-]/i', '', $str);
        $str = preg_replace('/-+/', "", $str);

        return strtolower($str);
    }

    /**
     *
     * Returns an excerpt from a string..
     *
     * @param $content The full content.
     *
     * @return string The excerpt
     */
    public function excerpt($content)
    {
        return substr($content, 0, 140);
    }

    /**
     * Set the user's auth object into the session
     * 
     * @param \UserModule\Entity\AuthUser $data
     */
    protected function setAuthData(\UserModule\Entity\AuthUser $data)
    {
        $this->getSession()->login('ppiAuthUser', $data);
    }

    /**
     * Get the user's auth object from the session
     * 
     * @throws \Exception If the auth user object doesn't exist
     */
    protected function getAuthData() {
        return $this->getService('user.security')->getUser();
    }
    
    protected function isLoggedIn()
    {
        return $this->getService('user.security')->isLoggedIn();
    }

    /**
     * Get the logged in user object
     */
    protected function getUser()
    {
        return $this->getAuthData();
    }
    

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
        $options['helpers'][] = $this->getService('user.security.templating.helper');
        $options['helpers'][] = $this->getMenuTemplatingHelper();
        $this->addTemplateGlobal('activeRouteName', $this->helper('routing')->getActiveRouteName());
        return parent::render($template, $params, $options);
    }

    /**
     * Get the menu templating helper
     * 
     * @return mixed
     */
    protected function getMenuTemplatingHelper()
    {
        $helper = $this->getService('menu.templating.helper');
        $helper->setActiveRouteName($this->helper('routing')->getActiveRouteName());
        return $helper;
    }

    /**
     * Add a template global variable
     * 
     * @param string $param
     * @param mixed $value
     */
    protected function addTemplateGlobal($param, $value)
    {
        $this->getService('templating')->addGlobal($param, $value);
    }
    
    protected function isAdmin() {
        return $this->isLoggedIn() && in_array($this->getService('user.security')->getUser()->getLevelTitle(), array('Administrator', 'Developer'));
    }

    /**
     * Get the user salt from the config
     *
     * @return mixed
     */
    protected function getConfigSalt()
    {
        $config = $this->getConfig();
        return $config['authSalt'];
    }
    
}
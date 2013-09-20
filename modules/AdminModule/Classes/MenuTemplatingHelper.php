<?php
namespace AdminModule\Classes;

use Symfony\Component\Templating\Helper\Helper as BaseHelper;

class MenuTemplatingHelper extends BaseHelper {
    
    protected $activeRoute;
    protected $activeParam;
    protected $routesMap;
    protected $map;
    
    public function __construct()
    {
        
    }
    
    public function setMap($map)
    {
        $this->map = $map;
    }

    /**
     * Check if this key is exactly the active route
     * 
     * @param $key
     * @return bool
     */
    public function is($key, $param = '')
    {
        return $this->activeRoute === $key && $this->activeParam === $param;
    }

    /**
     * Check if the specified
     * 
     * @param $currentKey
     * @return bool
     */
    public function isActive($currentKey)
    {
        foreach($this->map as $section => $keys) {
            if(in_array($this->activeRoute, $keys) && $currentKey === $section) {
                return true;
            }
        }
        return false;
    }
    
    public function setActiveRouteName($name, $param = '')
    {
        $this->activeRoute = $name;
        $this->activeParam = $param;
    }
    
    
    public function getName()
    {
        return 'menu';
    }
    
}
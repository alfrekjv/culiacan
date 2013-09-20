<?php

class SiteManager
{

    protected $_configFile = null;
    protected $_dataSource  = null;
    protected $_moduleConfig = null;

    function __construct(array $options = array())
    {
        $this->_configFile      = 'app/app.config.php';
        $this->_moduleConfig    = 'app/modules.config.php';

        switch ($_SERVER['SERVER_NAME']) {

            case 'culiacan.cloudadmin.mx':
                $this->_dataSource      = 'app/connections/production.config.php';
                break;
            case 'localhost':
            default:
                $this->_dataSource      = 'app/connections/local.config.php';
                break;
        }
    }

    public function setConfigFile($configFile)
    {
        $this->_configFile = $configFile;
    }

    public function getConfigFile()
    {
        return $this->_configFile;
    }

    public function setDataSource($dataSource)
    {
        $this->_dataSource = $dataSource;
    }

    public function getDataSource()
    {
        return $this->_dataSource;
    }

    public function setModuleConfig($moduleConfig)
    {
        $this->_moduleConfig = $moduleConfig;
    }

    public function getModuleConfig()
    {
        return $this->_moduleConfig;
    }

}
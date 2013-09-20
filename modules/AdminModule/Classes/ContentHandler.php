<?php

namespace AdminModule\Classes;

use AdminModule\Entity\User as UserEntity;

class ContentHandler {
    
    protected $_contentStorage = '';
    
    public function __construct()
    {
        
    }
    
    public function setStorage($storage)
    {
        $this->_contentStorage = $storage;
    }

}
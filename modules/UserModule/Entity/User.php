<?php

namespace UserModule\Entity;

class User
{

    protected $_id = null;
    protected $_first_name = null;
    protected $_last_name = null;
    protected $_user = null;
    protected $_email = null;
    protected $_password = null;
    protected $_status = null;
    protected $_salt = null;
    protected $_level = null;
    protected $_created_by = null;
    protected $_modified_by = null;

    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, '_' . $key)) {
                $this->{'_' . $key} = $value;
            }
        }
    }

    public function setCreatedBy($created_by)
    {
        $this->_created_by = $created_by;
    }

    public function getCreatedBy()
    {
        return $this->_created_by;
    }

    public function setFirstName($first_name)
    {
        $this->_first_name = $first_name;
    }

    public function getFirstName()
    {
        return $this->_first_name;
    }

    /**
     * @param int|null $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->_id;
    }

    public function setLastName($last_name)
    {
        $this->_last_name = $last_name;
    }

    public function getLastName()
    {
        return $this->_last_name;
    }

    public function setModifiedBy($modified_by)
    {
        $this->_modified_by = $modified_by;
    }

    public function getModifiedBy()
    {
        return $this->_modified_by;
    }

    public function setPassword($password)
    {
        $this->_password = $password;
    }

    public function getPassword()
    {
        return $this->_password;
    }

    public function setStatus($status)
    {
        $this->_status = $status;
    }

    public function getStatus()
    {
        return $this->_status;
    }

    public function setUser($user)
    {
        $this->_user = $user;
    }

    public function getUser()
    {
        return $this->_user;
    }

    public function getUsername()
    {
        return $this->_user;
    }

    public function getLevelTitle()
    {
        $title = '';

        switch ($this->getLevel()) {
            case 1:
                $title = 'Administrator';
                break;
            case 2:
                $title = 'Developer';
                break;
            case 3:
                $title = 'User';
                break;
        }

        return $title;
    }

    public function setEmail($email)
    {
        $this->_email = $email;
    }

    public function getEmail()
    {
        return $this->_email;
    }

    public function setLevel($level)
    {
        $this->_level = $level;
    }

    public function getLevel()
    {
        return $this->_level;
    }

    public function setSalt($salt)
    {
        $this->_salt = $salt;
    }

    public function getSalt()
    {
        return $this->_salt;
    }

    public function getFullName()
    {
        return $this->_first_name . " " . $this->_last_name;
    }

}

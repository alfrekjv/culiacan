<?php

namespace UserModule\Entity;

class User
{

    protected $_id = null;
    protected $_user_level_id = null;
    protected $_first_name = null;
    protected $_last_name = null;
    protected $_user = null;
    protected $_email = null;
    protected $_password = null;
    protected $_salt = null;

    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, '_' . $key)) {
                $this->{'_' . $key} = $value;
            }
        }
    }

    public function getUsername()
    {
        return $this->getUser();
    }

    public function getLevelTitle()
    {
        $title = '';

        switch ($this->getUserLevelId()) {
            case 1:
                $title = 'Admin';
                break;
            case 2:
                $title = 'Developer';
                break;
            case 3:
                $title = 'Usuario';
                break;
        }

        return $title;
    }

    public function getFullName()
    {
        return $this->_first_name . " " . $this->_last_name;
    }

    /**
     * @param null $email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * @return null
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param null $first_name
     */
    public function setFirstName($first_name)
    {
        $this->_first_name = $first_name;
    }

    /**
     * @return null
     */
    public function getFirstName()
    {
        return $this->_first_name;
    }

    /**
     * @param null $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * @return null
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param null $last_name
     */
    public function setLastName($last_name)
    {
        $this->_last_name = $last_name;
    }

    /**
     * @return null
     */
    public function getLastName()
    {
        return $this->_last_name;
    }

    /**
     * @param null $password
     */
    public function setPassword($password)
    {
        $this->_password = $password;
    }

    /**
     * @return null
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * @param null $salt
     */
    public function setSalt($salt)
    {
        $this->_salt = $salt;
    }

    /**
     * @return null
     */
    public function getSalt()
    {
        return $this->_salt;
    }

    /**
     * @param null $user
     */
    public function setUser($user)
    {
        $this->_user = $user;
    }

    /**
     * @return null
     */
    public function getUser()
    {
        return $this->_user;
    }

    /**
     * @param null $user_level_id
     */
    public function setUserLevelId($user_level_id)
    {
        $this->_user_level_id = $user_level_id;
    }

    /**
     * @return null
     */
    public function getUserLevelId()
    {
        return $this->_user_level_id;
    }

}

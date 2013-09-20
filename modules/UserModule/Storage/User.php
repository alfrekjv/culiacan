<?php
namespace UserModule\Storage;

use UserModule\Storage\Base as BaseStorage;
use UserModule\Entity\User as UserEntity;

class User extends BaseStorage
{
    protected $_meta = array(
        'conn'      => 'main',
        'table'     => 'user',
        'primary'   => 'id',
        'fetchMode' => \PDO::FETCH_ASSOC
    );

    /**
     * Find a user record by its ID
     *
     * @param $userID
     *
     * @return mixed
     */
    public function findByID($userID)
    {
        return $this->find($userID);
    }

    /**
     * Get a user entity by its ID
     *
     * @param $userID
     *
     * @return mixed
     * @throws \Exception
     */
    public function getByID($userID)
    {
        $row = $this->find($userID);
        if ($row === false) {
            throw new \Exception('Unable to obtain user row for id: ' . $userID);
        }

        return new UserEntity($row);

    }

    public function findWithLevelByEmail($email)
    {

        $row = $this
            ->createQueryBuilder()
            ->select('u.*, ul.title user_level_title')
            ->from($this->getTableName(), 'u')
            ->andWhere('u.email = :email')
            ->setParameter(':email', $email)
            ->leftJoin('u', 'user_level', 'ul', 'u.user_level_id = ul.id')
            ->execute()
            ->fetch($this->getFetchMode());

        if ($row === false) {
            throw new \Exception('Invalid User Row');
        }

        return $row;
    }

    /**
     * Find a user record by the email
     *
     * @param  string $email
     *
     * @return mixed
     */
    public function findByEmail($email)
    {
        return $this
            ->createQueryBuilder()
            ->select('u.*')
            ->from($this->getTableName(), 'u')
            ->andWhere('u.email = :email')
            ->setParameter(':email', $email)
            ->execute()
            ->fetch($this->getFetchMode());
    }

    /**
     * Find a user record by the email
     *
     * @param  string $email
     *
     * @return mixed
     */
    public function findByUsername($user)
    {
        return $this
            ->createQueryBuilder()
            ->select('u.*')
            ->from($this->getTableName(), 'u')
            ->andWhere('u.user = :user')
            ->setParameter(':user', $user)
            ->execute()
            ->fetch($this->getFetchMode());
    }

    public function getAllWithLevels()
    {

        $entities = array();
        $rows     = $this
            ->createQueryBuilder()
            ->select('u.*, ul.title user_level_title')
            ->from($this->getTableName(), 'u')
            ->leftJoin('u', 'user_level', 'ul', 'u.user_level_id = ul.id')
            ->execute()
            ->fetchAll($this->getFetchMode());

        foreach ($rows as $row) {
            $entities[] = new UserEntity($row);
        }

        return $entities;

    }

    /**
     * Get a user entity by the email address
     *
     * @param  string $email
     *
     * @return UserEntity
     * @throws \Exception
     */
    public function getByEmail($email)
    {
        $row = $this->findByEmail($email);

        if ($row === false) {
            throw new \Exception('Unable to find user record by email: ' . $email);
        }

        return new UserEntity($row);

    }

    /**
     * Get a user entity by username
     *
     * @param  string $user
     *
     * @return UserEntity
     * @throws \Exception
     */
    public function getByUsername($user)
    {
        $row = $this
            ->createQueryBuilder()
            ->select('u.*')
            ->from($this->getTableName(), 'u')
            ->andWhere('u.user = :user')
            ->setParameter(':user', $user)
            ->execute()
            ->fetch($this->getFetchMode());

        if ($row === false) {
            throw new \Exception('Unable to find user record by user: ' . $user);
        }

        return new UserEntity($row);

    }

    /**
     * Check if a user record exists by email address
     *
     * @param $email
     *
     * @return bool
     */
    public function existsByEmail($email)
    {
        $row = $this
            ->createQueryBuilder()
            ->select('count(id) as total')
            ->from($this->getTableName(), 'u')
            ->andWhere('u.email = :email')
            ->setParameter(':email', $email)
            ->execute()
            ->fetch($this->getFetchMode());

        return $row['total'] > 0;
    }

    /**
     * Check if a user record exists by user
     *
     * @param $email
     *
     * @return bool
     */
    public function existsByUsername($user)
    {
        $row = $this
            ->createQueryBuilder()
            ->select('count(id) as total')
            ->from($this->getTableName(), 'u')
            ->andWhere('u.user = :user')
            ->setParameter(':user', $user)
            ->execute()
            ->fetch($this->getFetchMode());

        return $row['total'] > 0;
    }

    /**
     * Check if a user record exists by User ID
     *
     * @param integer $id
     *
     * @return bool
     */
    public function existsByID($id)
    {
        $row = $this
            ->createQueryBuilder()
            ->select('count(id) as total')
            ->from($this->getTableName(), 'u')
            ->andWhere('u.id = :id')
            ->setParameter(':id', $id)
            ->execute()
            ->fetch($this->getFetchMode());

        return $row['total'] > 0;
    }

    public function getByProviderId($identifier)
    {

        $row = $this
            ->createQueryBuilder()
            ->select('u.*, usl.*')
            ->from($this->getTableName(), 'u')
            ->innerJoin('u', 'user_social_login', 'usl', 'usl.user_id = u.id')
            ->andWhere('usl.provider_id = :identifier')
            ->setParameter(':identifier', $identifier)
            ->execute()
            ->fetch($this->getFetchMode());

        return $row !== false ? new UserEntity($row) : array();
    }

    /**
     * Delete a user by their email address
     *
     * @param  string $email
     *
     * @return mixed
     */
    public function deleteByEmail($email)
    {
        return $this->delete(array('email' => $email));
    }

    /**
     * Delete a user by their id
     *
     * @param  string $id
     *
     * @return mixed
     */
    public function deleteByID($id)
    {
        return $this->delete(array('id' => $id));
    }

    /**
     * Create a user record
     *
     * @param  array $userData
     *
     * @return mixed
     */
    public function create(array $userData, $configSalt)
    {

        // Override the plaintext pass with the encrypted one 
        $userData['password'] = $this->saltPass($userData['salt'], $configSalt, $userData['password']);

        return $this->insert($userData);
    }

    public function updatePassword($userID, $userSalt, $configSalt, $password)
    {
        $this->update(array('password' => $this->saltPass($userSalt, $configSalt, $password)), array('id' => $userID));
    }

    /**
     * Salt the password
     *
     * @param string $userSalt
     * @param string $configSalt
     * @param string $pass
     *
     * @return string
     */
    function saltPass($userSalt, $configSalt, $pass)
    {
        return sha1($userSalt . $configSalt . $pass);
    }

    /**
     * Check the authentication fields to make sure things auth properly
     *
     * @param string $email
     * @param string $password
     * @param string $configSalt
     *
     * @return boolean
     */
    function checkAuth($user, $password, $configSalt)
    {

        $duser = $this->findByUsername($user);

        if (empty($duser)) {
            return false;
        }

        $encPass = $this->saltPass($duser['salt'], $configSalt, $password);
        $row     = $this->_conn
            ->createQueryBuilder()
            ->select('count(id) as total')
            ->from($this->getTableName(), 'u')
            ->andWhere('u.user = :user')
            ->andWhere('u.password = :password')
            ->setParameter(':user', $user)
            ->setParameter(':password', $encPass)
            ->execute()
            ->fetch($this->getFetchMode());

        return $row['total'] > 0;
    }

    /**
     * Verify a user by their email and password
     *
     * @param string $userSalt
     * @param string $configSalt
     * @param string $userEmail
     * @param string $password
     *
     * @return bool
     */
    public function verifyPassword($userSalt, $configSalt, $userEmail, $password)
    {

        $encPass = $this->saltPass($userSalt, $configSalt, $password);

        $row = $this->_conn
            ->createQueryBuilder()
            ->select('count(id) as total')
            ->from($this->getTableName(), 'u')
            ->andWhere('u.email = :email')
            ->andWhere('u.password = :password')
            ->setParameter(':email', $userEmail)
            ->setParameter(':password', $encPass)
            ->execute()
            ->fetch($this->getFetchMode());

        return $row['total'] > 0;

    }

    /**
     * Count all the records
     *
     * @return mixed
     */
    public function countAll()
    {
        $row = $this->_conn
            ->createQueryBuilder()
            ->select('count(id) as total')
            ->from($this->getTableName(), 'u')
            ->execute()
            ->fetch($this->getFetchMode());

        return $row['total'];

    }

    /**
     * Get entity objects from all users rows
     *
     * @return array
     */
    public function getAll()
    {
        $entities = array();
        $rows     = $this->fetchAll();
        foreach ($rows as $row) {
            $entities[] = new UserEntity($row);
        }

        return $entities;

    }

}

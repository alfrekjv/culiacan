<?php
namespace Application\Storage;

use Application\Storage\Base as BaseStorage;
use Application\Entity\Lugar as Entity;

class Lugar extends BaseStorage
{
    protected $_meta = array(
        'conn'    => 'main',
        'table'   => 'Lugar',
        'primary' => 'id',
        'fetchMode' => \PDO::FETCH_ASSOC
    );

    /**
     * Get a class entity by its ID
     *
     * @param $memberID
     * @return mixed
     * @throws \Exception
     */
    public function getByID($memberID)
    {
        $row = $this->find($memberID);
        if ($row === false) {
            throw new \Exception('Unable to obtain class row for id: ' . $memberID);
        }

        return new Entity($row);

    }

    /**
     * Delete a class by its primary key
     *
     * @param integer $memberID
     * @return mixed
     */
    public function deleteByID($memberID)
    {
        return $this->delete(array($this->getPrimaryKey() => $memberID));
    }

    /**
     * Check if a user record exists by User ID
     *
     * @param integer $id
     * @return bool
     */
    public function existsByID($id)
    {
        $row = $this->createQueryBuilder()
               ->select('count(id) as total')
               ->from($this->getTableName(), 'u')
               ->andWhere('u.id = :id')
               ->setParameter(':id', $id)
               ->execute()
               ->fetch($this->getFetchMode());

        return $row['total'] > 0;
    }

    /**
     * Create a member record
     *
     * @param string $name
     * @param string $bio
     * @param string $image
     * @return mixed
     */
    public function create($post)
    {
        return parent::insert($post);
    }


    /**
     * Get entity objects from all users rows
     *
     * @return array
     */
    public function getAll()
    {
        $entities = array();
        $rows     = $this->createQueryBuilder()
                    ->select('*')
                    ->from($this->getTableName(), 'c')
                    ->execute()
                    ->fetchAll($this->getFetchMode());

        foreach ($rows as $row) {
            $entities[] = new Entity($row);
        }

        return $entities;
    }

    public function getByType($type = 'albergue')
    {

        $entities = array();
        $rows     = $this->createQueryBuilder()
                    ->select('*')
                    ->from($this->getTableName(), 'l')
                    ->where("l.tipo = '{$type}'")
                    ->andWhere('l.status = 1')
                    ->execute()
                    ->fetchAll($this->getFetchMode());

        foreach ($rows as $row) {
            $entities[] = new Entity($row);
        }

        return $entities;
    }

    public function getAlbergues()
    {

        $entities = array();
        $rows     = $this->createQueryBuilder()
                    ->select('*')
                    ->from($this->getTableName(), 'l')
                    ->where("l.tipo = 'albergue'")
                    ->execute()
                    ->fetchAll($this->getFetchMode());

        foreach ($rows as $row) {
            $entities[] = new Entity($row);
        }

        return $entities;
    }

    public function getCentros()
    {

        $entities = array();
        $rows     = $this->createQueryBuilder()
                    ->select('*')
                    ->from($this->getTableName(), 'l')
                    ->where("l.tipo = 'centro de acopio'")
                    ->execute()
                    ->fetchAll($this->getFetchMode());

        foreach ($rows as $row) {
            $entities[] = new Entity($row);
        }

        return $entities;
    }

    public function getEvacuadas()
    {

        $entities = array();
        $rows     = $this->createQueryBuilder()
                    ->select('*')
                    ->from($this->getTableName(), 'l')
                    ->where("l.tipo = 'zona evacuada'")
                    ->execute()
                    ->fetchAll($this->getFetchMode());

        foreach ($rows as $row) {
            $entities[] = new Entity($row);
        }

        return $entities;
    }

    public function getAfectadas()
    {

        $entities = array();
        $rows     = $this->createQueryBuilder()
                    ->select('*')
                    ->from($this->getTableName(), 'l')
                    ->where("l.tipo = 'zona afectada'")
                    ->execute()
                    ->fetchAll($this->getFetchMode());

        foreach ($rows as $row) {
            $entities[] = new Entity($row);
        }

        return $entities;
    }

    public function getAgua()
    {

        $entities = array();
        $rows     = $this->createQueryBuilder()
                    ->select('*')
                    ->from($this->getTableName(), 'l')
                    ->where("l.tipo = 'agua potable'")
                    ->execute()
                    ->fetchAll($this->getFetchMode());

        foreach ($rows as $row) {
            $entities[] = new Entity($row);
        }

        return $entities;
    }

    /**
     * Get the total number of
     *
     * @return integer
     */
    public function countAll()
    {
        $row = $this->createQueryBuilder()
               ->select('count(id) as total')
               ->from($this->getTableName(), 'c')
               ->execute()
               ->fetch($this->getFetchMode());

        return $row['total'];
    }

}

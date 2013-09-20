<?php

namespace Application\Entity;

class Rating
{

    protected $_id = null;
    protected $_product_id = null;
    protected $_rate = null;
    protected $_created_at = null;
    protected $_modified_at = null;

    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, '_' . $key)) {
                $this->{'_' . $key} = $value;
            }
        }
    }

    public function setCreatedAt($created_at)
    {
        $this->_created_at = $created_at;
    }

    public function getCreatedAt()
    {
        return $this->_created_at;
    }

    public function setId($id)
    {
        $this->_id = $id;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function setModifiedAt($modified_at)
    {
        $this->_modified_at = $modified_at;
    }

    public function getModifiedAt()
    {
        return $this->_modified_at;
    }

    public function setProductId($product_id)
    {
        $this->_product_id = $product_id;
    }

    public function getProductId()
    {
        return $this->_product_id;
    }

    public function setRate($rate)
    {
        $this->_rate = $rate;
    }

    public function getRate()
    {
        return $this->_rate;
    }

}

<?php

namespace Application\Storage;

use PPI\DataSource\ActiveQuery;

class Base extends ActiveQuery
{

    public function getDataForSelect($field)
    {
        $data = array();
        $rows = $this->fetchAll($this->getFetchMode());

        foreach ($rows as $row) {
            $data[$row[$field]] = $row['id'];
        }

        return $data;
    }

}

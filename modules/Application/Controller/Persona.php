<?php
namespace Application\Controller;

use Application\Controller\Shared as SharedController;

class PErsona extends SharedController
{

    /**
     *
     * Returns all Places in a JSON format.
     *
     * @return JSON status, code and data.
     */
    public function getPersonasAction()
    {

        $storage = $this->getService('persona.storage');
        $data    = $storage->getAll();
        $map     = array();

        foreach ($data as $row) {
            $map[] = $row->toArray();
        }

        return $this->createResponse(
               array(
                    'status' => 'success',
                    'code'   => 'OK',
                    'data'   => $map
               )
        );
    }

    public function searchAction()
    {

        $map     = array();
        $post    = $this->post();
        $storage = $this->getService('persona.storage');
        $data    = $storage->getByKeyword($post['keyword']);

        foreach ($data as $row) {
            $map[] = $row->toArray();
        }

        return $this->createResponse(
            array(
                 'status' => 'success',
                 'code'   => 'OK',
                 'data'   => $map
            )
        );
    }

}

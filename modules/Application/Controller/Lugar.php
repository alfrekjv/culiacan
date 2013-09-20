<?php
namespace Application\Controller;

use Application\Controller\Shared as SharedController;

class Lugar extends SharedController
{

    /**
     *
     * Returns all Places in a JSON format.
     *
     * @return JSON status, code and data.
     */
    public function getLugaresAction()
    {

        $storage = $this->getService('lugar.storage');
        $lugares = $storage->getAll();

        $map = array();
        foreach ($lugares as $lugar) {
            $map[] = $lugar->toArray();
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

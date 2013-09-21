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
        $map     = array();

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

    public function getAlberguesAction()
    {

        $storage = $this->getService('lugar.storage');
        $lugares = $storage->getAlbergues();
        $map     = array();

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

    public function getCentrosAction()
    {

        $storage = $this->getService('lugar.storage');
        $lugares = $storage->getCentros();
        $map     = array();

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

    public function getEvacuadasAction()
    {

        $storage = $this->getService('lugar.storage');
        $lugares = $storage->getEvacuadas();
        $map     = array();

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

    public function getAfectadasAction()
    {

        $storage = $this->getService('lugar.storage');
        $lugares = $storage->getAfectadas();
        $map     = array();

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

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
        $lugares = $storage->getByType('albergue');
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
        $lugares = $storage->getByType('centro de acopio');
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
        $lugares = $storage->getByType('zona evacuada');
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
        $lugares = $storage->getByType('zona afectada');
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

    public function getAguaAction()
    {

        $storage = $this->getService('lugar.storage');
        $lugares = $storage->getByType('agua potable');
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

    public function reportarAction()
    {

        $storage      = $this->getService('lugar.storage');
        $post         = $this->post();
        $requiredKeys = array(
            'nombre', 'calle',
            'numero', 'colonia',
            'ciudad', 'estado'
        );

        // Check for missing fields, or fields being empty.
        foreach ($requiredKeys as $field) {
            if (!isset($post[$field]) || empty($post[$field])) {
                $missingFields[] = $field;
            }
        }

        if (!empty($missingFields)) {

            $resultado['msj']   = 'Debe llenar los campos.';
            $resultado['exito'] = FALSE;

            return $this->createResponse($resultado);
        }

        // Create the place
        if ($storage->create($post)) {
            $resultado['msj']   = 'Datos reportados correctamente.';
            $resultado['exito'] = TRUE;
        } else {
            $resultado['msj']   = 'Ocurrio un problema, no se realizo su reporte.';
            $resultado['exito'] = FALSE;
        }

        return $this->createResponse($resultado);
    }

}
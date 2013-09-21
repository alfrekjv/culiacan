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

    public function reportarAction(){
        $storage      = $this->getService('lugar.storage');
        $post         = $this->post();
        $requiredKeys = array(
            'nombre',
            'calle',
            'numero',
            'colonia',
            'ciudad',
            'estado'
        );

        // Check for missing fields, or fields being empty.
        foreach ($requiredKeys as $field) {
            if (!isset($post[$field]) || empty($post[$field])) {
                $missingFields[] = $field;
            }
        }

       // $this->getService('response')->headers->set('Content-type', 'application/json');

        if (!empty($missingFields)) {

            $resultado['msj'] = 'Debe llenar los campos.';
            $resultado['exito'] = FALSE;

            return json_encode($resultado);
        }

        // Create the place
        if ( $storage->create($post) ) {
            $resultado['msj'] = 'Datos reportados correctamente.';
            $resultado['exito'] = TRUE;
        }else{
            $resultado['msj'] = 'Ocurrio un problema, no se realizo su reporte.';
            $resultado['exito'] = FALSE;
        }

        return json_encode($resultado);

    }

}

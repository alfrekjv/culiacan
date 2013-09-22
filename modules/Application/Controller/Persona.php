<?php
namespace Application\Controller;

use Application\Controller\Shared as SharedController;

class Persona extends SharedController
{

    public function reportarPersonaAction()
    {

        if (!$this->post()) {

            // render form to pass thu ajax
            $content = $this->render('Application:persona:reportar.html.php', array(), array('partial' => true));

            return $this->createResponse(
                   array(
                        'status' => 'success',
                        'code'   => 'OK',
                        'content' => $content
                   )
            );
        }

        $post         = $this->post();
        $requiredKeys = array(
            'nombre', 'apellidos',
            'observaciones', 'edad'
        );

        // Check for missing fields, or fields being empty.
        foreach ($requiredKeys as $field) {
            if (!isset($post[$field]) || empty($post[$field])) {
                $missingFields[] = $field;
            }
        }

        if (!empty($missingFields)) {
            return $this->createResponse(
                   array(
                        'status' => 'error',
                        'code'   => 'E_MISSING_FIELDS',
                        'fields' => $missingFields,
                        'message' => 'Entre más información nos des, mejor podemos ayudar.'
                   )
            );
        }

        $storage = $this->getService('persona.storage');
        $insertData = array(
            'nombre'        => $post['nombre'],
            'apellidos'     => $post['apellidos'],
            'edad'          => $post['edad'],
            'status'        => $post['status'],
            'observaciones' => $post['observaciones'],
            'created_at'    => date('Y-m-d H:i:s'),
            'modified_at'    => date('Y-m-d H:i:s')
        );

        $storage->create($insertData);

        return $this->createResponse(
               array(
                    'status' => 'success',
                    'code'   => 'OK',
                    'message' => 'Gracias por apoyar!'
               )
        );
    }

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
        $data    = $storage->buscar_personas($post['keyword']);

        foreach ($data as $row) {
            $map[] = $row->toArray();
        }

        return $this->createResponse(array('data' => $map));
    }

}

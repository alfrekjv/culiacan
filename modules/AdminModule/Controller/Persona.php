<?php
namespace AdminModule\Controller;

use AdminModule\Controller\Shared as SharedController;

class Persona extends SharedController
{

    public function indexAction()
    {

        if (!$this->isAdmin()) {
            $this->setFlash('error', 'You don\'t have permission to access that page');

            return $this->redirectToRoute('User_Login');
        }

        $data = $this->getService('persona.storage')->getAll();

        $total_desaparecidos    = $this->getService('persona.storage')->total_tipo_persona('desaparecida');
        $total_encontradas      = $this->getService('persona.storage')->total_tipo_persona('encontrada');
        $total_albergue         = $this->getService('persona.storage')->total_tipo_persona('en albergue');

        return $this->render('AdminModule:persona:index.html.php', compact('data', 'totales', 
            'total_desaparecidos', 'total_encontradas', 'total_albergue'));
    }

    public function createAction()
    {

        if (!$this->isAdmin()) {
            $this->setFlash('error', 'You don\'t have permission to access that page');

            return $this->redirectToRoute('User_Login');
        }

        if (!$this->post()) {
            return $this->render('AdminModule:persona:create.html.php');
        }

        $storage      = $this->getService('persona.storage');
        $post         = $this->post();
        $requiredKeys = array(
            'nombre',
            'apellidos',
            'edad',
            'status'
        );

        // Check for missing fields, or fields being empty.
        foreach ($requiredKeys as $field) {
            if (!isset($post[$field]) || empty($post[$field])) {
                $missingFields[] = $field;
            }
        }

        // If any fields were missing, inform the client
        if (!empty($missingFields)) {
            $errors[] = 'Debe llenar los campos.';

            return $this->render('AdminModule:persona:create.html.php', compact('errors'));
        }

        // Create the place
        $storage->create($post);

        $this->setFlash('success', 'Datos registrados correctamente.');

        return $this->redirectToRoute('Admin_Personas_Index');
    }

    public function editAction()
    {

        if (!$this->isAdmin()) {
            $this->setFlash('error', 'You don\'t have permission to access that page');

            return $this->redirectToRoute('User_Login');
        }

        $id      = $this->getRouteParam('id');
        $storage = $this->getService('persona.storage');

        if (!$this->post()) {
            $data = $storage->getByID($id);

            return $this->render('AdminModule:persona:edit.html.php', compact('id', 'data'));
        }

        $post         = $this->post();
        $requiredKeys = array(
            'nombre'
        );

        // Check for missing fields, or fields being empty.
        foreach ($requiredKeys as $field) {
            if (!isset($post[$field]) || empty($post[$field])) {
                $missingFields[] = $field;
            }
        }

        // If any fields were missing, inform the client
        if (!empty($missingFields)) {

            $errors[] = 'Debe llenar los campos.';

            return $this->render('AdminModule:persona:edit.html.php', compact('errors', 'id'));
        }

        // Prepare array for insertion
        $storage->update(
            array(
                 'nombre'           => utf8_encode($post['nombre']),
                 'apellidos'        => utf8_encode($post['apellidos']),
                 'edad'             => $post['edad'],
                 'observaciones'    => $post['observaciones'],
                 'status'           => $post['status'],
                 'modified_at'      => date('Y-m-d H:i:s')
            ),
            array('id' => $id)
        );

        // Successful \o/
        $this->setFlash('success', 'Persona Editada!');
        $this->redirectToRoute('Admin_Personas_Index');
    }

    public function deleteAction()
    {

        if (!$this->isAdmin()) {
            $this->setFlash('error', 'You don\'t have permission to access that page');

            return $this->redirectToRoute('User_Login');
        }

        $id = $this->getRouteParam('id');

        if (!filter_var($id, FILTER_VALIDATE_INT)) {
            die('E_INVALID_ROLE_ID');
        }

        $this->getService('persona.storage')->deleteByID($id);

        $this->setFlash('success', 'Persona eliminada correctamente.');

        return $this->redirectToRoute('Admin_Personas_Index');
    }

}
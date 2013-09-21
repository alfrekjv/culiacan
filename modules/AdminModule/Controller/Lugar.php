<?php
namespace AdminModule\Controller;

use AdminModule\Controller\Shared as SharedController;

class Lugar extends SharedController
{

    public function indexAction()
    {

        if (!$this->isAdmin()) {
            $this->setFlash('error', 'You don\'t have permission to access that page');

            return $this->redirectToRoute('User_Login');
        }

        $data       = $this->getService('lugar.storage')->getAll();

        return $this->render('AdminModule:lugar:index.html.php', compact('data'));
    }

    public function createAction()
    {

        if (!$this->isAdmin()) {
            $this->setFlash('error', 'You don\'t have permission to access that page');

            return $this->redirectToRoute('User_Login');
        }

        if (!$this->post()) {

            $municipios = $this->getService('municipios.storage')->getDataForSelect('municipio');

            return $this->render('AdminModule:lugar:create.html.php', compact('municipios'));
        }

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

        // If any fields were missing, inform the client
        if (!empty($missingFields)) {
            $errors[] = 'Debe llenar los campos.';

            return $this->render('AdminModule:lugar:create.html.php', compact('errors'));
        }

        // Create the place
        $storage->create($post);

        $this->setFlash('success', 'Datos registrados correctamente.');

        return $this->redirectToRoute('Admin_Lugares_Index');
    }

    public function editAction()
    {

        if (!$this->isAdmin()) {
            $this->setFlash('error', 'You don\'t have permission to access that page');

            return $this->redirectToRoute('User_Login');
        }

        $id      = $this->getRouteParam('id');
        $storage = $this->getService('lugar.storage');

        if (!$this->post()) {
            $data = $storage->getByID($id);

            return $this->render('AdminModule:lugar:edit.html.php', compact('id', 'data'));
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

            return $this->render('AdminModule:lugar:edit.html.php', compact('errors', 'id'));
        }

        // Prepare array for insertion
        $storage->update(
            array(
                 'nombre'        => $post['nombre'],
                 'calle'         => $post['calle'],
                 'ciudad'        => $post['ciudad'],
                 'estado'        => $post['estado'],
                 'pais'          => $post['pais'],
                 'codigo_postal' => $post['codigo_postal'],
                 'lat'           => $post['lat'],
                 'lng'           => $post['lng'],
                 'tipo'          => $post['tipo'],
                 'colonia'       => $post['colonia'],
                 'modified_at'   => date('Y-m-d H:i:s')
            ),
            array('id' => $id)
        );

        // Successful \o/
        $this->setFlash('success', 'Lugar Editado!');
        $this->redirectToRoute('Admin_Lugares_Index');
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

        $this->getService('lugar.storage')->deleteByID($id);

        $this->setFlash('success', 'Lugar eliminado correctamente.');

        return $this->redirectToRoute('Admin_Lugares_Index');
    }

    public function updateColoniasAction()
    {

        $colonias    = array();
        $municipioId = $this->getRouteParam('municipioId');
        $storage     = $this->getService('colonias.storage');
        $data        = $storage->getByMunicipioId($municipioId);

        foreach ($data as $row) {
            $colonias[$row->getNombre()] = $row->getId();
        }

        $content     = $this->render('AdminModule:lugar:colonias.html.php', compact('colonias'), array('partial' => true));

        return $this->createResponse(
               array(
                    'status' => 'success',
                    'code'   => 'OK',
                    'content' => $content
               )
        );

    }

}

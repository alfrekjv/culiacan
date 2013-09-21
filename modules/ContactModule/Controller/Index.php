<?php
namespace ContactModule\Controller;

use ContactModule\Controller\Shared as SharedController;
use UserModule\Entity\User as UserEntity;

class Index extends SharedController
{

    public function contactAction()
    {

        $post            = $this->post();
        $requiredKeys    = array(
            'nombre_completo',
            'correo_electronico',
            'mensaje'
        );

        // Check for missing fields, or fields being empty.
        foreach ($requiredKeys as $field) {
            if (!isset($post[$field]) || empty($post[$field])) {
                $missingFields[] = $field;
            }
        }

        // If any fields were missing, inform the client
        if (!empty($missingFields)) {
            return $this->createResponse(
                array(
                     'status'  => 'error',
                     'code'    => 'E_MISSING_FIELDS',
                     'fields'  => $missingFields,
                     'message' => 'Nos ayudas llenando el formulario?'
                )
            );
        }

        $emailContent = $this->render('ContactModule:partials:contactoemail.html.php', compact('post'));

        // Enviar correo.

        $fromUser = new UserEntity(
            array(
                 'email'     => $post['correo_electronico'],
                 'firstname' => $post['nombre_completo']
            )
        );

        $toUser   = new UserEntity(
            array(
                 'email'     => 'culiacan@cloudadmin.mx',
                 'firstname' => 'Culiacan E-DN3'
            )
        );

        $helper = $this->getService('email.helper');
        $helper->sendEmail($fromUser, $toUser, 'Culiacán DN3', $emailContent);

        return $this->createResponse(
            array(
                 'status'  => 'success',
                 'code'    => 'OK',
                 'message' => 'Gracias por tu cooperación, tu ayuda es muy valiosa!'
            )
        );
    }
    
}
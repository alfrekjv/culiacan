<?php
namespace AdminModule\Controller;

use AdminModule\Controller\Shared as SharedController;

class User extends SharedController
{

    public function indexAction($errors = array())
    {
        if(!$this->isAdmin()) {
            $this->setFlash('error', 'You don\'t have permission to access that page');
            return $this->redirectToRoute('User_Login');
        }
        
        $users = $this->getService('user.storage')->getAll();
        return $this->render('AdminModule:users:index.html.php', compact('users'));
    }
    
    public function deleteAction()
    {
        
        if(!$this->isAdmin()) {
            $this->setFlash('error', 'You don\'t have permission to access that page');
            return $this->redirectToRoute('User_Login');
        }
        
        $userID = $this->getRouteParam('id');
        
        if(!filter_var($userID, FILTER_VALIDATE_INT)) {
            die('E_INVALID_ROLE_ID');
        }
        
        $this->getService('user.storage')->deleteByID($userID);

        $this->setFlash('success', 'Usuario eliminado correctamente.');
        return $this->redirectToRoute('Admin_Users_Index');
    }
    
    public function editAction()
    {
        
        if(!$this->isAdmin()) {
            $this->setFlash('error', 'You don\'t have permission to access that page');
            return $this->redirectToRoute('User_Login');
        }
        
        $userID = $this->getRouteParam('id');
        
        $us = $this->getService('user.storage');
        
        if(!$us->existsByID($userID)) {
            $this->setFlash('error', 'Invalid Role ID');
            return $this->redirectToRoute('Admin_Roles_Index');
        }
        
        $user = $us->getByID($userID);
        return $this->render('AdminModule:users:edit.html.php', compact('user', 'userID'));
    }

    public function editSubmitAction()
    {

        if(!$this->isAdmin()) {
            $this->setFlash('error', 'You don\'t have permission to access that page');
            return $this->redirectToRoute('User_Login');
        }

        $missingFields = array();
        $post          = $this->post();
        $requiredKeys  = array(
            'userFirstName',
            'userLastName',
            'userEmail',
            'userUser'
        );
        $userStorage   = $this->getService('user.storage');
        $userID        = $this->getRouteParam('id');
        $user          = $userStorage->getByID($userID);

        // Check for missing fields, or fields being empty.
        foreach($requiredKeys as $field) {
            if(!isset($post[$field]) || empty($post[$field])) {
                $missingFields[] = $field;
            }
        }

        // If any fields were missing, inform the client
        if(!empty($missingFields)) {
            $errors[] = 'Debe llenar todos los campos';
            return $this->render('AdminModule:users:edit.html.php', compact('errors','user'));
        }

        // If the user has changed their email address from their current one
        if($post['userEmail'] !== $user->getEmail()) {

            // If the new email is already taken by another user, set an error
            if($userStorage->existsByEmail($post['email'])) {
                $errors[] = 'The email address you have changed to already exists by another user';
                return $this->render('AdminModule:users:edit.html.php', compact('errors','user'));
            }

        }

        // Prepare user array for insertion
        $userStorage->update(
            array(
                  'user'       => $post['userUser'],
                  'email'      => $post['userEmail'],
                  'first_name' => $post['userFirstName'],
                  'last_name'  => $post['userLastName']
             ),
            array('id' => $userID)
        );

        // Successful \o/
        $this->setFlash('success', 'Usuario Editado!');
        $this->redirectToRoute('Admin_Users_Index');

    }

    public function createSubmitAction()
    {
        
        if(!$this->isAdmin()) {
            $this->setFlash('error', 'You don\'t have permission to access that page');
            return $this->redirectToRoute('User_Login');
        }

        $errors          = $missingFields = array();
        $post            = $this->post();
        $userStorage     = $this->getService('user.storage');
        $requiredKeys    = array(
            'userFirstName',
            'userLastName',
            'userEmail',
            'userUsername',
            'userPassword',
            'userConfirmPassword'
        );

        // Check for missing fields, or fields being empty.
        foreach ($requiredKeys as $field) {
            if (!isset($post[$field]) || empty($post[$field])) {
                $missingFields[] = $field;
            }
        }

        // If any fields were missing, inform the client
        if (!empty($missingFields)) {
            $errors[] = 'Debe llenar todos los campos marcados';

            return $this->render('AdminModule:users:create.html.php', compact('errors'));
        }

        // Check if the user's passwords do not match
        if ($post['userPassword'] !== $post['userConfirmPassword']) {
            $errors[] = 'Passwords do not match';

            return $this->render('AdminModule:users:create.html.php', compact('errors'));
        }

        // Check if the user's email address already exists
        if ($userStorage->existsByEmail($post['userEmail'])) {
            $errors[] = 'That email address already exists';

            return $this->render('AdminModule:users:create.html.php', compact('errors'));
        }

        // Check if the user's username already exists
        if ($userStorage->existsByUsername($post['userUsername'])) {
            $errors[] = 'That username already exists';

            return $this->render('AdminModule:users:create.html.php', compact('errors'));
        }

        $post = $this->post();
        $user = array(
            'email'         => $post['userEmail'],
            'first_name'    => $post['userFirstName'],
            'last_name'     => $post['userLastName'],
            'user'          => $post['userUsername'],
            'password'      => $post['userPassword'],
            'salt'          => base64_encode(openssl_random_pseudo_bytes(16)),
            'user_level_id' => 3
        );

        // Create the user
        $newUserID = $userStorage->create($user, $this->getConfigSalt());
        
        $this->setFlash('success', 'Usuario creado correctamente.');
        return $this->redirectToRoute('Admin_Users_Index');
    }

    public function createAction()
    {

        if(!$this->isAdmin()) {
            $this->setFlash('error', 'You don\'t have permission to access that page');
            return $this->redirectToRoute('User_Login');
        }

        return $this->render('AdminModule:users:create.html.php');
        
    }

}
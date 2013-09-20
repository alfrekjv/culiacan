<?php
namespace UserModule\Controller;

use UserModule\Controller\Shared as SharedController;
use UserModule\Entity\AuthUser as AuthUserEntity;

class Account extends SharedController
{

    public function viewAction()
    {

        if (!$this->isLoggedIn()) {
            return $this->redirectToRoute('User_Signup');
        }

        $user = $this->getUser();

        return $this->render('UserModule:account:view.html.php', compact('user'));
    }

    public function editAction()
    {

        if (!$this->isLoggedIn()) {
            return $this->redirectToRoute('User_Signup');
        }

        $user = $this->getUser();

        // transform date into a user friendly one.
        return $this->render('UserModule:account:edit.html.php', compact('user', 'dob', 'dob2', 'userMeta'));

    }

    public function editsaveAction()
    {

        $missingFields   = array();
        $post            = $this->post();
        $requiredKeys    = array(
            'userFirstName',
            'userLastName',
            'userEmail',
            'userUsername'
        );
        $userStorage     = $this->getUserStorage();

        // Check if the user is logged in.
        if (!$this->isLoggedIn()) {
            return $this->redirectToRoute('User_Login');
        }

        // Check for missing fields, or fields being empty.
        foreach ($requiredKeys as $field) {
            if (!isset($post[$field]) || empty($post[$field])) {
                $missingFields[] = $field;
            }
        }

        // If any fields were missing, inform the client
        if (!empty($missingFields)) {
            $errors[] = 'Debes llenasr todos los campos.';

            return $this->render('UserModule:account:edit.html.php', compact('errors'));
        }

        // If the user has changed their email address from their current one
        if ($post['userEmail'] !== $this->getUser()->getEmail()) {

            // If the new email is already taken by another user, set an error
            if ($userStorage->existsByEmail($post['email'])) {
                $errors[] = 'The email address you have changed to already exists by another user';

                return $this->render('UserModule:account:edit.html.php', compact('errors'));
            }
        }

        // Prepare user array for insertion
        $userStorage->update(
            array(
                 'email'     => $post['userEmail'],
                 'user'     => $post['userUsername'],
                 'first_name' => $post['userFirstName'],
                 'last_name'  => $post['userLastName']
            ),
            array('id' => $this->getUser()->getID())
        );

        // Update the user object in the session
        $this->setAuthData(new AuthUserEntity($userStorage->findByID($this->getUser()->getID())));

        // Successful \o/
        $this->setFlash('success', 'Account updated!');
        $this->redirectToRoute('User_Account');

    }

    public function editpasswordAction()
    {

        if (!$this->isLoggedIn()) {
            return $this->redirectToRoute('User_Signup');
        }

        $user = $this->getUser();

        return $this->render('UserModule:account:editpassword.html.php', compact('user'));
    }

    public function editpasswordsaveAction()
    {

        $missingFields = array();
        $post          = $this->post();
        $requiredKeys  = array('userPassword', 'userNewPassword', 'userConfirmNewPassword');
        $userStorage   = $this->getUserStorage();

        // Check if the user is logged in.
        if (!$this->isLoggedIn()) {
            return $this->redirectToRoute('User_Login');
        }

        // Check for missing fields, or fields being empty.
        foreach ($requiredKeys as $field) {
            if (!isset($post[$field]) || empty($post[$field])) {
                $missingFields[] = $field;
            }
        }

        // If any fields were missing, inform the client
        if (!empty($missingFields)) {
            $errors[] = 'Missing field';

            return $this->render('UserModule:account:editpassword.html.php', compact('errors'));
        }

        // Make sure the new passwords match
        if ($post['userNewPassword'] !== $post['userConfirmNewPassword']) {
            $errors[] = 'Your new password and confirm new pasword do not match';

            return $this->render('UserModule:account:editpassword.html.php', compact('errors'));
        }

        $user = $this->getUser();

        // Check current password is valid
        if (!$userStorage->verifyPassword($user->getSalt(), $this->getConfigSalt(), $user->getEmail(), $post['userPassword'])) {
            $errors[] = 'Your existing password is incorrect';

            return $this->render('UserModule:account:editpassword.html.php', compact('errors'));
        }

        // Update user's password
        $userStorage->updatePassword($user->getID(), $user->getSalt(), $this->getConfigSalt(), $post['userNewPassword']);

        // Successful password update \o/
        $this->setFlash('success', 'Your password has been updated');
        $this->redirectToRoute('User_Account');

    }

    public function picturesAction()
    {
        $galleryStorage = $this->getService('user.gallery.storage');
        $gallery        = $galleryStorage->getAllFromUserID($this->getUser()->getId());

        return $this->render('UserModule:account:pictures.html.php', compact('gallery'));

    }

    public function deletepictureAction()
    {

        $pictureID      = $this->getRouteParam('id');
        $galleryStorage = $this->getService('user.gallery.storage');
        $picture        = $galleryStorage->getByID($pictureID);
        $config         = $this->getConfig();

        $path = realpath($config['user_avatar_upload_dir'] . $picture->getFileName());
        if (file_exists($path)) {
            unlink($path);
        }
        $galleryStorage->deleteByID($pictureID);

        echo 'OK';
    }

    public function pictureCreateAction()
    {
        return $this->render('UserModule:account:picturecreate.html.php');
    }

    public function pictureCreateSubmitAction()
    {

        $files = $this->files();
        if (isset($files['userPicture'])) {
            $this->getService('user.account.helper')->createGalleryItem($this->getUser()->getID(), $files['userPicture']);
            $this->setFlash('success', 'Picture uploaded');
        } else {
            $this->setFlash('error', 'No Picture Found');
        }

        return $this->redirectToRoute('User_My_Pictures');
    }

    public function pictureEditAction()
    {

        $pictureID = $this->getRouteParam('id');

        return $this->render('UserModule:account:pictureedit.html.php', compact('pictureID'));
    }

    public function pictureEditSubmitAction()
    {

        $post           = $this->post();
        $pictureID      = $post['pictureID'];
        $galleryStorage = $this->getService('user.gallery.storage');
        $picture        = $galleryStorage->getByID($pictureID);
        $config         = $this->getConfig();

        // Delete the Old one.
        $path = realpath($config['user_avatar_upload_dir'] . $picture->getFileName());
        if (file_exists($path)) {
            unlink($path);
        }

        $galleryStorage->deleteByID($pictureID);

        // Upload the new one
        $files = $this->files();
        if (isset($files['userPicture'])) {
            $this->getService('user.account.helper')->createGalleryItem($this->getUser()->getID(), $files['userPicture']);
            $this->setFlash('success', 'Picture uploaded');
        } else {
            $this->setFlash('error', 'No Picture Found');
        }

        return $this->redirectToRoute('User_My_Pictures');
    }

}
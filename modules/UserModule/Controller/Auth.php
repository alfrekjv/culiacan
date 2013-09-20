<?php
namespace UserModule\Controller;

use UserModule\Controller\Shared as SharedController;
use UserModule\Entity\User as UserEntity;
use UserModule\Entity\AuthUser as AuthUserEntity;

class Auth extends SharedController
{

    protected $userStorage;

    // Create first admin user.
    /*public function yomeroAction()
    {
        $userStorage     = $this->getUserStorage();
        $user = array(
            'email'       => 'alfrekjv@gmail.com',
            'first_name'  => 'Alfredo',
            'last_name'   => 'Juárez',
            'user'        => 'alfrekjv',
            'password'    => 'asks0ft',
            'salt'        => base64_encode(openssl_random_pseudo_bytes(16)),
            'status'      => 1,
            'level'       => 1,
            'created_at'  => date('Y-m-d H:i:s'),
            'modified_at' => date('Y-m-d H:i:s')
        );

        // Create the user
        $newUserID = $userStorage->create($user, $this->getConfigSalt());

        echo 'Usuario creado correctamente.';
    } */

    public function signupAction()
    {

        if ($this->isLoggedIn()) {
            return $this->redirectToRoute('User_Account');
        }

        $signupData  = array(
            'email'       => '', 'firstname'   => '',
            'lastname'    => '', 'username'    => '',
            'photo_url'   => '', 'website'     => '',
            'description' => '', 'profile_url' => '',
            'phone'       => '', 'address'     => '',
            'country'     => '', 'region'      => '',
            'city'        => ''
        );

        $cache    = $this->getService('social.signup.cache');
        $cacheKey = 'social_hybridauth_data';

        if ($cache->contains($cacheKey)) {
            $signupData = $cache->fetch($cacheKey);
            $cache->delete($cacheKey); // clear the cache.
        }

        return $this->render('UserModule:auth:signup.html.php', compact('signupData'));
    }

    public function loginAction()
    {

        if ($this->isLoggedIn()) {
            return $this->redirectToRoute('User_Account');
        }

        return $this->render('UserModule:auth:login.html.php');
    }

    public function forgotpwAction()
    {
        return $this->render('UserModule:auth:forgotpw.html.php');
    }

    public function forgotpwenterAction()
    {
        return $this->render('UserModule:auth:forgotpwenter.html.php');
    }

    public function logoutAction()
    {
        $this->getSession()->clear();
        $this->redirectToRoute('Homepage');
    }

    public function signupsaveAction()
    {

        $errors          = $missingFields = array();
        $post            = $this->post();
        $requiredKeys    = array(
            'userFirstName',
            'userLastName',
            'userEmail',
            'userUsername',
            'userPassword',
            'userConfirmPassword'
        );
        $userStorage     = $this->getUserStorage();
        $userMetaStorage = $this->getUserMetaStorage();

        // Check for missing fields, or fields being empty.
        foreach ($requiredKeys as $field) {
            if (!isset($post[$field]) || empty($post[$field])) {
                $missingFields[] = $field;
            }
        }

        // If any fields were missing, inform the client
        if (!empty($missingFields)) {
            $errors[] = 'Missing fields';

            return $this->render('UserModule:auth:signup.html.php', compact('errors'));
        }

        // Check if the user's passwords do not match
        if ($post['userPassword'] !== $post['userConfirmPassword']) {
            $errors[] = 'Passwords do not match';

            return $this->render('UserModule:auth:signup.html.php', compact('errors'));
        }

        // Check if the user's email address already exists
        if ($userStorage->existsByEmail($post['userEmail'])) {
            $errors[] = 'That email address already exists';

            return $this->render('UserModule:auth:signup.html.php', compact('errors'));
        }

        // Check if the user's username already exists
        if ($userStorage->existsByUsername($post['userUsername'])) {
            $errors[] = 'That username already exists';

            return $this->render('UserModule:auth:signup.html.php', compact('errors'));
        }

        // Prepare user array for insertion
        $user = array(
            'email'     => $post['userEmail'],
            'firstname' => $post['userFirstName'],
            'lastname'  => $post['userLastName'],
            'username'  => $post['userUsername'],
            'password'  => $post['userPassword'],
            'salt'      => base64_encode(openssl_random_pseudo_bytes(16))
        );

        // Create the user
        $newUserID = $userStorage->create($user, $this->getConfigSalt());

        // Meta data setup
        $metaInsertData = array();
        $metaMap        = array(
            'dob'           => 'userDOB',
            'primary_phone' => 'userPrimaryPhone',
            'twitter'       => 'userTwitter',
            'facebook'      => 'userFacebook'
        );

        foreach ($metaMap as $key => $val) {
            if (isset($post[$val]) && !empty($post[$val])) {
                $metaInsertData[$key] = $post[$val];
            }
        }

        if (isset($metaInsertData['dob'])) {
            list($dobMonth, $dobDay, $dobYear) = explode('/', $metaInsertData['dob']);
            $dateTime              = new \DateTime("{$dobYear}-{$dobMonth}-{$dobDay}");
            $metaInsertData['dob'] = $dateTime->format('m/d/Y');
        }

        if (isset($metaInsertData['twitter'])) {
            $metaInsertData['twitter'] = str_replace('@', '', $metaInsertData['twitter']);
        }

        // Create the users meta fields
        $userMetaStorage->create($newUserID, $metaInsertData);

        // upload pictures, if any...
        $userGallery   = $this->getService('user.gallery.storage');
        $accountHelper = $this->getService('user.account.helper');
        $files         = $this->files();
        $config        = $this->getConfig();

        if (isset($files['userPicture1']) && !empty($files['userPicture1'])) {
            $accountHelper->createGalleryItem($newUserID, $files['userPicture1']);
        }
        if (isset($files['userPicture2']) && !empty($files['userPicture2'])) {
            $accountHelper->createGalleryItem($newUserID, $files['userPicture2']);
        }

        // Generate sha1() based activation code
        $activationCode = sha1(openssl_random_pseudo_bytes(16));

        // Insert an activation token for this user
        $this->getUserActivationStorage()->create(array(
            'user_id'   => $newUserID,
            'token'     => $activationCode,
            'date_used' => date('Y-m-d H:i:s')
        ));

        // Send the user's activation email
        $this->sendActivationEmail($user, $activationCode);

        // Successful registration. \o/
        return $this->render('UserModule:auth:signupsuccess.html.php');

    }

    public function logincheckAction()
    {

        $errors       = $missingFields = array();
        $post         = $this->post();
        $requiredKeys = array(
            'user',
            'password'
        );
        $userStorage  = $this->getUserStorage();

        // Check for missing fields, or fields being empty.
        foreach ($requiredKeys as $field) {
            if (!isset($post[$field]) || empty($post[$field])) {
                $missingFields[] = $field;
            }
        }

        // If any fields were missing, inform the client
        if (!empty($missingFields)) {
            $errors[] = 'Missing fields';

            return $this->render('UserModule:auth:login.html.php', compact('errors'));
        }

        $userSecurity = $this->getService('user.security');

        // Lets try to authenticate the user
        if (!$userSecurity->checkAuth($post['user'], $post['password'])) {
            $errors[] = 'Usuario/Password Incorrecto.';
            return $this->render('UserModule:auth:login.html.php', compact('errors'));
        }

        // Get user record
        $userEntity = $userStorage->getByUsername($post['user']);

        $userSecurity->login(new AuthUserEntity($userStorage->findByUsername($post['user'])));

        // Login Successful. \o/
        $this->setFlash('success', 'Inicio de Sesión Exitoso.');
        $this->redirectToRoute('Admin_Index', array('username' => $userEntity->getUsername()));

    }

    public function forgotpwsendAction()
    {

        $response = array('status' => 'E_UNKNOWN');
        $email    = $this->post('email');
        $us       = $this->getUserStorage();

        // Check for missing field
        if (empty($email)) {
            $response['status']      = 'E_MISSING_FIELD';
            $response['error_value'] = 'email';

            return $this->renderJsonResponse($response);
        }

        // Check if user record does not exist
        if (!$us->existsByEmail($email)) {
            $response['status'] = 'E_MISSING_RECORD';

            return $this->renderJsonResponse($response);
        }

        $forgotUser  = $us->getByEmail($email);
        $forgotToken = sha1(openssl_random_pseudo_bytes(16));

        // Insert a forgot token for this user
        $this->getUserForgotStorage()->create(array(
                                                   'user_id' => $forgotUser->getID(),
                                                   'token'   => $forgotToken
                                              ));

        // Lets send the user forgotpw email
        $this->sendForgotPWEmail($forgotUser, $forgotToken);

        // Successful response
        $response['status'] = 'success';

        return $this->renderJsonResponse($response);

    }

    public function forgotpwcheckAction()
    {

        $token = $this->getRouteParam('token');
        $fs    = $this->getUserForgotStorage();

        // If the user has not activated their token before, activate it!
        if (!$fs->isUserActivatedByToken($token)) {

            $fs->useToken($token);

            // Lets generate a CSRF token for the update password page.
            $csrf = sha1(openssl_random_pseudo_bytes(16));
            $this->getSession()->set('forgotpw_csrf', $csrf);
            $this->getSession()->set('forgotpw_token', $token);

            // Render the 'enter your new password' view
            return $this->render('UserModule:auth:forgotpwenter.html.php', compact('csrf'));
        }

        // redirect the user to the login page
        return $this->redirectToRoute('User_Signup');
    }

    public function forgotpwsaveAction()
    {

        $post         = $this->post();
        $requiredKeys = array(
            'password',
            'confirm_password',
            'csrf'
        );

        // Check for missing fields, or fields being empty.
        foreach ($requiredKeys as $field) {
            if (!isset($post[$field]) || empty($post[$field])) {
                $missingFields[] = $field;
            }
        }

        // If any fields were missing, inform the client
        if (!empty($missingFields)) {
            $response['status']      = 'E_MISSING_FIELD';
            $response['error_value'] = implode(',', $missingFields);

            return $this->renderJsonResponse($response);
        }

        // Check if both passwords match
        if ($post['password'] !== $post['confirm_password']) {
            $response['status'] = 'E_PASSWORD_MISMATCH';

            return $this->renderJsonResponse($response);
        }

        // Check for csrf protection
        $csrf = $this->session('forgotpw_csrf');
        if (empty($csrf) || $csrf !== $post['csrf']) {
            $response['status'] = 'E_INVALID_CSRF';

            return $this->renderJsonResponse($response);
        }

        // Get the user record out of the session token
        $token = $this->session('forgotpw_token');
        if (empty($token)) {
            $response['status'] = 'E_MISSING_TOKEN';

            return $this->renderJsonResponse($response);
        }

        // Get user entity from the userID on the token row
        $us         = $this->getUserStorage();
        $userEntity = $us->getByID($this->getUserForgotStorage()->getByToken($token)->getUserID());

        // Update the user's password
        $this->getUserStorage()->updatePassword($userEntity->getID(), $userEntity->getSalt(), $this->getConfigSalt(), $post['password']);

        // Wipe session values clean
        $session = $this->getSession();
        $session->remove('fogotpw_csrf');
        $session->remove('fogotpw_token');

        // Return successful response \o/
        $response['status'] = 'success';

        return $this->renderJsonResponse($response);

    }

    /**
     * Activation action. Active the user's account
     */
    public function activateAction()
    {

        $token = $this->getRouteParam('token');
        $uas   = $this->getService('user.activation.storage');

        // If the user has not activated their token before, activate it!
        if (!$uas->isUserActivatedByToken($token)) {

            $uas->activateUser($token);
            $emailHelper = $this->getService('email.helper');

            $fromUser = new UserEntity($this->getEmailConfig());
            $toUser   = $this->getService('user.storage')->getByID($uas->getUserIDFromToken($token));

            $username    = $toUser->getUsername();
            $accountLink = $this->getRequest()->getSchemeAndHttpHost() . $this->generateUrl('User_Profile', array('username' => $username));

            // Get the welcome email content.
            $emailContent = $this->render('UserModule:auth:welcome.html.php', compact('username', 'accountLink'));

            // Send the welcome email to the user
            $emailHelper->sendEmail($fromUser, $toUser, 'New Talentize Account Info', $emailContent);

            // User entity preparation
            $config    = $this->getConfig();
            $adminUser = new UserEntity($config['adminEmailConfig']);

            // Get the activation email content, it's in a view file.
            $emailContent = $this->render('UserModule:auth:activateemail.html.php', compact('toUser', 'accountLink'));

            // Send the activation email to the user
            $emailHelper->sendEmail($fromUser, $adminUser, 'User Signed Up', $emailContent);

        }

        return $this->render('UserModule:auth:activate.html.php', compact('csrf'));

    }

    /**
     * Send the user's activation email to them.
     *
     * @param \User\Entity\User $toUser
     * @param string            $activationCode
     */
    protected function sendActivationEmail($toUser, $activationCode)
    {

        $fromUser = new UserEntity($this->getEmailConfig());
        $toUser   = new UserEntity($toUser);

        // Generate the activation link from the route key
        $activationLink = $this->generateUrl('User_Activate', array('token' => $activationCode), true);

        // Get the activation email content, it's in a view file.
        $emailContent = $this->render('UserModule:auth:signupemail.html.php', compact('toUser', 'activationLink'));

        // Send the activation email to the user
        $helper = $this->getService('email.helper');
        $config = $this->getConfig();
        $helper->sendEmail($fromUser, $toUser, $config['signupEmail']['subject'], $emailContent);

    }

    /**
     * Send the user's forgotpw email to them.
     *
     * @param \User\Entity\User|array $toUser
     * @param string                  $activationCode
     *
     * @return void
     */
    protected function sendForgotPWEmail($toUser, $forgotToken)
    {

        // User entity preparation
        $fromUser = new UserEntity($this->getEmailConfig());
        if (is_array($toUser)) {
            $toUser = new UserEntity($toUser);
        }

        // Generate the activation link from the route key
        $forgotLink = $this->generateUrl('User_Forgot_Password_Check', array('token' => $forgotToken), true);

        // Get the activation email content, it's in a view file.
        $emailContent = $this->render('UserModule:auth:forgotpwemail.html.php', compact('toUser', 'forgotLink'));

        // Send the activation email to the user
        $helper = $this->getService('email.helper');
        $config = $this->getConfig();
        $helper->sendEmail($fromUser, $toUser, $config['forgotEmail']['subject'], $emailContent);

    }

    protected function renderJsonResponse($response)
    {
        $this->getRequest()->headers->set('Content-Type', 'application/json');

        return json_encode($response);
    }

    public function validateEmailAction()
    {

        $status      = array('status' => 'CLEAR');
        $email       = $this->getRouteParam('email');
        $userStorage = $this->getService('user.storage');

        if ($userStorage->existsByEmail($email)) {
            $status['status'] = 'EMAIL_TAKEN';
        }

        return $this->renderJsonResponse($status);
    }

    public function validateUsernameAction()
    {
        $status      = array('status' => 'CLEAR');
        $username    = $this->getRouteParam('username');
        $userStorage = $this->getService('user.storage');

        if ($userStorage->existsByUsername($username)) {
            $status['status'] = 'USERNAME_TAKEN';
        }

        return $this->renderJsonResponse($status);
    }

    // SOCIAL SIGN IN (HYBRIDAUTH)

    public function socialLoginAction()
    {
        $provider = $this->getRouteParam('provider');
        $ha       = $this->initHybridAuth();
        $adapter  = $ha->authenticate($provider);

        $this->redirectToRoute("User_Social_Auth", array('provider' => $provider));
    }

    public function socialAuthAction()
    {

        $cache       = $this->getService('social.signup.cache');
        $ha          = $this->initHybridAuth();
        $provider    = $this->getRouteParam('provider');
        $adapter     = $ha->getAdapter($provider);
        $userProfile = $adapter->getUserProfile();

        $user = array(
            'provider'    => $provider,
            'email'       => $userProfile->email,
            'username'    => $provider == 'Facebook' ? $userProfile->username : $userProfile->displayName,
            'firstname'   => $userProfile->firstName,
            'lastname'    => $userProfile->lastName,
            'photo_url'   => $userProfile->photoURL,
            'website'     => $userProfile->webSiteURL,
            'description' => $userProfile->description,
            'profile_url' => $userProfile->profileURL,
            'phone'       => $userProfile->phone,
            'address'     => $userProfile->address,
            'country'     => $userProfile->country,
            'region'      => $userProfile->region,
            'city'        => $userProfile->city
        );

        // Save user's data on cache,
        // then redirect to the sign up page.
        $cache->save('social_hybridauth_data', $user, 60 * 60);
        $this->redirectToRoute('User_Signup');
    }

    public function socialEndPointAction()
    {

        require_once getcwd() . '/vendor/hybridauth/Hybrid/Auth.php';
        require_once getcwd() . '/vendor/hybridauth/Hybrid/Endpoint.php';

        \Hybrid_Endpoint::process();
        exit;
    }

    private function initHybridAuth()
    {
        return $this->getService('hybridauth');
    }

}

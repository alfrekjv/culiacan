<?php
namespace AdminModule\Controller;

use AdminModule\Controller\Shared as SharedController;

class Index extends SharedController
{

    public function indexAction()
    {
        
        if(!$this->isAdmin()) {
            $this->setFlash('error', 'You don\'t have permission to access that page');
            return $this->redirectToRoute('User_Login');
        }
        
        $numUsers = $this->getService('user.storage')->countAll();
        
        return $this->render('AdminModule:index:index.html.php', compact('numUsers'));
    }

}

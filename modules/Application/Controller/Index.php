<?php
namespace Application\Controller;

use Application\Controller\Shared as SharedController;

class Index extends SharedController
{

    public function indexAction()
    {

        $municipios = $this->getService('municipios.storage')->getDataForSelect('municipio');

        return $this->render('Application:index:index.html.php', compact('municipios'));
    }

}

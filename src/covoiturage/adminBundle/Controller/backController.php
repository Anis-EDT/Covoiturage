<?php

namespace covoiturage\adminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class backController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }
    public function backAction(){
        return $this->render('covoiturageadminBundle::backAdmin.html.twig');
    }
}

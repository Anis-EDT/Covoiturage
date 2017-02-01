<?php

namespace covoiturage\userBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('covoiturageuserBundle::accueil.html.twig');
    }
}

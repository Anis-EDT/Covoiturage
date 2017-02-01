<?php

namespace covoiturage\membreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('covoituragemembreBundle:Default:index.html.twig');
    }
}

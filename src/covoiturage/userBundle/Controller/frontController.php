<?php

namespace covoiturage\userBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class frontController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('covoiturageuserBundle::accueil.html.twig');
    }
    public  function accueilAction(){

        return $this->render('covoiturageuserBundle::accueil.html.twig');
    }

public  function contactAction(Request $request){
    if($request->isMethod("POST")){
        $sujet=$request->get('sujet');
        $email=$request->get('email');
        $body=$request->get('message');
        $body=('mail envoyé de la part de : '.$email.' message : '.$body);
    $message= \Swift_Message::newInstance()

        ->setSubject($sujet)
        ->setFrom($email)
        ->setTo('mohamed.ahmed.isamm@gmail.com')
        ->setBody($body);
    $this->get('mailer')->send($message);
    }
    return $this->render('covoiturageuserBundle::contact.html.twig');
}
    public  function checkAction(Request $request){
        if($this->isGranted('ROLE_ADMIN')){
            return $this->redirectToRoute('covoiturageadmin_back');
        }else{
            return $this->redirectToRoute('covoiturage_homepage');
        }
        return $this->render('covoiturageuserBundle::check.html.twig');
    }

}

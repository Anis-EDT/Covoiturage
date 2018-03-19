<?php

namespace covoiturage\userBundle\Controller;

use covoiturage\userBundle\Entity\reclamations;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use covoiturage\userBundle\Form\reclamationsType;

class reclamationsController extends Controller
{
    public function ajouterAction(Request $request)
    {
        $reclamation = new reclamations();
        $user = $this->getUser();
        $reclamation->setMembre($user);
        $reclamation->setReponse("En attante de reponse");
        $form = $this->createForm(reclamationsType::class, $reclamation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $date3 = new \DateTime('now');
            $em = $this->getDoctrine()->getManager();
            $reclamation->setDate($date3);
            $em->persist($reclamation);
            $em->flush();
            return $this->redirectToRoute('afficherReclamation');
            return new Response("reclamation ajoute");
        }
        return $this->render('covoiturageuserBundle:reclamation:ajouter.html.twig', array('form' => $form->createView()));
    }

    public function afficherAction(Request $request)
    {
        $user=$this->getUser();
        $em = $this->getDoctrine()->getManager();
        $reclamation = $em->getRepository('covoiturageuserBundle:reclamations')->findBy(array("Membre"=>$user));//rechercheClub();


        return $this->render('covoiturageuserBundle:reclamation:afficher.html.twig', array('reclamations' => $reclamation));
    }
    public function modifierAction($id,Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $reclamation=$em->getRepository('covoiturageuserBundle:reclamations')->find($id);
        $form=$this->createForm(reclamationsType::class,$reclamation);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($reclamation);
            $em->flush();
            return $this->redirectToRoute('afficherReclamation');

        }
        return $this->render('covoiturageuserBundle:reclamation:modifier.html.twig', array('form'=>$form->createView()));
    }
    public function supprimerAction($id)
    {

        $em=$this->getDoctrine()->getManager();
        $reclamation=$em->getRepository('covoiturageuserBundle:reclamations')->find($id);
        $em->remove($reclamation);
        $em->flush();
        return $this->redirectToRoute('afficherReclamation');

    }


}
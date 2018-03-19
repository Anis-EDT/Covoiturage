<?php

namespace covoiturage\userBundle\Controller;

use covoiturage\userBundle\Entity\annonce;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;
use covoiturage\userBundle\Entity\ville;
use covoiturage\userBundle\Entity\trajet;

class frontController extends Controller
{
    public function indexAction($name)
    {

        return $this->render('covoiturageuserBundle::accueil.html.twig');
    }
    public  function accueilAction(){
        $em = $this->getDoctrine()->getManager();
        $date3 = new \DateTime('now');
        $temoignages = $em->getRepository('covoiturageuserBundle:temoignage')->findAll();
        $m=$em->getRepository('covoiturageuserBundle:Membre')->findAll();
        $m=count($m);
        $v=$em->getRepository('covoiturageuserBundle:voiture')->findAll();
        $v=count($v);
        $a=$em->getRepository('covoiturageuserBundle:annonce')->findAll();
        $a=count($a);
        $t=$em->getRepository('covoiturageuserBundle:trajet')->findAll();
        $t=count($t);

        return $this->render('@covoiturageuser/accueil.html.twig', array(
            'temoignage' => $temoignages,'date_now'=>$date3
        ,'m'=>$m,'v'=>$v,'a'=>$a,'t'=>$t));


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
    public  function rechercheAction(Request $request){

    }
    public function ajoutAction(Request $request){
        $ann= new annonce();
        if ($request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();
            $date=$request->get('date');
            $ok=(new \DateTime($date));
            $date=$ok;
            $heure=$request->get('heure');
            $heure=$heure.':00';
            $ok1=(new \DateTime($heure));
            $heure=$ok1;
            $distance=$request->get('total');
            $prix=$request->get('prix');
            $nb_places=$request->get('nb_places');
            $deviation=$request->get('deviation');
            $commentaire=$request->get('commentaire');
            $escale=$request->get('select');
            $date3 = new \DateTime('now');
            $depart=$request->get('depart');
            $destination=$request->get('destination');
            $lat_depart=$request->get('l1');
            $long_depart=$request->get('la1');
            $lat_destination=$request->get('l2');
            $long_destination=$request->get('la2');
            $ville_depart=new ville();
            $ville_destination=new ville();
            $ville_depart->setNom($depart);
            $ville_depart->setLatitude($lat_depart);
            $ville_depart->setLongitude($long_depart);
            $ville_destination->setNom($destination);
            $ville_destination->setLatitude($lat_destination);
            $ville_destination->setLongitude($long_destination);
            $trajet=new trajet();
            //ta3mel repository->findall et wount($obj_repositoryfindall)
            $trajet->setVilleDepart($ville_depart);
            $trajet->setVilleArrive($ville_destination);
            $trajet->setDistance($distance);
            $trajet->setEscale($escale);
            $ann->setTrajet($trajet);
            $ann->setNbrrate(0);
            $ann->setRating(0);
            $ann->setCommentaire($commentaire);
            $ann->setDeviation($deviation);
            $ann->setNbPlaces($nb_places);
            $ann->setPrix($prix);
            $ann->setDateDepart($date);
            $ann->setHeureDepart($heure);
            $ann->setMembre($this->getUser());
            $ann->setDate($date3);
            $em->persist($ville_depart);
            $em->persist($ville_destination);
            $em->persist($trajet);
            $em->persist($ann);
            $em->flush();

            return $this->redirectToRoute('annonce_annonce');



        }
        $date0 = new \DateTime('now');
        $date0=$date0->format('Y-m-d');
        return $this->render('@covoiturageuser/ajout-annonce.html.twig',array('date0'=>$date0));
    }
    public function dernierAction(Request $request){

        $ok=$request->get('location');




        $em = $this->getDoctrine()->getManager();
        $date3 = new \DateTime('now');
        $date3->add(new \DateInterval('PT2H'));
        $heure=$date3->format('H-m');

        $date0 = new \DateTime('now');
        $date0->add(new \DateInterval('P1D'));

        $date5 = new \DateTime('now');
        $heure1=$date5->format('H-m');

        $date4 = new \DateTime('now');
        $date4->sub(new \DateInterval('P1D'));
        $date5 = new \DateTime('now');

            $ok=$em->getRepository('covoiturageuserBundle:annonce')->DernierAnnonce($date4,$heure,$date0,$heure1,$ok,$date5);
            return $this->render('@covoiturageuser/dernierAnn.html.twig'
                ,array('ann'=>$ok));




    }
}

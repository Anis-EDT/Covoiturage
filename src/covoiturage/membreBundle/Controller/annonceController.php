<?php

namespace covoiturage\membreBundle\Controller;

use covoiturage\userBundle\Entity\annonce;
use covoiturage\userBundle\Entity\reservations;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;

class annonceController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }
    public function annonceAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $ann = $em->getRepository('covoiturageuserBundle:annonce')->findBy(array('Membre'=>$this->getUser()));
        return $this->render('covoituragemembreBundle:annonce:annonce.html.twig', array(
            'annonces' => $ann,
        ));
    }
    public function affAnnonceAction(Request $request,$id){
        $em = $this->getDoctrine()->getManager();
        $ok=$em->getRepository('covoiturageuserBundle:annonce')->find($id);
        //anis trajet
        //get rajet:

        $traj=$ok->getTrajet();
        $ok2=$em->getRepository('covoiturageuserBundle:trajet')->find($traj);
        //get ville

        $ville_depart=$ok2->getVilleDepart();
        $ville_destination=$ok2->getVilleArrive();
        $ok3=$em->getRepository('covoiturageuserBundle:ville')->find($ville_depart);
        $ok4=$em->getRepository('covoiturageuserBundle:ville')->find($ville_destination);
        // lattitude + longitude

        $lat_arrive=$ok3->getLatitude();
        $long_arrive=$ok3->getLongitude();
        $lat_destination=$ok4->getLatitude();
        $long_destination=$ok4->getLongitude();





        return $this->render('covoituragemembreBundle:annonce:affannonce.html.twig',array(
            'ann'=>$ok,'lat_arrive'=>$lat_arrive,'long_arrive'=>$long_arrive,'lat_destination'=>$lat_destination,'long_destination'=>$long_destination
        ));

    }
    public function modifAnnAction(Request $request,$id){
        $date3 = new \DateTime('now');
        $date3->add(new \DateInterval('P3D'));
        $em = $this->getDoctrine()->getManager();
        $ok=$em->getRepository('covoiturageuserBundle:annonce')->find($id);
        $date2=$ok->getDateDepart();

        if( $date3->format("dd/mm/yy") > $date2->format("dd/mm/yy") ){
            $ok1=1;
        }else{
            $ok1=0;
        }
        if($ok1==1){
           return $this->redirectToRoute('non_modif_annonce');
        }
        if($request->isMethod('post')){
            $prix=$request->get('prix');
            $commentaire=$request->get('commentaire');
            $ok->setPrix($prix);
            $ok->setCommentaire($commentaire);
            $em->persist($ok);
            $em->flush();
            return $this->redirectToRoute('aff_annonce', array('id' => $ok->getId()));
        }
        return $this->render('covoituragemembreBundle:annonce:modifannonce.html.twig'
        ,array('ann'=>$ok));

    }
    public function modifNonAnnAction(){
        return $this->render('@covoituragemembre/annonce/mdif_non.html.twig');
    }


    public function supAnnAction(Request $request,$id){
        $em = $this->getDoctrine()->getManager();
        $ok2=$em->getRepository('covoiturageuserBundle:annonce')->find($id);
        $ok=$em->getRepository('covoiturageuserBundle:annonce')->find($id);
        $ok1=$em->getRepository('covoiturageuserBundle:reservations')->findBy(array('Annonce'=>$ok));


        if( $ok1==null ){
            $ok1=1;
        }else{
            $ok1=0;
        }
        if($ok1==0){
            return $this->redirectToRoute('non_supp_annonce');
        }else {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ok);
            $em->flush();
            return $this->redirectToRoute('annonce_annonce',array('annonces' => $ok2));
        }
    }



    public function suppNonAnnAction(){
        return $this->render('@covoituragemembre/annonce/supp_non.html.twig');
    }
    public function rechercheAnnAction(Request $request){

        $date3 = new \DateTime('now');
        $em = $this->getDoctrine()->getManager();
        if($request->isMethod('post')){

            $depart=$request->get('Depart');
            $destination=$request->get('Destination');
            $date=$request->get('Date');
            $ok=$em->getRepository('covoiturageuserBundle:annonce')->rechercheAnnonce($depart,$destination,$date);
            return $this->render('@covoituragemembre/annonce/rechercheAnn.html.twig'
            ,array('ann'=>$ok,'date'=>$date3));

        }

        return $this->render('@covoituragemembre/annonce/rechercheAnn.html.twig',array('date'=>$date3));
    }
    public function reserverAnnAction(Request $request,$id){
        if($this->isGranted('ROLE_MEMBRE')){
            $rate = new annonce();
            $em = $this->getDoctrine()->getManager();
            $form = $this->createForm('covoiturage\userBundle\Form\annonceType', $rate);
            $form->handleRequest($request);
            $em = $this->getDoctrine()->getManager();
            $ok=$em->getRepository('covoiturageuserBundle:annonce')->find($id);

            $ok1=$em->getRepository('covoiturageuserBundle:reservations')->findOneBy(array('Annonce'=>$id));

//anis trajet
            //get rajet:

            $traj=$ok->getTrajet();
            $ok2=$em->getRepository('covoiturageuserBundle:trajet')->find($traj);
            //get ville

            $ville_depart=$ok2->getVilleDepart();
            $ville_destination=$ok2->getVilleArrive();
            $ok3=$em->getRepository('covoiturageuserBundle:ville')->find($ville_depart);
            $ok4=$em->getRepository('covoiturageuserBundle:ville')->find($ville_destination);
            // lattitude + longitude

            $lat_arrive=$ok3->getLatitude();
            $long_arrive=$ok3->getLongitude();
            $lat_destination=$ok4->getLatitude();
            $long_destination=$ok4->getLongitude();



            $em=$this->getDoctrine()->getManager();


            $annonce=$em->getRepository('covoiturageuserBundle:annonce')->findOneBy((array('id'=>$id)));



            $id_chauffeur=$annonce->getMembre();



            $nb_places=$annonce->getNbPlaces();


            $ress=$em->getRepository('covoiturageuserBundle:reservations')->findOneBy(array('Annonce'=>$annonce));
            if($form->isSubmitted()){
                $rate0=$form->get('rating')->getData();


                $nb0=$annonce->getNbrrate();
                $nb1=$annonce->getNbrrate()+1;
                $rateA=$annonce->getRating();
                $rate1= (($nb0*$rateA)+$rate0)/$nb1;
                $rate1=ceil($rate1);
                $annonce->setNbrrate($annonce->getNbrrate()+1);
                $annonce->setRating($rate1);
                $em->persist($annonce);
                $em->flush();
                return $this->render('@covoituragemembre/annonce/resAnn.html.twig',array('ann'=>$ok,'res'=>$ok1,'form' => $form->createView(),'lat_arrive'=>$lat_arrive,'long_arrive'=>$long_arrive,'lat_destination'=>$lat_destination,'long_destination'=>$long_destination
                ));
            }

            if($request->isMethod('post')){

                if ($ress != null) {


                    $pas2 = $ress->getPassager2();

                    if ($pas2 == null) {
                        $ress->setPassager2($this->getUser());

                        $annonce->setNbPlaces($nb_places - 1);



                        $ress->setDateReservation(new \DateTime('now'));
                        $em->persist($ress);
                        $em->persist($annonce);
                        $em->flush();
                        if( $request->get('methode') == 'es'){
                            return $this->redirectToRoute('mes_reservations');
                        }else{
                            return $this->redirectToRoute('pai_annonce');
                        }


                    }

                    $pas3 = $ress->getPassager3();
                    if ($pas3 == null) {
                        $ress->setPassager3($this->getUser());

                        $annonce->setNbPlaces($nb_places - 1);
                        $ress->setDateReservation(new \DateTime('now'));


                        $em->persist($ress);
                        $em->persist($annonce);
                        $em->flush();
                        if( $request->get('methode') == 'es'){
                            return $this->redirectToRoute('mes_reservations');
                        }else{
                            return $this->redirectToRoute('pai_annonce');
                        }

                    }
                    $pas4 = $ress->getPassager4();
                    if ($pas4 == null) {
                        $ress->setPassager4($this->getUser());

                        $annonce->setNbPlaces($nb_places - 1);
                        $ress->setDateReservation(null);




                        $em->persist($ress);
                        $em->persist($annonce);
                        $em->flush();
                        if( $request->get('methode') == 'es'){
                            return $this->redirectToRoute('mes_reservations');
                        }else{
                            return $this->redirectToRoute('pai_annonce');
                        }


                    }

                }

                else {
                    $ress1 = new reservations();
                    $ress1->setAnnonce($annonce);
                    $ress1->setChauffeur($id_chauffeur);
                    $ress1->setPassager1($this->getUser());

                    $ress1->setDateReservation(new \DateTime('now'));

                    $annonce->setNbPlaces($nb_places - 1);


                    $em->persist($ress1);
                    $em->persist($annonce);
                    $em->flush();
                    if( $request->get('methode') == 'es'){
                        return $this->redirectToRoute('mes_reservations');
                    }else{
                        return $this->redirectToRoute('pai_annonce');
                    }


                }


                return $this->render('covoiturageuserBundle::contact.html.twig');

            }
            return $this->render('@covoituragemembre/annonce/resAnn.html.twig'
                ,array('ann'=>$ok,'res'=>$ok1,'form' => $form->createView(),'lat_arrive'=>$lat_arrive,'long_arrive'=>$long_arrive,'lat_destination'=>$lat_destination,'long_destination'=>$long_destination
                ));
        }else{
            $this->redirectToRoute('fos_user_registration_register');

            return $this->render('@covoituragemembre/annonce/resAnn.html.twig');
        }
    }

    public function paiAction(){

        return $this->render('covoituragemembreBundle:annonce:paiement.html.twig');
    }
}

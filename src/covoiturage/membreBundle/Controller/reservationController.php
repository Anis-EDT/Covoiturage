<?php

namespace covoiturage\membreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class reservationController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }
    public function mesresAction(){
        $em = $this->getDoctrine()->getManager();
        $rese = $em->getRepository('covoiturageuserBundle:reservations')->findreservationById($this->getUser()->getID());
        return $this->render('@covoituragemembre/reservation/mesres.html.twig'
        ,array('rese'=>$rese));
    }
    public function removeAction()
    {
        $em = $this->getDoctrine()->getManager();
        $userc=$this->getUser();
        $rese1 = $em->getRepository('covoiturageuserBundle:reservations')->findOneBy(array('passager1' => $userc));
        $rese2 = $em->getRepository('covoiturageuserBundle:reservations')->findOneBy(array('passager2' => $userc));
        $rese3 = $em->getRepository('covoiturageuserBundle:reservations')->findOneBy(array('passager3' => $userc));
        $rese4 = $em->getRepository('covoiturageuserBundle:reservations')->findOneBy(array('passager4' => $userc));



        if($rese1!=null ){
            $rese1->setPassager1(null);
            if ($rese1->getNbplace() !== 4) {
                $rese1->setNbplace($rese1->getNbplace() + 1);
            }
            $em->persist($rese1);
            $em->flush();
            return $this->redirect($this->generateUrl('mes_reservations'));



        }


        if( $rese2!=null) {
            $rese2->setPassager2(null);
            if ($rese2->getNbplace() !== 4) {

                $rese2->setNbplace($rese2->getNbplace() + 1);
            }
            $em->persist($rese2);
            $em->flush();
            return $this->redirect($this->generateUrl('mes_reservations'));
        }
        if( $rese3!=null) {
            $rese3->setPassager3(null);
            if ($rese3->getNbplace() !== 4) {

                $rese3->setNbplace($rese3->getNbplace() + 1);
            }
            $em->persist($rese3);
            $em->flush();
            return $this->redirect($this->generateUrl('mes_reservations'));
        }
        if( $rese4!=null) {
            $rese4->setPassager4(null);
            if ($rese4->getNbplace() !== 4) {
                $rese4->setNbplace($rese4->getNbplace() + 1);
            }
            $em->persist($rese4);
            $em->flush();
            return $this->redirect($this->generateUrl('mes_reservations'));
        }




    }
}

<?php

namespace covoiturage\adminBundle\Controller;

use covoiturage\userBundle\Entity\Membre;
use Ob\HighchartsBundle\Highcharts\Highchart;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Endroid\OpenWeatherMap\Client;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class backController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }
    public function backAction(){
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('covoiturageuserBundle:Membre')->findAll();
        $tabmembre = array();
        $tabadmin = array();
        $tabsuper = array();
        foreach ($user as $value) {
            foreach ($value->getRoles() as $x) {
                if ($x == 'ROLE_ADMIN') {
                    array_push($tabadmin, $value);

                }
                if ($x == 'ROLE_MEMBRE') {
                    array_push($tabmembre, $value);
                }
                if ($x == 'ROLE_SUPER_ADMIN'){
                    array_push($tabsuper, $value);
                }
            }


        }
        $nbradmin = count($tabadmin);
        $nbrmembre = count($tabmembre);
        $nbrsuper =count($tabsuper);

        $ob1 = new Highchart();
        $ob1->chart->renderTo('piechart');
        $ob1->title->text('poucentage utilisateurs de site');
        $ob1->plotOptions->pie(array(
            'allowPointSelect' => true,
            'cursor' => 'pointer',
            'dataLabels' => array('enabled' => false),
            'showInLegend' => true
        ));
        $data = array(
            array('les Admins', $nbradmin * 100 / count($user)),
            array('les Membres', $nbrmembre * 100 / count($user)),
            array('les super admin', $nbrsuper * 100/count($user)),

        );
        $ob1->series(array(array('type' => 'pie', 'name' => 'Browser share', 'data' => $data)));





        $em = $this->getDoctrine()->getManager();
        $classes = $em->getRepository('covoiturageuserBundle:voiture')->findAll();
        $tab = array();
        $categories = array();
        foreach ($classes as $classe) {
            array_push($tab, $classe->getNbPlaces());
            array_push($categories, $classe->getMarque());
        }
        // Chart
        $series = array(
            array("name" => "Nb places", "data" => $tab)
        );
        $ob2 = new Highchart();
        $ob2->chart->renderTo('linechart'); // #id du div où afficher le graphe
        $ob2->title->text('Nombre des plcaes par marque de voiture');
        $ob2->xAxis->title(array('text' => "Marque"));
        $ob2->yAxis->title(array('text' => "Nb places"));
        $ob2->xAxis->categories($categories);
        $ob2->series($series);


        $user1 = $em->getRepository('covoiturageuserBundle:reclamations')->findAll();

        $tabmembre = array();
        $tabsite = array();

        foreach ($user1 as $value) {


            if ($value->getSujet() == 'Membre') {
                array_push($tabmembre, $value);

            }
            if ($value->getSujet() == 'site') {
                array_push($tabsite, $value);
            }
        }
        $nbrmembre = count($tabmembre);
        $nbrsite = count($tabsite);


        $ob3 = new Highchart();
        $ob3->chart->renderTo('piechart');
        $ob3->title->text('poucentage de réclamation ');
        $ob3->plotOptions->pie(array(
            'allowPointSelect' => true,
            'cursor' => 'pointer',
            'dataLabels' => array('enabled' => false),
            'showInLegend' => true
        ));
        $data = array(
            array('les réclamations sur les membres', $nbrmembre * 100 / count($user)),
            array('les réclamations sur le site', $nbrsite * 100 / count($user)),


        );
        $ob3->series(array(array('type' => 'pie', 'name' => 'Browser share', 'data' => $data)));



        return $this->render('covoiturageadminBundle::backAdmin.html.twig'
        ,array('ob'=>$ob1,'ob1'=>$ob2,'ob2'=>$ob3));
    }

    public function utilAction(){
        $em = $this->getDoctrine()->getManager();
        $utils = $em->getRepository('covoiturageuserBundle:Membre')->findAll();
        $ok= array('ROLE_MEMBRE','ROLE_USER');
        return $this->render('covoiturageadminBundle::utlAdmin.html.twig', array(
            'utils' => $utils,'ok'=>$ok
        ));

    }
    public function admAction(){
        $em = $this->getDoctrine()->getManager();
        $utils = $em->getRepository('covoiturageuserBundle:Membre')->findAll();
        $ok= array('ROLE_ADMIN','ROLE_USER');
        return $this->render('covoiturageadminBundle::admAdmin.html.twig', array(
            'utils' => $utils,'ok'=>$ok
        ));

    }
    public function supAction(Request $request,$id){


            $em = $this->getDoctrine()->getManager();
        $ok=$em->getRepository('covoiturageuserBundle:Membre')->find($id);
            $em->remove($ok);
            $em->flush();

        return $this->redirectToRoute('covoiturageadmin_util');
    }
    public function sup1Action(Request $request,$id){


        $em = $this->getDoctrine()->getManager();
        $ok=$em->getRepository('covoiturageuserBundle:Membre')->find($id);
        $em->remove($ok);
        $em->flush();

        return $this->redirectToRoute('covoiturageadmin_adm');
    }
    public function admAddAction(Request $request){
        $adm=new Membre();
        if ($request->isMethod('post')){
            $em=$this->getDoctrine()->getManager();
            $adm->setUsername($request->get('login'));
            $adm->setPassword($request->get('pwd'));
            $adm->setEmail($request->get('mail'));
            $adm->setRoles(array('ROLE_ADMIN'));
            $adm->setEnabled(1);
            $adm->setPassword('$2y$13$0ytMj7ie8iJWLIXPfenKRO7gE298riO2oqAClwRIGJnnVre9mfwra');
            $adm->setPhotoMembre('photo_membre/1.jpg');
            $em->persist($adm);
            $em->flush();
            return $this->redirectToRoute('covoiturageadmin_adm');

        }


        return $this->render('covoiturageadminBundle::addAdmin.html.twig');
    }
    public function TemlistAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $ok = $em->getRepository('covoiturageuserBundle:temoignage')->findAll();
        $series = array(
            array("name" => "Data Serie Name", "data" => array(1, 2, 4, 5, 6, 3, 8))
        );
        $em = $this->getDoctrine()->getManager();

        /**
         * @var \Doctrine\ORM\QueryBuilder $qb
         */
        $qb = $em->createQueryBuilder();
        $qb
            ->select('r')
            ->from('covoiturageuserBundle:temoignage', 'r')
            ->orderBy('r.date_tem', 'DESC');
        $ok = $qb->getQuery()->getResult();
        if($request->isMethod('post')){
            $rech=$request->get('rech');
            $ok2 = $em->getRepository('covoiturageuserBundle:Membre')->findBy(
                array('nom'=>$rech)
            );
            $ok3 = $em->getRepository('covoiturageuserBundle:temoignage')->findBy(
                array('Membre'=>$ok2)
            );
            return $this->render('@covoiturageadmin/Default/temoigniages.html.twig', array('tem' => $ok3));
        }


        return $this->render('@covoiturageadmin/Default/temoigniages.html.twig', array('tem' => $ok));
    }
    public function annlistAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $ok=$em->getRepository('covoiturageuserBundle:annonce')->findAll();
        if($request->isMethod('post')){
            $rech=$request->get('rech');
            $ok4 = $em->getRepository('covoiturageuserBundle:Membre')->findBy(
                array('nom'=>$rech)
            );
            $ok2 = $em->getRepository('covoiturageuserBundle:annonce')->findBy(
                array('Membre'=>$ok4)
            );
            return $this->render('@covoiturageadmin/annonces.html.twig', array('annonces' => $ok2));
        }


        return $this->render('@covoiturageadmin/annonces.html.twig',array('annonces'=>$ok));
    }


    public function  supprimertemAction($id){
        $em = $this->getDoctrine()->getManager();
        $ok=$em->getRepository('covoiturageuserBundle:temoignage')->find($id);
        $em->remove($ok);
        $em->flush();


        return $this->redirectToRoute('temoi_list');
    }
    public function  supprimerannAction($id){
        $em = $this->getDoctrine()->getManager();
        $ok=$em->getRepository('covoiturageuserBundle:annonce')->find($id);
        $em->remove($ok);
        $em->flush();


        return $this->redirectToRoute('ann_list');
    }

    public function chtAction()
    {
        $client = $this->get('endroid.openweathermap.client');
        $weather = $client->getWeather('Breda,nl');
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('covoiturageuserBundle:Membre')->findAll();
        $tabmembre = array();
        $tabadmin = array();
        $tabsuper = array();
        foreach ($user as $value) {
            foreach ($value->getRoles() as $x) {
                if ($x == 'ROLE_ADMIN') {
                    array_push($tabadmin, $value);

                }
                if ($x == 'ROLE_MEMBRE') {
                    array_push($tabmembre, $value);
                }
                if ($x == 'ROLE_SUPER_ADMIN'){
                    array_push($tabsuper, $value);
                }
            }


        }
        $nbradmin = count($tabadmin);
        $nbrmembre = count($tabmembre);
        $nbrsuper =count($tabsuper);

        $ob = new Highchart();
        $ob->chart->renderTo('piechart');
        $ob->title->text('poucentage utilisateurs de site');
        $ob->plotOptions->pie(array(
            'allowPointSelect' => true,
            'cursor' => 'pointer',
            'dataLabels' => array('enabled' => false),
            'showInLegend' => true
        ));
        $data = array(
            array('les Admins', $nbradmin * 100 / count($user)),
            array('les Membres', $nbrmembre * 100 / count($user)),
            array('les super admin', $nbrsuper * 100/count($user)),

        );
        $ob->series(array(array('type' => 'pie', 'name' => 'Browser share', 'data' => $data)));





        return $this->render('covoiturageadminBundle::charts1.html.twig',
            array(
                'chart' => $ob
            ));


    }

    public function cht2Action(Request $reques)
    {
        $em = $this->getDoctrine()->getManager();
        $classes = $em->getRepository('covoiturageuserBundle:voiture')->findAll();
        $tab = array();
        $categories = array();
        foreach ($classes as $classe) {
            array_push($tab, $classe->getNbPlaces());
            array_push($categories, $classe->getMarque());
        }
        // Chart
        $series = array(
            array("name" => "Nb places", "data" => $tab)
        );
        $ob = new Highchart();
        $ob->chart->renderTo('linechart'); // #id du div où afficher le graphe
        $ob->title->text('Nombre des plcaes par marque de voiture');
        $ob->xAxis->title(array('text' => "Marque"));
        $ob->yAxis->title(array('text' => "Nb places"));
        $ob->xAxis->categories($categories);
        $ob->series($series);
        return $this->render('@covoiturageadmin/Default/charts2.html.twig',
            array(
                'chart' => $ob
            ));

    }


    public function cht3Action()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('covoiturageuserBundle:reclamations')->findAll();

        $tabmembre = array();
        $tabsite = array();

        foreach ($user as $value) {


            if ($value->getSujet() == 'Membre') {
                array_push($tabmembre, $value);

            }
            if ($value->getSujet() == 'site') {
                array_push($tabsite, $value);
            }
        }
        $nbrmembre = count($tabmembre);
        $nbrsite = count($tabsite);


        $ob = new Highchart();
        $ob->chart->renderTo('piechart');
        $ob->title->text('poucentage de réclamation ');
        $ob->plotOptions->pie(array(
            'allowPointSelect' => true,
            'cursor' => 'pointer',
            'dataLabels' => array('enabled' => false),
            'showInLegend' => true
        ));
        $data = array(
            array('les réclamations sur les membres', $nbrmembre * 100 / count($user)),
            array('les réclamations sur le site', $nbrsite * 100 / count($user)),


        );
        $ob->series(array(array('type' => 'pie', 'name' => 'Browser share', 'data' => $data)));
        return $this->render('@covoiturageadmin/charts3.html.twig',
            array(
                'chart' => $ob
            ));

    }



    public function afficherRAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        /**
         * @var \Doctrine\ORM\QueryBuilder $qb
         */
        $qb = $em->createQueryBuilder();
        $qb
            ->select('r')
            ->from('covoiturageuserBundle:reclamations', 'r')
            ->orderBy('r.date', 'DESC');

        if($request->isMethod("POST"))
        {
            if ($request->request->get('only_attente'))
            {
                $qb->where("r.reponse = 'En attante de reponse'");
            }
            elseif ($request->request->get('recher'))
            {
                $date = $request->get('rech');

                $qb->where("r.date='$date'");
            }
            else
            {
                $sujet = $request->get('recherche');

                $qb->where('r.sujet = ?1');
                $qb->setParameter('1', $sujet);
            }
        }

        dump($request->request->all());

        //if ($request->request->get('only_attente'))
        {
            //;
        }

        $reclamation = $qb->getQuery()->getResult();



        return $this->render('covoiturageadminBundle:reclamation:afficher.html.twig', array('reclamations' => $reclamation));
    }

    public function supprimerRAction($id)
    {

        $em=$this->getDoctrine()->getManager();
        $reclamation=$em->getRepository('covoiturageuserBundle:reclamations')->find($id);
        $em->remove($reclamation);
        $em->flush();
        return $this->redirectToRoute('covoiturageadmin_afficherReclamation');

    }
    public function repondreAction(Request $request)
    {
        $rec_id = $request->get('id');
        $rec_reponse = $request->get('reponse');

        $em=$this->getDoctrine()->getManager();
        /**
         * @var reclamations $reclamation
         */
        $reclamation=$em->getRepository('covoiturageuserBundle:reclamations')->find($rec_id);
        $reclamation->setReponse($rec_reponse);
        $em->persist($reclamation);
        $em->flush();

        return $this->redirectToRoute('covoiturageadmin_afficherReclamation');
    }


    public function exAction(Request $request)
    {
        // ask the service for a Excel5
        $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject();

        $phpExcelObject->getProperties()->setCreator("liuggio")
            ->setLastModifiedBy("Giulio De Donato")
            ->setTitle("Office 2005 XLSX Test Document")
            ->setSubject("Office 2005 XLSX Test Document")
            ->setDescription("Test document for Office 2005 XLSX, generated using PHP classes.")
            ->setKeywords("office 2005 openxml php")
            ->setCategory("Test result file");
        $phpExcelObject->setActiveSheetIndex(0)
            ->setCellValue('A1', 'id')
            ->setCellValue('B1', 'sujet')
            ->setCellValue('C1', 'date')
            ->setCellValue('D1', 'membre')
            ->setCellValue('E1', 'message')
            ->setCellValue('F1', 'reponse');;


        $em=$this->getDoctrine()->getManager();
        $reclamation=$em->getRepository('covoiturageuserBundle:reclamations')->findAll();

        $aux=2;
        foreach ($reclamation as $reclamations){
            $phpExcelObject->setActiveSheetIndex(0)->setCellValue('A'.$aux, $reclamations->getId())
                ->setCellValue('B'.$aux, $reclamations->getSujet())->setCellValue('C'.$aux, $reclamations->getDate())->setCellValue('D'.$aux, $reclamations->getMembre())->setCellValue('E'.$aux, $reclamations->getMessage())->setCellValue('F'.$aux, $reclamations->getReponse());
            $aux++;


        };
        $phpExcelObject->getActiveSheet()->setTitle('Simple');
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $phpExcelObject->setActiveSheetIndex(0);

        // create the writer
        $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel5');
        // create the response
        $response = $this->get('phpexcel')->createStreamedResponse($writer);
        // adding headers
        $dispositionHeader = $response->headers->makeDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            'Liste-des-Reclamations.xls'
        );
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');
        $response->headers->set('Content-Disposition', $dispositionHeader);

        return $response;
    }


}

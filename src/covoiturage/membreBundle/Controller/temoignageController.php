<?php

namespace covoiturage\membreBundle\Controller;

use covoiturage\userBundle\Entity\temoignage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Temoignage controller.
 *
 */
class temoignageController extends Controller
{
    /**
     * Lists all temoignage entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $temoignages = $em->getRepository('covoiturageuserBundle:temoignage')->findBy(array('Membre'=>$this->getUser()));

        return $this->render('covoituragemembreBundle:temoignage:index.html.twig', array(
            'temoignages' => $temoignages,
        ));
    }

    /**
     * Creates a new temoignage entity.
     *
     */
    public function newAction(Request $request)
    {
        $temoignage = new Temoignage();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm('covoiturage\userBundle\Form\temoignageType', $temoignage);
        $userc = $this->getUser()->getId();

        $user2=$em->getRepository('covoiturageuserBundle:Membre')->findOneBy(array('id'=>$userc));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $temoignage->setMembre($user2);
            $date3 = new \DateTime('now');
            $temoignage->setDateTem($date3);
            $em->persist($temoignage);
            $em->flush($temoignage);

            return $this->redirectToRoute('temoignage_show', array('id' => $temoignage->getId()));
        }

        return $this->render('@covoituragemembre/temoignage/new.html.twig', array(
            'temoignage' => $temoignage,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a temoignage entity.
     *
     */
    public function showAction(temoignage $temoignage)
    {
        $deleteForm = $this->createDeleteForm($temoignage);

        return $this->render('@covoituragemembre/temoignage/show.html.twig', array(
            'temoignage' => $temoignage,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing temoignage entity.
     *
     */
    public function editAction(Request $request, temoignage $temoignage)
    {
        $deleteForm = $this->createDeleteForm($temoignage);
        $editForm = $this->createForm('covoiturage\userBundle\Form\temoignageType', $temoignage);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('temoignage_edit', array('id' => $temoignage->getId()));
        }

        return $this->render('@covoituragemembre/temoignage/edit.html.twig', array(
            'temoignage' => $temoignage,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a temoignage entity.
     *
     */
    public function deleteAction(Request $request, temoignage $temoignage)
    {
        $form = $this->createDeleteForm($temoignage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($temoignage);
            $em->flush($temoignage);
        }

        return $this->redirectToRoute('temoignage_index');
    }

    /**
     * Creates a form to delete a temoignage entity.
     *
     * @param temoignage $temoignage The temoignage entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(temoignage $temoignage)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('temoignage_delete', array('id' => $temoignage->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

}

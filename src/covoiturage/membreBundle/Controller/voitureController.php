<?php

namespace covoiturage\membreBundle\Controller;

use covoiturage\userBundle\Entity\voiture;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * voiture controller.
 *
 */
class voitureController extends Controller
{
    /**
     * Lists all voitures entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $voiture = $em->getRepository('covoiturageuserBundle:voiture')->findBy(array('chauffeur'=>$this->getUser()));
      //  $voiture = $em->getRepository('covoiturageuserBundle:temoignage')->findBy(array('Membre'=>$this->getUser()));


        return $this->render('covoituragemembreBundle:voiture:index.html.twig', array(
            'voiture' => $voiture,
        ));
    }

    /**
     * Creates a new voiture entity.
     *
     */
   public function newAction(Request $request)
    {
        $voiture = new voiture();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm('covoiturage\userBundle\Form\voitureType', $voiture);
        $userc = $this->getUser()->getId();

        $user2=$em->getRepository('covoiturageuserBundle:Membre')->findOneBy(array('id'=>$userc));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $voiture->setChauffeur($user2);
            $em->persist($voiture);
            $em->flush();

            return $this->redirectToRoute('voiture_show', array('id' => $voiture->getId()));
        }

        return $this->render('@covoituragemembre/voiture/new.html.twig', array(
            'voiture' => $voiture,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a voiture
     * entity.
     *
     */
    public function showAction(voiture $voiture)
    {
        $deleteForm = $this->createDeleteForm($voiture);

        return $this->render('@covoituragemembre/voiture/show.html.twig', array(
            'voiture' => $voiture,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing voiture entity.
     *
     */
    public function editAction(Request $request, voiture $voiture)
    {
        $deleteForm = $this->createDeleteForm($voiture);
        $editForm = $this->createForm('covoiturage\userBundle\Form\voitureType', $voiture);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('voiture_index');
        }

        return $this->render('@covoituragemembre/voiture/edit.html.twig', array(
            'voiture' => $voiture,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a voiture entity.
     *
     */
    public function deleteAction(Request $request, voiture $voiture)
    {
        $form = $this->createDeleteForm($voiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($voiture);
            $em->flush();
        }

        return $this->redirectToRoute('voiture_index');
    }

    /**
     * Creates a form to delete a voiture entity.
     *
     * @param voiture voiture The voiture entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(voiture $voiture)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('voiture_delete', array('id' => $voiture->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

}

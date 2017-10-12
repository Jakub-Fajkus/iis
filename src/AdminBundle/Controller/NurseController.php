<?php

namespace AdminBundle\Controller;

use AdminBundle\Form\NurseType;
use AppBundle\Entity\Nurse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Nurse controller.
 *
 * @Route("nurse")
 */
class NurseController extends Controller
{
    /**
     * Lists all nurse entities.
     *
     * @Route("/", name="admin_nurse_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $nurses = $em->getRepository(Nurse::class)->findAll();

        return $this->render('nurse/index.html.twig', array(
            'nurses' => $nurses,
        ));
    }

    /**
     * Creates a new nurse entity.
     *
     * @Route("/new", name="admin_nurse_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $nurse = new Nurse();
        $form = $this->createForm(NurseType::class, $nurse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $this->get('fos_user.user_manager')->updateUser($nurse);

            return $this->redirectToRoute('admin_nurse_show', array('id' => $nurse->getId()));
        }

        return $this->render('nurse/new.html.twig', array(
            'nurse' => $nurse,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a nurse entity.
     *
     * @Route("/{id}", name="admin_nurse_show")
     * @Method("GET")
     */
    public function showAction(Nurse $nurse)
    {
        $deleteForm = $this->createDeleteForm($nurse);

        return $this->render('nurse/show.html.twig', array(
            'nurse' => $nurse,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing nurse entity.
     *
     * @Route("/{id}/edit", name="admin_nurse_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Nurse $nurse)
    {
        $deleteForm = $this->createDeleteForm($nurse);
        $editForm = $this->createForm(NurseType::class, $nurse);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->get('fos_user.user_manager')->updateUser($nurse);

            return $this->redirectToRoute('admin_nurse_edit', array('id' => $nurse->getId()));
        }

        return $this->render('nurse/edit.html.twig', array(
            'nurse' => $nurse,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a nurse entity.
     *
     * @Route("/{id}", name="admin_nurse_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Nurse $nurse)
    {
        $form = $this->createDeleteForm($nurse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($nurse);
            $em->flush();
        }

        return $this->redirectToRoute('admin_nurse_index');
    }

    /**
     * Creates a form to delete a nurse entity.
     *
     * @param Nurse $nurse The nurse entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Nurse $nurse)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_nurse_delete', array('id' => $nurse->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

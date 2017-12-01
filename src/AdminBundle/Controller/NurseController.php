<?php

namespace AdminBundle\Controller;

use AdminBundle\Form\NurseType;
use AppBundle\Entity\Employee;
use AppBundle\Entity\Nurse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Nurse controller.
 *
 * @Route("nurse")
 */
class NurseController extends BaseAdminController
{
    /**
     * Creates a new nurse entity.
     *
     * @Route("/new", name="admin_nurse_new")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $nurse = new Nurse();
        $form = $this->createForm(NurseType::class, $nurse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $nurse->addRole(Employee::ROLE_NURSE);

            $this->get('fos_user.user_manager')->updateUser($nurse);

            $this->addSuccessfullySavedFlash();

            return $this->redirectToRoute('admin_nurse_show', ['id' => $nurse->getId()]);
        }

        return $this->render('admin/nurse/new.html.twig', [
            'nurse' => $nurse,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Finds and displays a nurse entity.
     *
     * @Route("/{id}", name="admin_nurse_show")
     * @Method("GET")
     * @param Nurse $nurse
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Nurse $nurse)
    {
        return $this->render('admin/nurse/show.html.twig', [
            'nurse' => $nurse,
        ]);
    }

    /**
     * Displays a form to edit an existing nurse entity.
     *
     * @Route("/{id}/edit", name="admin_nurse_edit")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param Nurse   $nurse
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, Nurse $nurse)
    {
        $editForm = $this->createForm(NurseType::class, $nurse);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->get('fos_user.user_manager')->updateUser($nurse);

            $this->addSuccessfullySavedFlash();

            return $this->redirectToRoute('admin_nurse_edit', ['id' => $nurse->getId()]);
        }

        return $this->render('admin/nurse/edit.html.twig', [
            'nurse' => $nurse,
            'edit_form' => $editForm->createView(),
        ]);
    }
}

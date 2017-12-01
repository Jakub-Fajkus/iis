<?php

namespace AdminBundle\Controller;

use AdminBundle\Form\EmployeeType;
use AppBundle\Entity\Employee;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Admin controller.
 *
 * @Route("admin")
 */
class AdminController extends BaseAdminController
{
    /**
     * Creates a new admin.
     *
     * @Route("/new", name="admin_admin_new")
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $employee = new Employee();
        $form = $this->createForm(EmployeeType::class, $employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $employee->addRole(Employee::ROLE_ADMIN);
            $employee->addRole(Employee::ROLE_ADMIN);

            $this->get('fos_user.user_manager')->updateUser($employee);

            $this->addSuccessfullySavedFlash();

            return $this->redirectToRoute('admin_admin_show', ['id' => $employee->getId()]);
        }

        return $this->render('admin/admin/new.html.twig', [
            'admin' => $employee,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Finds and displays a employee entity.
     *
     * @Route("/{id}", name="admin_admin_show")
     * @Method("GET")
     */
    public function showAction(Employee $employee)
    {
        return $this->render('admin/admin/show.html.twig', [
            'admin' => $employee,
        ]);
    }

    /**
     * Displays a form to edit an existing employee entity.
     *
     * @Route("/{id}/edit", name="admin_admin_edit")
     * @Method({"GET", "POST"})
     *
     * @param Request  $request
     * @param Employee $employee
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, Employee $employee)
    {
        $editForm = $this->createForm(EmployeeType::class, $employee);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->get('fos_user.user_manager')->updateUser($employee);

            $this->addSuccessfullySavedFlash();

            return $this->redirectToRoute('admin_admin_edit', ['id' => $employee->getId()]);
        }

        return $this->render('admin/admin/edit.html.twig', [
            'admin' => $employee,
            'edit_form' => $editForm->createView(),
        ]);
    }
}

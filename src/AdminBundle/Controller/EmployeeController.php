<?php

namespace AdminBundle\Controller;

use AdminBundle\Form\EmployeeType;
use AppBundle\Entity\Employee;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Employee controller.
 *
 * @Route("employee")
 */
class EmployeeController extends Controller
{
    /**
     * Lists all employee entities.
     *
     * @Route("/", name="admin_employee_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $employees = $em->getRepository(Employee::class)->findAll();

        return $this->render('admin/employee/index.html.twig', [
            'employees' => $employees,
        ]);
    }

    /**
     * Creates a new employee entity.
     *
     * @Route("/new", name="admin_employee_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $employee = new Employee();
        $form = $this->createForm(EmployeeType::class, $employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('fos_user.user_manager')->updateUser($employee);

            return $this->redirectToRoute('admin_employee_show', ['id' => $employee->getId()]);
        }

        return $this->render('admin/employee/new.html.twig', [
            'employee' => $employee,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Finds and displays a employee entity.
     *
     * @Route("/{id}", name="admin_employee_show")
     * @Method("GET")
     */
    public function showAction(Employee $employee)
    {
        $deleteForm = $this->createDeleteForm($employee);

        return $this->render('admin/employee/show.html.twig', [
            'employee' => $employee,
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    /**
     * Displays a form to edit an existing employee entity.
     *
     * @Route("/{id}/edit", name="admin_employee_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Employee $employee)
    {
        $deleteForm = $this->createDeleteForm($employee);
        $editForm = $this->createForm(EmployeeType::class, $employee);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->get('fos_user.user_manager')->updateUser($employee);
            return $this->redirectToRoute('admin_employee_edit', array('id' => $employee->getId()));
        }

        return $this->render('admin/employee/edit.html.twig', [
            'employee' => $employee,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    /**
     * Deletes a employee entity.
     *
     * @Route("/{id}", name="admin_employee_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Employee $employee)
    {
        $form = $this->createDeleteForm($employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($employee);
            $em->flush();
        }

        return $this->redirectToRoute('admin_employee_index');
    }

    /**
     * Creates a form to delete a employee entity.
     *
     * @param Employee $employee The employee entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Employee $employee)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_employee_delete', ['id' => $employee->getId()]))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

<?php

namespace AdminBundle\Controller;

use AdminBundle\Form\DepartmentType;
use AppBundle\Entity\Department;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Department controller.
 *
 * @Route("department")
 */
class DepartmentController extends BaseAdminController
{
    /**
     * Lists all department entities.
     *
     * @Route("/", name="admin_department_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $departments = $em->getRepository('AppBundle:Department')->findAll();

        $pagination = $this->get('app.pagination');
        $res = $pagination->handlePageWithPagination($departments, (int)$request->query->get('page', 1), 'departments');
        if (\array_key_exists('redirectPage', $res)) {
            return $this->redirectToRoute('admin_department_index', $pagination->getRedirectParams($request));
        }


        return $this->render('admin/department/index.html.twig', $res);
    }

    /**
     * Creates a new department entity.
     *
     * @Route("/new", name="admin_department_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $department = new Department();
        $form = $this->createForm(DepartmentType::class, $department);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($department);
            $em->flush();

            $this->addSuccessfullySavedFlash();

            return $this->redirectToRoute('admin_department_show', array('id' => $department->getId()));
        }

        return $this->render('admin/department/new.html.twig', array(
            'department' => $department,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a department entity.
     *
     * @Route("/{id}", name="admin_department_show")
     * @Method("GET")
     */
    public function showAction(Department $department)
    {
        return $this->render('admin/department/show.html.twig', array(
            'department' => $department,
        ));
    }

    /**
     * Displays a form to edit an existing department entity.
     *
     * @Route("/{id}/edit", name="admin_department_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Department $department)
    {
        $editForm = $this->createForm(DepartmentType::class, $department);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addSuccessfullySavedFlash();

            return $this->redirectToRoute('admin_department_edit', array('id' => $department->getId()));
        }

        return $this->render('admin/department/edit.html.twig', array(
            'department' => $department,
            'edit_form' => $editForm->createView(),
        ));
    }
}

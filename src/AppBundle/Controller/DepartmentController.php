<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Department;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Department controller.
 *
 * @Route("department")
 */
class DepartmentController extends Controller
{
    /**
     * Lists all department entities.
     *
     * @Route("/", name="app_department_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $departments = $em->getRepository('AppBundle:Department')->findAll();

        return $this->render(':app/department:index.html.twig', array(
            'departments' => $departments,
        ));
    }

    /**
     * Finds and displays a department entity.
     *
     * @Route("/{id}", name="app_department_show")
     * @Method("GET")
     */
    public function showAction(Department $department)
    {

        return $this->render('app/department/show.html.twig', array(
            'department' => $department,
        ));
    }
}

<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Department;
use AppBundle\Entity\Hospitalization;
use AppBundle\Entity\Patient;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Department controller.
 *
 * @Route("department")
 */
class DepartmentController extends BaseAppController
{
    /**
     * Lists all department entities.
     *
     * @Route("/", name="app_department_index")
     * @Method("GET")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $user = $this->getUser();
        if ($user->isAdmin()) {
            $departments = $this->getDoctrine()->getRepository(Department::class)->findAll();
        } else {
            $departments = $user->getDepartments();
        }

        $pagination = $this->get('app.pagination');
        $res = $pagination->handlePageWithPagination($departments, (int)$request->query->get('page', 1), 'departments');
        if (\array_key_exists('redirectPage', $res)) {
            return $this->redirectToRoute('app_department_index', $pagination->getRedirectParams($request));
        }

        return $this->render(':app/department:index.html.twig', $res);
    }

    /**
     * Finds and displays a department entity.
     *
     * @Route("/{id}", name="app_department_show")
     * @Method("GET")
     */
    public function showAction(Department $department)
    {
        $hospitalizations = $this->getDoctrine()->getRepository(Hospitalization::class)->getAllHospitalizationsOn($department);

        return $this->render('app/department/show.html.twig', array(
            'hospitalizations' => $hospitalizations,
            'department' => $department,
        ));
    }
}

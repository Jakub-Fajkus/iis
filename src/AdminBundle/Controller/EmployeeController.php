<?php

namespace AdminBundle\Controller;

use AppBundle\Entity\Employee;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Employee controller.
 *
 * @Route("employee")
 */
class EmployeeController extends BaseAdminController
{
    /**
     * Lists all employee entities.
     *
     * @Route("/", name="admin_employee_index")
     * @Method("GET")
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        //todo: pridat search jako je u pacientu? pripadne jej pridat k lekum, oddelenim?
        $em = $this->getDoctrine()->getManager();

        $employees = $em->getRepository(Employee::class)->findAll();
        $pagination = $this->get('app.pagination');
        $res = $pagination->handlePageWithPagination($employees, (int)$request->query->get('page', 1), 'employees');
        if (\array_key_exists('redirectPage', $res)) {
            return $this->redirectToRoute('admin_employee_index', $pagination->getRedirectParams($request));
        }

        return $this->render('admin/employee/index.html.twig', $res);
    }
}

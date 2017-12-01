<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Drug;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class DrugController
 *
 * @Route("drug")
 */
class DrugController extends BaseAppController
{
    /**
     * Lists all drug entities.
     *
     * @Route("/", name="app_drug_index")
     * @Method("GET")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $drugs = $em->getRepository('AppBundle:Drug')->findAll();

        $pagination = $this->get('app.pagination');
        $res = $pagination->handlePageWithPagination($drugs, (int)$request->query->get('page', 1), 'drugs');
        if (\array_key_exists('redirectPage', $res)) {
            return $this->redirectToRoute('app_drug_index', $pagination->getRedirectParams($request));
        }

        return $this->render('app/drug/index.html.twig', $res);
    }

    /**
     * Finds and displays a drug entity.
     *
     * @Route("/{id}", name="app_drug_show")
     * @Method("GET")
     */
    public function showAction(Drug $drug)
    {
        return $this->render('app/drug/show.html.twig', [
            'drug' => $drug,
        ]);
    }
}
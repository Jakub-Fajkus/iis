<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Drug;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class DrugController
 *
 * @Route("drug")
 */
class DrugController extends Controller
{
    /**
     * Lists all drug entities.
     *
     * @Route("/", name="app_drug_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $drugs = $em->getRepository('AppBundle:Drug')->findAll();

        return $this->render('app/drug/index.html.twig', [
            'drugs' => $drugs,
        ]);
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
<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Hospitalization;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Hospitalization controller.
 *
 * @Route("hospitalization")
 */
class HospitalizationController extends Controller
{
    /**
     * Lists all hospitalization entities.
     *
     * @Route("/", name="app_hospitalization_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        //todo: pro sestru vypsat jen informace pro jeji oddeleni
        $em = $this->getDoctrine()->getManager();

        $hospitalizations = $em->getRepository('AppBundle:Hospitalization')->findAll();

        return $this->render('app/hospitalization/index.html.twig', [
            'hospitalizations' => $hospitalizations,
        ]);
    }

    /**
     * Finds and displays a hospitalization entity.
     *
     * @Route("/{id}", name="app_hospitalization_show")
     * @Method("GET")
     */
    public function showAction(Hospitalization $hospitalization)
    {
        return $this->render('app/hospitalization/show.html.twig', [
            'hospitalization' => $hospitalization,
        ]);
    }
}

<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Hospitalization;
use AppBundle\Form\HospitalizePatientType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Hospitalization controller.
 *
 * @Route("hospitalization")
 */
class HospitalizationController extends BaseAppController
{
    /**
     * Lists all hospitalization entities.
     *
     * @Route("/", name="app_hospitalization_index")
     * @Method("GET")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        //todo: pro sestru vypsat jen informace pro jeji oddeleni
        $em = $this->getDoctrine()->getManager();

        $hospitalizations = $em->getRepository('AppBundle:Hospitalization')->findAll();

        $pagination = $this->get('app.pagination');
        $res = $pagination->handlePageWithPagination($hospitalizations, (int)$request->query->get('page', 1), 'hospitalizations');
        if (\array_key_exists('redirectPage', $res)) {
            return $this->redirectToRoute('app_hospitalization_index', $pagination->getRedirectParams($request));
        }

        return $this->render('app/hospitalization/index.html.twig', $res);
    }

    /**
     * Finds and displays a hospitalization entity.
     *
     * @Route("/{id}/stop", name="app_hospitalization_stop")
     * @Method("GET")
     * @Security("is_granted('ROLE_DOCTOR')")
     * @param Hospitalization $hospitalization
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function stopHospitalizationAction(Hospitalization $hospitalization): RedirectResponse
    {
        $hospitalization->setDateTo(new \DateTime());
        $em = $this->getDoctrine()->getManager();
        $em->persist($hospitalization);
        $em->flush();
        return $this->redirectToRoute('app_patient_show', ['id' => $hospitalization->getPatient()->getId()]);
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

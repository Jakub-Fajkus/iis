<?php

namespace AppBundle\Controller;

use AppBundle\Entity\DrugApplication;
use AppBundle\Entity\Prescription;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\DrugApplicationType;

/**
 * Drugapplication controller.
 *
 * @Route("drug-application")
 */
class DrugApplicationController extends BaseAppController
{
    /**
     * Lists all drugApplication entities.
     *
     * @Route("/", name="app_drug_application_index")
     * @Method("GET")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $drugApplications = $em->getRepository('AppBundle:DrugApplication')->findAll();

        $pagination = $this->get('app.pagination');
        $res = $pagination->handlePageWithPagination(
            $drugApplications,
            (int)$request->query->get('page', 1),
            'applications'
        );
        if (\array_key_exists('redirectPage', $res)) {
            return $this->redirectToRoute('app_drug_application_index', $pagination->getRedirectParams($request));
        }

        return $this->render(':app/drugApplication:index.html.twig', $res);
    }

    /**
     * Creates a new drugApplication entity.
     *
     * @Route("/prescription/{id}/new", name="app_drug_application_new")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param Prescription $prescription
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request, Prescription $prescription)
    {
        $drugApplication = new Drugapplication();
        $form = $this->createForm(DrugApplicationType::class, $drugApplication, ['prescription' => $prescription]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($drugApplication);
            $em->flush();

            $this->addSuccessfullySavedFlash();

            return $this->redirectToRoute(
                'app_patient_show',
                [
                    'id' => $prescription->getExamination()->getHospitalization()->getPatient()->getId()
                ]
            );
        }

        return $this->render('app/drugApplication/new.html.twig', [
            'drugApplication' => $drugApplication,
            'patientId' => $prescription->getExamination()->getHospitalization()->getPatient()->getId(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * Finds and displays a drugApplication entity.
     *
     * @Route("/{id}", name="app_drug_application_show")
     * @Method("GET")
     * @param DrugApplication $drugApplication
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(DrugApplication $drugApplication)
    {
        return $this->render('app/drugApplication/show.html.twig', [
            'drugApplication' => $drugApplication,
        ]);
    }

    /**
     * Displays a form to edit an existing drugApplication entity.
     *
     * @Route("/{id}/edit", name="app_drug_application_edit")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param DrugApplication $drugApplication
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, DrugApplication $drugApplication)
    {
        $editForm = $this->createForm(
            DrugApplicationType::class,
            $drugApplication,
            ['prescription' => $drugApplication->getPrescription()]
        );

        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addSuccessfullySavedFlash();

            return $this->redirectToRoute('app_drug_application_edit', ['id' => $drugApplication->getId()]);
        }

        return $this->render('app/drugApplication/edit.html.twig', [
            'drugApplication' => $drugApplication,
            'edit_form' => $editForm->createView(),
        ]);
    }
}

<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Examination;
use AppBundle\Entity\Prescription;
use AppBundle\Form\PrescriptionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Prescription controller.
 *
 * @Route("prescription")
 */
class PrescriptionController extends BaseAppController
{
    /**
     * Lists all prescription entities.
     *
     * @Route("/", name="app_prescription_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $prescriptions = $em->getRepository('AppBundle:Prescription')->findAll();
        $pagination = $this->get('app.pagination');
        $res = $pagination->handlePageWithPagination($prescriptions, (int)$request->query->get('page', 1), 'prescriptions');
        if (\array_key_exists('redirectPage', $res)) {
            return $this->redirectToRoute('app_prescription_index', $pagination->getRedirectParams($request));
        }

        return $this->render('app/prescription/index.html.twig', $res);
    }

    /**
     * Creates a new prescription entity.
     *
     * @Route("/examination/{id}/new", name="app_prescription_new")
     * @Method({"GET", "POST"})
     *
     * @param Request     $request
     * @param Examination $examination
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response     *
     */
    public function newAction(Request $request, Examination $examination)
    {
        $prescription = new Prescription();
        $form = $this->createForm(PrescriptionType::class, $prescription, ['examination' => $examination]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($prescription);
            $em->flush();

            $this->addSuccessfullySavedFlash();

            return $this->redirectToRoute('app_patient_show', ['id' => $examination->getHospitalization()->getPatient()->getId()]);
        }

        return $this->render('app/prescription/new.html.twig', [
            'prescription' => $prescription,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Finds and displays a prescription entity.
     *
     * @Route("/{id}", name="app_prescription_show")
     * @Method("GET")
     */
    public function showAction(Prescription $prescription)
    {
        return $this->render('app/prescription/show.html.twig', [
            'prescription' => $prescription,
        ]);
    }

    /**
     * Displays a form to edit an existing prescription entity.
     *
     * @Route("/{id}/edit", name="app_prescription_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Prescription $prescription)
    {
        $editForm = $this->createForm(
            PrescriptionType::class,
            $prescription,
            ['examination' => $prescription->getExamination()]
        );

        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addSuccessfullySavedFlash();

            return $this->redirectToRoute(
                'app_prescription_edit',
                ['id' => $prescription->getId()]
            );
        }

        return $this->render('app/prescription/edit.html.twig', [
            'prescription' => $prescription,
            'edit_form' => $editForm->createView(),
        ]);
    }
}

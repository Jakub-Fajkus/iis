<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Doctor;
use AppBundle\Entity\Patient;
use AppBundle\Form\HospitalizePatientType;
use AppBundle\Form\PatientType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Patient controller.
 *
 * @Route("patient")
 */
class PatientController extends Controller
{
    /**
     * Lists all patient entities.
     *
     * @Route("/", name="app_patient_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        if ($request->query->has('q')) {
            $query = $request->query->get('q');
            $patients = $this->getDoctrine()->getRepository(Patient::class)->getMatching($query);
        } else {
            $patients = $em->getRepository('AppBundle:Patient')->findAll();
        }

        return $this->render('app/patient/index.html.twig', [
            'patients' => $patients,
        ]);
    }

    /**
     * Creates a new patient entity.
     *
     * @Route("/new", name="app_patient_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $patient = new Patient();
        $form = $this->createForm(PatientType::class, $patient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($patient);
            $em->flush();

            return $this->redirectToRoute('app_patient_show', ['id' => $patient->getId()]);
        }

        return $this->render('app/patient/new.html.twig', [
            'patient' => $patient,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Finds and displays a patient entity.
     *
     * @Route("/{id}", name="app_patient_show")
     * @Method("GET")
     */
    public function showAction(Patient $patient)
    {
        $hospitalizeType = $this->createForm(
            HospitalizePatientType::class,
            null,
            [
                'action' => $this->generateUrl('app_patient_hospitalize', ['id' => $patient->getId()]),
            ]
        );

        return $this->render('app/patient/show.html.twig', [
            'patient' => $patient,
            'hospitalizeForm' => $hospitalizeType->createView(),
        ]);
    }

    /**
     * Displays a form to edit an existing patient entity.
     *
     * @Route("/{id}/edit", name="app_patient_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Patient $patient)
    {
        $editForm = $this->createForm(PatientType::class, $patient);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('app_patient_edit', ['id' => $patient->getId()]);
        }

        return $this->render('app/patient/edit.html.twig', [
            'patient' => $patient,
            'edit_form' => $editForm->createView(),
        ]);
    }

    /**
     * @Route("/{id}/hospitalize", name="app_patient_hospitalize")
     * @throws \Exception
     */
    public function hospitalizeAction(Request $request, Patient $patient)
    {
        $editForm = $this->createForm(HospitalizePatientType::class, null);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $doctor = $this->getUser();
            if (!$doctor instanceof Doctor) {
                throw new \Exception('Only doctor can hospitalize a patient!');
            }

            $patient->hospitalize($doctor, $editForm->get('department')->getData());
        }
    }
}

<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Doctor;
use AppBundle\Entity\Examination;
use AppBundle\Entity\Patient;
use AppBundle\Form\ExaminePatientType;
use AppBundle\Form\HospitalizePatientType;
use AppBundle\Form\PatientType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * Patient controller.
 *
 * @Route("patient")
 */
class PatientController extends BaseAppController
{
    /**
     * Lists all patient entities.
     *
     * @Route("/", name="app_patient_index")
     * @Method("GET")
     * @throws \LogicException
     */
    public function indexAction(Request $request)
    {
        $repo = $this->getDoctrine()->getRepository(Patient::class);

        if ($request->query->has('q')) {
            $query = $request->query->get('q');
            $patients = $repo->getMatching($query);
        } else {
            $patients = $repo->findAll();
        }

        $pagination = $this->get('app.pagination');
        $res = $pagination->handlePageWithPagination($patients, (int)$request->query->get('page', 1), 'patients');
        if (\array_key_exists('redirectPage', $res)) {
            return $this->redirectToRoute('app_patient_index', $pagination->getRedirectParams($request));
        }

        $res['searchValue'] = $request->query->get('q', '');
        if ($request->query->has('q')) {
            $res['showRemoveSearchButton'] = true;
        }

        return $this->render('app/patient/index.html.twig', $res);
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

            $this->addSuccessfullySavedFlash();

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
            [
                'dateFrom' => new \DateTime(),
                'doctor' => $this->getUser()
            ],
            [
                'action' => $this->generateUrl('app_patient_hospitalize', ['id' => $patient->getId()]),
            ]
        );

        $examineType = $this->createForm(
            ExaminePatientType::class,
            null,
            [
                'action' => $this->generateUrl('app_patient_examine', ['id' => $patient->getId()])
            ]
        );

        return $this->render('app/patient/show.html.twig', [
            'patient' => $patient,
            'hospitalizeForm' => $hospitalizeType->createView(),
            'examineForm' => $examineType->createView(),
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

            $this->addSuccessfullySavedFlash();

            return $this->redirectToRoute('app_patient_edit', ['id' => $patient->getId()]);
        }

        return $this->render('app/patient/edit.html.twig', [
            'patient' => $patient,
            'edit_form' => $editForm->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_DOCTOR")
     *
     * @Route("/{id}/hospitalize", name="app_patient_hospitalize")
     * @Method({"POST"})
     * @throws \Exception
     */
    public function hospitalizeAction(Request $request, Patient $patient)
    {
        $editForm = $this->createForm(HospitalizePatientType::class, null);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $doctor = $this->getUser();
            if (!$doctor instanceof Doctor) {
                $doctor = $this->getDoctrine()->getRepository(Doctor::class)->findAll()[0];
            }

            $hospitalization = $patient->hospitalize($doctor, $editForm->get('department')->getData());

            $this->getDoctrine()->getManager()->persist($hospitalization);
            $this->getDoctrine()->getManager()->flush();

            $this->addSuccessfullySavedFlash();
        }

        return $this->redirectToRoute('app_patient_show', ['id' => $patient->getId()]);
    }

    /**
     * @IsGranted("ROLE_DOCTOR")
     *
     * @Route("/{id}/examine", name="app_patient_examine")
     * @Method({"POST"})
     * @throws \Exception
     */
    public function examineAction(Request $request, Patient $patient)
    {
        $editForm = $this->createForm(ExaminePatientType::class, null);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $doctor = $this->getUser();

            $examination = (new Examination())
                ->setDoctor($doctor)
                ->setHospitalization($patient->getCurrentHospitalization())
                ->setReport($editForm->get('report')->getData());

            $this->getDoctrine()->getManager()->persist($examination);
            $this->getDoctrine()->getManager()->flush();

            $this->addSuccessfullySavedFlash();
        }

        return $this->redirectToRoute('app_patient_show', ['id' => $patient->getId()]);
    }
}

<?php

namespace AppBundle\Controller;

use AppBundle\Entity\DrugApplication;
use AppBundle\Entity\Prescription;
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
class DrugApplicationController extends Controller
{
    /**
     * Lists all drugApplication entities.
     *
     * @Route("/", name="app_drug_application_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $drugApplications = $em->getRepository('AppBundle:DrugApplication')->findAll();

        return $this->render(':app/drugApplication:index.html.twig', [
            'applications' => $drugApplications,
        ]);
    }

    /**
     * Creates a new drugApplication entity.
     *
     * @Route("/prescription/{id}/new", name="app_drug_application_new")
     * @Method({"GET", "POST"})
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

            return $this->redirectToRoute('app_drug_application_show', ['id' => $drugApplication->getId()]);
        }

        return $this->render('app/drugApplication/new.html.twig', [
            'drugApplication' => $drugApplication,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Finds and displays a drugApplication entity.
     *
     * @Route("/{id}", name="app_drug_application_show")
     * @Method("GET")
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

            return $this->redirectToRoute('app_drug_application_edit', ['id' => $drugApplication->getId()]);
        }

        return $this->render('app/drugApplication/edit.html.twig', [
            'drugApplication' => $drugApplication,
            'edit_form' => $editForm->createView(),
        ]);
    }
}

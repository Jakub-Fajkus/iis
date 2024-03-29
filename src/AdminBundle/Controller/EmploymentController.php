<?php

namespace AdminBundle\Controller;

use AdminBundle\Form\EmploymentType;
use AppBundle\Entity\Doctor;
use AppBundle\Entity\Employment;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Employment controller.
 *
 * @Route("doctor/{doctor_id}/employment")
 * @ParamConverter("doctor", class="AppBundle:Doctor",  options={"id" = "doctor_id"}))
 */
class EmploymentController extends BaseAdminController
{
    /**
     * Creates a new employment entity.
     *
     * @Route("/new", name="admin_employment_new")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param Doctor $doctor
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \LogicException
     * @throws \InvalidArgumentException
     */
    public function newAction(Request $request, Doctor $doctor)
    {
        $employment = new Employment();
        $form = $this->createForm(EmploymentType::class, $employment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $employment->setDoctor($doctor);
            $em = $this->getDoctrine()->getManager();
            $em->persist($employment);
            $em->flush();

            $this->addSuccessfullySavedFlash();

            return $this->redirectToRoute(
                'admin_employment_show',
                ['id' => $employment->getId(), 'doctor_id' => $doctor->getId()]
            );
        }

        return $this->render('admin/employment/new.html.twig', [
            'employment' => $employment,
            'form'       => $form->createView(),
            'doctorId'   => $doctor->getId(),
        ]);
    }

    /**
     * Finds and displays a employment entity.
     *
     * @Route("/{id}", name="admin_employment_show")
     * @Method("GET")
     * @param Employment $employment
     * @param Doctor $doctor
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Employment $employment, Doctor $doctor)
    {
        return $this->render('admin/employment/show.html.twig', [
            'employment'  => $employment,
            'doctorId'   => $doctor->getId(),
        ]);
    }

    /**
     * Displays a form to edit an existing employment entity.
     *
     * @Route("/{id}/edit", name="admin_employment_edit")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param Employment $employment
     * @param Doctor $doctor
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \LogicException
     * @throws \InvalidArgumentException
     */
    public function editAction(Request $request, Employment $employment, Doctor $doctor)
    {
        $editForm = $this->createForm(EmploymentType::class, $employment);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $employment->setDoctor($doctor);
            $this->getDoctrine()->getManager()->flush();

            $this->addSuccessfullySavedFlash();

            return $this->redirectToRoute(
                'admin_employment_edit',
                ['id' => $employment->getId(), 'doctor_id' => $doctor->getId()]
            );
        }

        return $this->render('admin/employment/edit.html.twig', [
            'employment'  => $employment,
            'edit_form'   => $editForm->createView(),
            'doctorId'   => $doctor->getId(),
        ]);
    }
}

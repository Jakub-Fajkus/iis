<?php

namespace AdminBundle\Controller;

use AppBundle\Entity\Doctor;
use AdminBundle\Form\DoctorType;
use AppBundle\Entity\Employment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Doctor controller.
 *
 * @Route("doctor")
 */
class DoctorController extends Controller
{
    /**
     * Lists all doctor entities.
     *
     * @Route("/", name="admin_doctor_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $doctors = $em->getRepository(Doctor::class)->findAll();

        return $this->render('admin/doctor/index.html.twig', [
            'doctors' => $doctors,
        ]);
    }

    /**
     * Creates a new doctor entity.
     *
     * @Route("/new", name="admin_doctor_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $doctor = new Doctor();
        $form = $this->createForm(DoctorType::class, $doctor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('fos_user.user_manager')->updateUser($doctor);

            return $this->redirectToRoute('admin_doctor_show', ['id' => $doctor->getId()]);
        }

        return $this->render('admin/doctor/new.html.twig', [
            'doctor' => $doctor,
            'form'   => $form->createView(),
        ]);
    }

    /**
     * Finds and displays a doctor entity.
     *
     * @Route("/{id}", name="admin_doctor_show")
     * @Method("GET")
     */
    public function showAction(Doctor $doctor)
    {
        $deleteForm = $this->createDeleteForm($doctor);
        $employments = $this->getDoctrine()->getRepository(Employment::class)->findBy(['doctor' => $doctor]);


        return $this->render('admin/doctor/show.html.twig', [
            'doctor'      => $doctor,
            'employments' => $employments,
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    /**
     * Displays a form to edit an existing doctor entity.
     *
     * @Route("/{id}/edit", name="admin_doctor_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Doctor $doctor)
    {
        $deleteForm = $this->createDeleteForm($doctor);
        $editForm = $this->createForm(DoctorType::class, $doctor);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->get('fos_user.user_manager')->updateUser($doctor);

            return $this->redirectToRoute('admin_doctor_edit', ['id' => $doctor->getId()]);
        }

        return $this->render('admin/doctor/edit.html.twig', [
            'doctor'      => $doctor,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    /**
     * Deletes a doctor entity.
     *
     * @Route("/{id}", name="admin_doctor_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Doctor $doctor)
    {
        $form = $this->createDeleteForm($doctor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($doctor);
            $em->flush();
        }

        return $this->redirectToRoute('admin_doctor_index');
    }

    /**
     * Creates a form to delete a doctor entity.
     *
     * @param Doctor $doctor The doctor entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Doctor $doctor)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_doctor_delete', ['id' => $doctor->getId()]))
            ->setMethod('DELETE')
            ->getForm();
    }
}

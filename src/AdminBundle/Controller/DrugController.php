<?php

namespace AdminBundle\Controller;

use AdminBundle\Form\DrugType;
use AppBundle\Entity\Drug;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Drug controller.
 *
 * @Route("drug")
 */
class DrugController extends Controller
{
    /**
     * Lists all drug entities.
     *
     * @Route("/", name="admin_drug_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $drugs = $em->getRepository('AppBundle:Drug')->findAll();

        return $this->render('admin/drug/index.html.twig', [
            'drugs' => $drugs,
        ]);
    }

    /**
     * Creates a new drug entity.
     *
     * @Route("/new", name="admin_drug_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $drug = new Drug();
        $form = $this->createForm(DrugType::class, $drug);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($drug);
            $em->flush();

            return $this->redirectToRoute('admin_drug_show', ['id' => $drug->getId()]);
        }

        return $this->render('admin/drug/new.html.twig', [
            'drug' => $drug,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Finds and displays a drug entity.
     *
     * @Route("/{id}", name="admin_drug_show")
     * @Method("GET")
     */
    public function showAction(Drug $drug)
    {
        $deleteForm = $this->createDeleteForm($drug);

        return $this->render('admin/drug/show.html.twig', [
            'drug' => $drug,
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    /**
     * Displays a form to edit an existing drug entity.
     *
     * @Route("/{id}/edit", name="admin_drug_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Drug $drug)
    {
        $deleteForm = $this->createDeleteForm($drug);
        $editForm = $this->createForm(DrugType::class, $drug);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_drug_edit', ['id' => $drug->getId()]);
        }

        return $this->render('admin/drug/edit.html.twig', [
            'drug' => $drug,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    /**
     * Deletes a drug entity.
     *
     * @Route("/{id}", name="admin_drug_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Drug $drug)
    {
        $form = $this->createDeleteForm($drug);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($drug);
            $em->flush();
        }

        return $this->redirectToRoute('admin_drug_index');
    }

    /**
     * Creates a form to delete a drug entity.
     *
     * @param Drug $drug The drug entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Drug $drug)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_drug_delete', ['id' => $drug->getId()]))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

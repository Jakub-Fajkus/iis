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
class DrugController extends BaseAdminController
{
    /**
     * Lists all drug entities.
     *
     * @Route("/", name="admin_drug_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $drugs = $em->getRepository('AppBundle:Drug')->findAll();
        $pagination = $this->get('app.pagination');
        $res = $pagination->handlePageWithPagination($drugs, (int)$request->query->get('page', 1), 'drugs');
        if (\array_key_exists('redirectPage', $res)) {
            return $this->redirectToRoute('admin_drug_index', $pagination->getRedirectParams($request));
        }
        return $this->render('admin/drug/index.html.twig', $res);
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

            $this->addSuccessfullySavedFlash();

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
        return $this->render('admin/drug/show.html.twig', [
            'drug' => $drug,
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
        $editForm = $this->createForm(DrugType::class, $drug);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addSuccessfullySavedFlash();

            return $this->redirectToRoute('admin_drug_edit', ['id' => $drug->getId()]);
        }

        return $this->render('admin/drug/edit.html.twig', [
            'drug' => $drug,
            'edit_form' => $editForm->createView(),
        ]);
    }
}

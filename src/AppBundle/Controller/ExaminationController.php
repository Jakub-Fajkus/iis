<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Examination;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\ExaminePatientType;

/**
 * Examination controller.
 *
 * @Route("examination")
 */
class ExaminationController extends Controller
{
    /**
     * Lists all examination entities.
     *
     * @Route("/", name="app_examination_index")
     * @Method("GET")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $examinations = $em->getRepository('AppBundle:Examination')->findAll();

        $pagination = $this->get('app.pagination');
        $res = $pagination->handlePageWithPagination($examinations, (int)$request->query->get('page', 1), 'examinations');
        if (\array_key_exists('redirectPage', $res)) {
            return $this->redirectToRoute('app_examination_index', $pagination->getRedirectParams($request));
        }

        return $this->render('app/examination/index.html.twig', $res);
    }

    /**
     * Creates a new examination entity.
     *
     * @Route("/new", name="app_examination_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $examination = new Examination();
        $form = $this->createForm(ExaminePatientType::class, $examination);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($examination);
            $em->flush();

            return $this->redirectToRoute('app_examination_show', ['id' => $examination->getId()]);
        }

        return $this->render('app/examination/new.html.twig', [
            'examination' => $examination,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Finds and displays a examination entity.
     *
     * @Route("/{id}", name="app_examination_show")
     * @Method("GET")
     */
    public function showAction(Examination $examination)
    {

        return $this->render('app/examination/show.html.twig', [
            'examination' => $examination,
        ]);
    }

    /**
     * Displays a form to edit an existing examination entity.
     *
     * @Route("/{id}/edit", name="app_examination_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Examination $examination)
    {
        $editForm = $this->createForm(ExaminePatientType::class, $examination);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('app_examination_edit', ['id' => $examination->getId()]);
        }

        return $this->render('app/examination/edit.html.twig', [
            'examination' => $examination,
            'edit_form' => $editForm->createView(),
        ]);
    }
}

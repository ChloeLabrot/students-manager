<?php

namespace App\Controller;


use App\Entity\Mark;
use App\Entity\Student;
use App\Form\MarkType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/** @Route("/mark/{id}", name="mark_") */
class MarkController extends AbstractController
{
    /**
     * @Route("/create", name="create")
     *
     * @ParamConverter("student", class="App\Entity\Student")
     *
     * @param Request $request
     * @param Student $student
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request, Student $student)
    {
        $form = $this->createForm(MarkType::class, new Mark());

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $mark = $form->getData();
            $mark->setStudent($student);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($mark);
            $entityManager->flush();

            return $this->redirectToRoute('student_index');
        }
        return $this->render('mark/create.html.twig', [
            'student'   => $student,
            'form'      => $form->createView(),
        ]);
    }
}
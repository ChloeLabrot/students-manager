<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\StudentType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/** @Route("/student", name="student_") */
class StudentController extends AbstractController
{

    /**
     * @Route("/", name="index")
     */
    public function listAction()
    {
        $students = $this->getDoctrine()->getRepository('App\Entity\Student')->findAll();

        return $this->render('student/list.html.twig', [
            'students' => $students,
        ]);
    }

    /**
     * @Route("/create", name="create")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {
        $form = $this->createForm(StudentType::class, new Student());

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $student = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($student);
            $entityManager->flush();

            return $this->redirectToRoute('student_index');
        }
        return $this->render('student/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/update/{id}", name="update")
     *
     * @ParamConverter("student", class="App\Entity\Student")
     *
     * @param Request $request
     * @param Student $student
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function updateAction(Request $request, Student $student)
    {
        $form = $this->createForm(StudentType::class, $student);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $student = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($student);
            $entityManager->flush();

            return $this->redirectToRoute('student_index');
        }
        return $this->render('student/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     *
     * @ParamConverter("student", class="App\Entity\Student")
     *
     * @param Student $student
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Student $student)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($student);
        $entityManager->flush();

        return $this->redirectToRoute('student_index');
    }
}
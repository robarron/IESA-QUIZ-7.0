<?php

namespace App\Controller;

use App\Entity\Quiz;
use App\Entity\Theme;
use App\Form\QuizType;
use App\Repository\QuizRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/quiz")
 */
class QuizController extends Controller
{
    /**
     * @Route("/", name="quiz_index", methods="GET")
     */
    public function index(QuizRepository $quizRepository): Response
    {
        return $this->render('quiz/index.html.twig', ['quizzes' => $quizRepository->findAll()]);
    }

    /**
     * @Route("/new", name="quiz_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $quiz = new Quiz();
        $form = $this->createForm(QuizType::class, $quiz);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($quiz);
            $em->flush();

            return $this->redirectToRoute('quiz_index');
        }

        return $this->render('quiz/new.html.twig', [
            'quiz' => $quiz,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="quiz_show", methods="GET")
     */
    public function show(Quiz $quiz): Response
    {
        return $this->render('quiz/show.html.twig', ['quiz' => $quiz]);
    }

    /**
     * @Route("/{id}/edit", name="quiz_edit", methods="GET|POST")
     */
    public function edit(Request $request, Quiz $quiz): Response
    {
        $form = $this->createForm(QuizType::class, $quiz);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('quiz_edit', ['id' => $quiz->getId()]);
        }

        return $this->render('quiz/edit.html.twig', [
            'quiz' => $quiz,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="quiz_delete", methods="DELETE")
     */
    public function delete(Request $request, Quiz $quiz): Response
    {
        if ($this->isCsrfTokenValid('delete'.$quiz->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($quiz);
            $em->flush();
        }

        return $this->redirectToRoute('quiz_index');
    }

    /**
     * @Route(
     *     name="get_one_question_by_theme",
     *     path="/themes/{themeId}/questions/{questionId}",
     *     methods={"GET"},
     *     defaults={
     *         "_api_resource_class"=Quiz::class,
     *         "_api_item_operation_name"="special"
     *     }
     * )
     */
    public function getOneQuestionByTheme($themeId)
    {
        $quiz = $this->getDoctrine()
            ->getRepository(Quiz::class)
            ->getQuestionByTheme($themeId);

        $formatted[] = [
            'question' => $quiz->getQuestion() ?: null,
            'reponse' => $quiz->getReponse() ? $quiz->getReponse() : null,
            'proposition_1' => $quiz->getProp1() ? $quiz->getReponse() : null,
            'proposition_2' => $quiz->getProp2() ? $quiz->getReponse() : null,
            'proposition_3' => $quiz->getProp3() ? $quiz->getReponse() : null,
            'proposition_4' => $quiz->getProp4() ? $quiz->getReponse() : null,
            'theme_id' => $quiz->getTheme() ? $quiz->getTheme() : null,
        ];
        return $formatted;
    }
}

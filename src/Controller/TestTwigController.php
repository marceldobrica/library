<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Yaml\Yaml;

class TestTwigController extends AbstractController
{

    #[Route("/blog/{page}", name: "app_testtwig_index", requirements: ["page" => "\d+"], defaults: ["page" =>1 ])]
    public function index(int $page, Request $request): Response
    {

        $form = $this->createFormBuilder()
            ->add('foo', CheckboxType::class, ['value' => 'bar'])
            ->add('submit', SubmitType::class)
            ->getForm();
        dump($form['foo']->getData());

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            dd($form['foo']->getData());

            // ... perform some action, such as saving the task to the database

        }

        $string = ["string" => "Multiple\nLine\nString"];
        $yaml = Yaml::dump($string, 1, 4, Yaml::DUMP_MULTI_LINE_LITERAL_BLOCK);
        dump($yaml);

        $this->addFlash('notice', 'First notice');
        $this->addFlash('notice', 'Second notice');
        $this->addFlash('error', 'First error');
        $this->addFlash('error', 'Second error');
        $stringul = (string) new ConstraintViolationList();
//        return new Response((string) new ConstraintViolationList());
        return $this->render('test_twig/index.html.twig', [
            'controller_name' => 'TestTwigController',
            'form' => $form->createView(),
        ]);
    }
}

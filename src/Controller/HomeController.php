<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TaskRepository;
use App\Controller\TaskController;
use Symfony\Component\HttpFoundation\Response;


class HomeController extends AbstractController
{
    /**
    * @var TaskRepository
    */
    private $repository;

    public function __construct(TaskRepository $repository)
    {
        $this->repository = $repository;
        // $this->em = $em;
    }

    /**
    * @Route("/home", name="home")
    */
    public function home()
    {
        $Tasks = $this->repository->findAll();
        // dump($Tasks);

        return $this->render('views/home.html.twig', [
            'Tasks' => $Tasks

        ]);

    }

    /**
    * @Route("/", name="home")
    */
    public function index()
    {
        $Tasks = $this->repository->findAll();
        // $countTasks = $this->countAll();
        // dump($Tasks);

        return $this->render('views/home.html.twig', [
            'Tasks' => $Tasks
            // 'countTasks' => $countTasks
        ]);

    }

    public function countAll()
    {
        // $this->em->getDoctrine()->getManager();
        $countTasks = $this->repository->countTasks();
        // dump($countTasks);
        return new Response($countTasks);

        // return $this->render('base.html.twig', [
        //     'countTasks' => $countTasks
        // ]);
    }
}

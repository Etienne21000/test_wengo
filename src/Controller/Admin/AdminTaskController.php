<?php
namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TaskRepository;
use Symfony\Component\HttpFoundation\Response;

class AdminTaskController extends AbstractController
{
    /**
    * @var TaskRepository
    */
    private $repository;

    public function __construct(TaskRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $Tasks = $this->repository->findAll();

        return $this->render('admin/task/index.html.twig', [
            'Tasks' => $Tasks
        ]);
    }

}

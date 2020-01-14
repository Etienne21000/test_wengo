<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TaskRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;


use App\Form\TaskType;
use App\Entity\Task;

class TaskController extends AbstractController
{
    /**
    * @var TaskRepository
    */
    private $repository;

    private $em;

    public function __construct(TaskRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
    * @Route("/addTask", name="addTask")
    */
    public function addTask(Request $request)
    {
        $task = new Task();

        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->em->persist($task);
            $this->em->flush();
            $this->addFlash('success', 'La tâche ' . $task->getTitle() . ' à bien été créée');
            return $this->redirectToRoute('allTasks');
        }

        return $this->render('views/createTask.html.twig', [
            'task' => $task,
            'form' => $form->createView()
        ]);
    }

    /**
    * @Route("/updateTaskForm/{id}", name="updateTaskForm")
    */
    public function updateTaskForm(Task $task, Request $request)
    {
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->em->persist($task);
            $this->em->flush();
            $this->addFlash('success', 'La tâche ' . $task->getTitle() . ' à bien été modifiée');
            return $this->redirectToRoute('allTasks');
        }

        return $this->render('views/updateTaskView.html.twig', [
            'task' => $task,
            'form' => $form->createView()
        ]);
    }

    /**
    * @Route("/allTasks", name="allTasks")
    */
    public function allTask()
    {
        $Tasks = $this->repository->findAll();

        return $this->render('views/allTasks.html.twig', [
            'Tasks' => $Tasks
        ]);
    }

    /**
    * @Route("/toDoTask", name="toDoTask")
    */
    public function ToDoTasks()
    {
        $Tasks = $this->repository->findToDoTasks();

        return $this->render('views/toDoView.html.twig', [
            'Tasks' => $Tasks
        ]);
    }

    /**
    * @Route("/inProgress", name="inProgress")
    */
    public function inProgTasks()
    {
        $Tasks = $this->repository->findInProg();

        return $this->render('views/inProgView.html.twig', [
            'Tasks' => $Tasks
        ]);
    }

    /**
    * @Route("/doneTasks", name="doneTasks")
    */
    public function tasksDone()
    {
        $Tasks = $this->repository->findDoneTasks();

        return $this->render('views/doneTasksView.html.twig', [
            'Tasks' => $Tasks
        ]);
    }

    /**
    * @Route("/singleTask/{id}", name="singleTask")
    */
    public function signleTask($id)
    {
        $task = $this->repository->find($id);

        return $this->render('views/singleTaskView.html.twig', [
            'task' => $task,
        ]);
    }

    /**
    * @Route("/updateTaskForm/{id}", name="deleteTasks", methods="DELETE")
    */
    public function deleteTask(Task $task, Request $request)
    {
        if($this->isCsrfTokenValid('delete' . $task->getId(), $request->get('_token')))
        {
            $this->em->remove($task);
            $this->em->flush();
            $this->addFlash('success', 'La tâche ' . $task->getTitle() . ' à bien été supprimée');
        }

        return $this->redirectToRoute('allTasks');
    }
}

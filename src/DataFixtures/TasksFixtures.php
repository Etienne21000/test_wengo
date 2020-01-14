<?php

namespace App\DataFixtures;

use App\Entity\Task;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class TasksFixtures extends Fixture
{
    /** @var Generator */
    private $faker;

    /**
     * TasksFixtures constructor.
     */
    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager)
    {
        for($i=0; $i<15; $i++)
        {
            $task = new Task();
            $task->setTitle($this->faker->realText(50));
            $task->setContent($this->faker->realText(500));
            $creation_date = $this->faker->dateTimeBetween('-1 month');
            $task->setCreationDate($creation_date);
            $task->setState($this->faker->numberBetween(0, 2));

            if($task->getState() != 0)
            {
                $modification_date = $this->faker->dateTimeBetween($creation_date);

                $task->setModificationDate($modification_date);
            }

            if($task->getState() == 2)
            {
                $end_date = $this->faker->dateTimeBetween($modification_date);
                $task->setEndDate($end_date);
            }

            $manager->persist($task);
        }

        $manager->flush();
    }
}

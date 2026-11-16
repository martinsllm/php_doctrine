<?php

use App\Doctrine\Entity\Course;
use App\Doctrine\Entity\Phone;
use App\Doctrine\Entity\Student;
use App\Doctrine\Helper\EntityManagerCreator;

require_once __DIR__ . '/../vendor/autoload.php';

$entityManager = EntityManagerCreator::createEntityManager();
$dql = 'SELECT student FROM App\\Doctrine\\Entity\\Student student';

/** @var Student[] $studentList */
$studentList = $entityManager->createQuery($dql)->getResult();

foreach ($studentList as $student) {
    echo "ID: $student->id\nNome: $student->name";

    if ($student->phones()->count() > 0) {
        echo PHP_EOL;
        echo "Telefones: ";

        echo implode(', ', $student->phones()
            ->map(fn(Phone $phone) => $phone->number)
            ->toArray());
    }

    if ($student->courses()->count() > 0) {
        echo PHP_EOL;
        echo "Cursos: ";

        echo implode(', ', $student->courses()
            ->map(fn(Course $course) => $course->nome)
            ->toArray());
    }

    echo PHP_EOL . PHP_EOL;
}

$dql = "SELECT COUNT(student) FROM App\Doctrine\Entity\Student student WHERE student.phones IS EMPTY";
var_dump($entityManager->createQuery($dql)->getSingleScalarResult());

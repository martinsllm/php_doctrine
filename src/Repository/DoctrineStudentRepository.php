<?php

namespace App\Doctrine\Repository;

use App\Doctrine\Entity\Student;
use Doctrine\ORM\EntityRepository;

class DoctrineStudentRepository extends EntityRepository
{
    public function studentsWithCourses(): array
    {
        $dql = 'SELECT student, phone, course
            FROM App\\Doctrine\\Entity\\Student student
            LEFT JOIN student.phones phone
            LEFT JOIN student.courses course';

        return $this->getEntityManager()->createQuery($dql)->getResult();
    }
}
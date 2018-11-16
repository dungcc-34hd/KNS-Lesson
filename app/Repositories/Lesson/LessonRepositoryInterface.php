<?php


namespace App\Repositories\Lesson;


use App\Repository\RepositoryInterface;

interface LessonRepositoryInterface extends RepositoryInterface
{
    public function getPages($records, $search = null);
    public function getObjects($records, $search = null);
}
<?php


namespace App\Repositories\TypeLesson;


use App\Repository\RepositoryInterface;

interface TypeLessonRepositoryInterface extends RepositoryInterface
{
    public function getPages($records, $search = null);
    public function getObjects($records, $search = null);
}
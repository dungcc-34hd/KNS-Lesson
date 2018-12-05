<?php


namespace App\Repositories\ManagerLesson;


use App\Repository\RepositoryInterface;

interface ManagerLessonEloquentInterface extends RepositoryInterface
{
    public function getPages($records, $search = null);
    public function getObjects($records, $search = null);
}
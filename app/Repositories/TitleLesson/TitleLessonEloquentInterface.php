<?php


namespace App\Repositories\TitleLesson;


use App\Repository\RepositoryInterface;

interface TitleLessonEloquentInterface extends RepositoryInterface
{
    public function getPages($records, $search = null);
    public function getObjects($records, $search = null);
}
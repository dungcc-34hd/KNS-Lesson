<?php


namespace App\Repositories\GradeLevel;


use App\Repository\RepositoryInterface;

interface GradeLevelRepositoryInterface extends RepositoryInterface
{
    public function getPages($records, $search = null);
    public function getObjects($records, $search = null);
}
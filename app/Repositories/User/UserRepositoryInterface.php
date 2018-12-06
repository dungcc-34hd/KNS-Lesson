<?php


namespace App\Repositories\User;


interface UserRepositoryInterface
{
	 public function getObjects($records, $search = null);
}
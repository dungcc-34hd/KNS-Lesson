<?php


namespace App\Repositories\Statistic;


interface StatisticRepositoryInterface
{

	 public function getPages($records, $search = null);
	 public function getObjects($records, $search = null);
	 
}
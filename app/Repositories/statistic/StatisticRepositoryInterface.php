<?php


namespace App\Repositories\Statistic;


interface StatisticRepositoryInterface
{
	public function getObjects($records,$districtId, $search = null);
	public function getProvince();
	public function getDistricts($provinceId);
	 public function getStatistic($districtId);
	 public function getAccount($schoolId);
	  public function getSchool();
}
<?php


namespace App\Repositories\Statistic;


interface StatisticRepositoryInterface
{
	 public function getPages($records,$areaId, $search = null);
	 public function getObjects($records,$areaId, $search = null);
	// public function getObjects($records,$districtId, $search = null);
	// public function getProvince();
	// public function getDistricts($provinceId);
	//  public function getStatistic($districtId);
	//  public function getAccount($schoolId);
	//   public function getSchool();
	  // public function select($areaId,$provinceId = null);
}
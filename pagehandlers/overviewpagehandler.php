<?php

namespace PageHandlers;

class OverviewPageHandler extends PageHandler
{
	public function handle()
	{
	  $districts = \Classes\District::where(array('owner_id'=>$_SESSION['userid']));
	  $this->setPageData('districtsCount', $districts->count());
	  
	  $builder = \Classes\Unit::makeBuilder();
	  $builder->where = 'districts.owner_id=?';
	  $builder->joins = 'JOIN district_units ON units.unit_id = district_units.unit_id JOIN districts ON district_units.district_id = districts.district_id';
	  $units = new \Torm\Collection($builder, array($_SESSION['userid']), '\Classes\Unit');
	  
	  //$units = \Classes\User::where(array('owner_id'=>$_SESSION['userid']));
	  $this->setPageData('unitsCount', $units->count());
	  
		$this->setPhpTemplate('overview');
	  return $this;
	}
}

?>

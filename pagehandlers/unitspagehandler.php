<?php

namespace PageHandlers;

class UnitsPageHandler extends PageHandler
{
	public function handle()
	{
		if (isset($_GET['ajax']))
		{
		
		}
		$this->setPhpTemplate('units');
		
		if (isset($_GET['perform']) && $_GET['perform'] == 'debugAdd')
		{
			if (isset($_POST['city']))
				$cityId = $_POST['city'];
				
			if (!is_numeric($cityId) || $cityId <= 0
				|| \Classes\District::find($cityId) == null)
			{
				$this->setReturnCode(500);
				echo 'cityId';
				return $this;
			}
			
			$collection = \Classes\DistrictUnit::where(array('district_id'=>$cityId, 'unit_id'=>1));
			if ($collection->count() > 0)
			{
				$unit = $collection->next();
			}
			else
			{
				$unit = new \Classes\DistrictUnit();
				$unit->setDistrictId($cityId);
				$unit->setUnitId(1);
			}
			$unit->setCount($unit->getCount() + 10);
			$unit->save();
			
			$this->setPageData('success', 1);
		}
		
		$districts = array();
		$collection = \Classes\District::where(array('owner_id'=>$_SESSION['userid']));
		while (($district = $collection->next()) != null)
		{
			array_push($districts, array('id'=>$district->getDistrictId(), 'name'=>$district->getName()));
		}
		$this->setPageData('cities', $districts);
		
	  return $this;
	}
}

?>

<?php

namespace PageHandlers;

class MapPageHandler extends PageHandler
{
	public function handle()
	{
		if (isset($_GET['terrain']))
		{
			$districts = \Classes\District::where(array('owner_id'=>$_SESSION['userid']));
			$districtsIDArr = array();
			
			foreach($districts as $district){
				array_push($districtsIDArr, $district->district_id);	
			}
			
	  		$this->setPageData('districtsIDArr', $districtsIDArr);
			
			switch($_GET['terrain'])
			{
				case 'high_cities':
					$this->setPhpTemplate('high_cities');
					break;
				case 'open_docks':
					$this->setPhpTemplate('open_docks');
					break;
				case 'great_canyons':
					$this->setPhpTemplate('great_canyons');
					break;
			}
		}
		else
		{
			$this->setPhpTemplate('map');
		}
	  return $this;
	}
}

?>

<?php

namespace PageHandlers;

class CityNamesPageHandler extends PageHandler
{
	
	public function handle()
	{
		if (isset($_GET['id']))
		{
			return $this->ajaxRequest();
		}
		
		$this->setPhpTemplate('attacks');
	  return $this;
	}
	
	private function ajaxRequest()
	{
		//get district with id
		$targetDistrict = \Classes\District::find($_GET['id']);
		echo $targetDistrict->getName();
		return $this;
	}
}

?>
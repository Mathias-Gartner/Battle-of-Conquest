<?php

namespace PageHandlers;

class AttacksPageHandler extends PageHandler
{
	public function handle()
	{
		if (isset($_GET['list']))
		{
			return $this->ajaxRequest();
		}
		
		$this->setPhpTemplate('attacks');
	  return $this;
	}
	
	private function ajaxRequest()
	{
		$this->setAjaxTemplate('attacks');
		$current = ($_GET['list'] == 'current');
	
		// outbound attacks
		$builder = \Classes\Attack::makeBuilder();
		$builder->joins = 'JOIN districts ON districts.district_id = attacks.source_district_id';
		$builder->where = 'districts.owner_id = ? and attacks.battle_over = ?';
		$attacks = new \Torm\Collection($builder, array($_SESSION['userid'], !$current), '\Classes\Attack');
		
		$attackData = $this->addAttacks(null, $attacks);
		
		// inbound attacks
		$builder->joins = 'JOIN districts ON districts.district_id = attacks.target_district_id';
		$attacks = new \Torm\Collection($builder, array($_SESSION['userid'], !$current), '\Classes\Attack');
		$attackData = $this->addAttacks($attackData, $attacks);
		
		$this->setPageData('attacks', $attackData);
		$this->setPageData('current', $current);
		return $this;
	}
	
	private function addAttacks($array, $collection)
	{
		if ($array == null)
			$array = array();
			
		$currentDate = new \DateTime();
		
		while (($attack = $collection->next()) != NULL)
		{
			$battleTime = new \DateTime($attack->getBattleTime());
			$secondsLeft = abs($battleTime->getTimestamp() - $currentDate->getTimestamp());
			$targetDistrict = $attack->targetDistrict;
			$sourceDistrict = $attack->sourceDistrict;
			
			array_push($array, array(
				'id'=>$attack->getAttackId(),
				'battleTime'=>$attack->getBattleTime(),
				'targetDistrictId'=>$targetDistrict->getDistrictId(),
				'targetDistrictName'=>$targetDistrict->getName(),
				'sourceDistrictId'=>$sourceDistrict->getDistrictId(),
				'sourceDistrictName'=>$sourceDistrict->getName(),
				'secondsLeft'=>$secondsLeft,
				'attackerWon'=>($attack->getAttackerWon() == NULL ? "null" : $attack->getAttackerWon())
				));
		}
		
		return $array;
	}
}

?>

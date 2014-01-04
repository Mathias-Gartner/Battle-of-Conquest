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
	
		$builder = \Classes\Attack::makeBuilder();
		$builder->joins = 'JOIN districts ON districts.district_id = attacks.source_district_id';
		$builder->where = 'districts.owner_id = ? and attacks.battle_over = ?';
		$attacks = new \Torm\Collection($builder, array($_SESSION['userid'], !$current), '\Classes\Attack');
		
		$attackData = array();
		$currentDate = new \DateTime();
		while (($attack = $attacks->next()) != NULL)
		{
			$battleTime = new \DateTime($attack->getBattleTime());
			$secondsLeft = abs($battleTime->getTimestamp() - $currentDate->getTimestamp());

			array_push($attackData, array(
				'id'=>$attack->getAttackId(),
				'targetDistrictId'=>$attack->targetDistrict->getDistrictId(),
				'targetDistrictName'=>$attack->targetDistrict->getName(),
				'sourceDistrictId'=>$attack->sourceDistrict->getDistrictId(),
				'sourceDistrictName'=>$attack->sourceDistrict->getName(),
				'secondsLeft'=>$secondsLeft,
				'attackerWon'=>($attack->getAttackerWon() == NULL ? "null" : $attack->getAttackerWon())
				));
		}
		
		$this->setPageData('attacks', $attackData);
		$this->setPageData('current', $current);
		return $this;
	}
}

?>

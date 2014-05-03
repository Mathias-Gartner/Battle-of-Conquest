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
		if (isset($_GET['cancelId']) && is_numeric($_GET['cancelId']))
		{
		  return $this->cancelAttack($_GET['cancelId']);
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
		$builder->order = 'battle_time DESC';
		$builder->limit = 10;
		$builder->joins = 'JOIN districts ON districts.district_id = attacks.source_district_id';
		$builder->where = 'districts.owner_id = ? and attacks.battle_state '.($current?'':'!').'= 0';
		$attacks = new \Torm\Collection($builder, array($_SESSION['userid']), '\Classes\Attack');

		$attackData = $this->addAttacks(null, $attacks);
		
		// inbound attacks
		$builder->joins = 'JOIN districts ON districts.district_id = attacks.target_district_id';
		$attacks = new \Torm\Collection($builder, array($_SESSION['userid']), '\Classes\Attack');
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
			// TODO: eager fetching of districts
			$targetDistrict = $attack->targetDistrict;
			$sourceDistrict = $attack->sourceDistrict;
			
			array_push($array, array(
				'id'=>$attack->getAttackId(),
				'startTime'=>str_replace(' ', 'T', $attack->getStartTime()),
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
	
	private function cancelAttack($id)
	{
	  $attack = \Classes\Attack::find($id);
	  if ($attack == null)
	  {
	    $this->setMessage('Attack not found');
	    $this->setReturnCode(400);
	    return $this;
	  }

    $district = \Classes\District::find($attack->getSourceDistrictId());
    if ($district == null)
      return;
      
	  if ($district->getOwnerId() != $_SESSION['userid'])
	  {
	    $this->setMessage('Attack cannot be cancelled (access denied)');
	    $this->setReturnCode(500);
	    return $this;
	  }
	  
	  if (!$attack->cancel())
	  {
	    $this->setMessage('Attack cannot be saved');
	    $this->setReturnCode(500);
	  }
	  return $this;
	}
}

?>

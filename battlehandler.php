<?php

class BattleHandler
{
	static function handlePendingBattles()
	{
		$currentDate = new \DateTime();
		$currentDate = $currentDate->format('Y-m-d H:i:s');
	
		$builder = \Classes\Attack::makeBuilder();
		$builder->where = 'battle_state = 0 and battle_time < ?';
		$builder->order = 'battle_time';
		$pendingAttacks = new \Torm\Collection($builder, array($currentDate), '\Classes\Attack');

		// early exit if no battles to handle
		if ($pendingAttacks->count() < 1)
			return;
			
		while (($attack = $pendingAttacks->next()) != NULL)
		{
			\TORM\Connection::getConnection()->beginTransaction();
			
			$attackUnits = $attack->attackUnits;
			$sourceUnits = $attack->sourceDistrict->districtUnits;
			$targetUnits = $attack->targetDistrict->districtUnits;
			$attackUnitCount = $attackUnits->sum('count')+0;
			$targetUnitCount = $targetUnits->sum('count')+0;
			
			//TODO: improve battle logic
			$attackerWon = ($attackUnitCount > $targetUnitCount);

			$attack->setAttackerWon($attackerWon);
			$attack->setBattleOver();
			if (!$attack->save())
			{
				\TORM\Connection::getConnection()->rollBack();
				continue;
			}
			
			// remove units that died in the battle
			while (($unit = $targetUnits->next()) != NULL && $attackUnitCount > 0)
			{
				if ($unit->getCount() <= $attackUnitCount)
				{
					$attackUnitCount = $attackUnitCount - $unit->getCount();
					$unit->destroy();
				}
				else
				{
					$newCount = $unit->getCount() - $attackUnitCount;
					$attackUnitCount = $attackUnitCount - $unit->getCount();
					$unit->setCount($newCount);
					if (!$unit->save())
					{
						\TORM\Connection::getConnection()->rollBack();
					}
					break;
				}
			}
			
			\TORM\Connection::getConnection()->commit();
			
			/*while (($unit = $sourceUnits->next()) != NULL && $targetUnitCount > 0)
			{
				$attackUnit = \Classes\AttackUnit::first(array('unit_id'=>$unit->getUnitId(), 'attack_id'=>$attack->getAttackId()));
				$maxFallen = $targetUnitCount;

				if ($maxFallen == null)
					$maxFallen = 0;

				if ($maxFallen > $attackUnitCount) // units that weren't attacking cannot die
					$maxFallen = $attackUnitCount;

				if ($unit->getCount() <= $maxFallen)
				{
					$targetUnitCount = $targetUnitCount - $unit->getCount();
					$unit->destroy();
				}
				else
				{
					$newCount = $unit->getCount() - $maxFallen;
					$targetUnitCount = $targetUnitCount - $maxFallen;
					$unit->setCount($newCount);
					$unit->save();
					break;
				}
			}*/
		}
	}
	
	static function handleReturningAttacks()
	{
		$currentDate = new \DateTime();
		$currentDate = $currentDate->format('Y-m-d H:i:s');
		
		$builder = \Classes\Attack::makeBuilder();
		$builder->where = '(battle_state = 1 or battle_state = 2) and start_time + (battle_time - start_time)*2 < time(?)';
		$builder->order = 'battle_time';
		$pendingAttacks = new \Torm\Collection($builder, array($currentDate), '\Classes\Attack');

		// early exit if no battles to handle
		if ($pendingAttacks->count() < 1)
			return;
			
		while (($attack = $pendingAttacks->next()) != NULL)
		{
			\TORM\Connection::getConnection()->beginTransaction();
		  // set to appropriate state for returned attack
			$attack->setBattleState($attack->getBattleState() + 2);
			if (!$attack->save())
			{
			  \TORM\Connection::getConnection()->rollBack();
			  continue;
			}
			
		  //TODO: use Report and add only surviving units to the district
		  //$report = \Classes\Report::createForAttack(
		  
		  $district = $attack->sourceDistrict;
		  $units = $attack->attackUnits;
		  while (($unit = $units->next()) != NULL)
		  {
		    $districtUnit = \Classes\DistrictUnit::first(array('unit_id'=>$unit->getUnitId()));
		    if ($districtUnit == null)
		    {
		    	$districtUnit = new \Classes\DistrictUnit();
		    }
		    $districtUnit->setCount($unit->getCount() + $districtUnit->getCount());
		    if (!$districtUnit->save())
		    {
		    	\TORM\Connection::getConnection()->rollBack();
		    	break;
		    }
		  }
		  
		  \TORM\Connection::getConnection()->commit();
		}
	}
}

?>

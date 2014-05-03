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
			$attackUnits = $attack->attackUnits;
			$sourceUnits = $attack->sourceDistrict->districtUnits;
			$targetUnits = $attack->targetDistrict->districtUnits;
			$attackUnitCount = $attackUnits->sum('count')+0;
			$targetUnitCount = $targetUnits->sum('count')+0;
			$attackerWon = ($attackUnitCount > $targetUnitCount);

			$attack->setAttackerWon($attackerWon);
			$attack->setBattleOver();
			$attack->save();
			
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
					$unit->save();
					break;
				}
			}
			
			while (($unit = $sourceUnits->next()) != NULL && $targetUnitCount > 0)
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
			}
		}
	}
}

?>

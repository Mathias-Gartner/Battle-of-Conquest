<?php

class BattleHandler
{
	static function handlePendingBattles()
	{
		$currentDate = new \DateTime();
		$currentDate = $currentDate->format('Y-m-d H:i:s');
	
		$builder = \Classes\Attack::makeBuilder();
		$builder->where = 'battle_over = 0 and battle_time < ?';
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
			$attack->setBattleOver(true);
			$attack->save();
			
			// remove units that died in the battle
			while (($unit = $targetUnits->next()) != NULL && $attackUnitCount > 0)
			{
				if ($unit->getCount() <= $attackUnitCount)
				{
					$unit->destroy();
					$attackUnitCount = $attackUnitCount - $unit->getCount();
				}
				else
				{
					$unit->setCount($unit->getCount() - $attackUnitCount);
					$unit->save();
					break;
				}
			}
			
			while (($unit = $sourceUnits->next()) != NULL && $targetUnitCount > 0)
			{
				if ($unit->getCount() <= $targetUnitCount)
				{
					$unit->destroy();
					$targetUnitCount = $targetUnitCount - $unit->getCount();
				}
				else
				{
					$unit->setCount($unit->getCount() - $targetUnitCount);
					$unit->save();
					break;
				}
			}
		}
	}
}

?>

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
			// delete old values (if any)
			$sql = 'DELETE FROM `defending_units` WHERE attack_id=?';
			$stmt = \TORM\Connection::getConnection()->prepare($sql);
			if (!$stmt->execute(array($attack->getAttackId())))
			{
				continue;
			}

			// set current units of targetDistrict as DefendUnits
			$defendUnits = \Classes\DistrictUnit::where(array('district_id'=>$attack->getTargetDistrictId()));
			while (($unit = $defendUnits->next()) != NULL)
			{
				$defendUnit = new \Classes\DefendingUnit();
				$defendUnit->setAttackId($attack->getAttackId());
				$defendUnit->setUnitId($unit->getUnitId());
				$defendUnit->setCount($unit->getCount());
				if (!$defendUnit->save())
				{
					\TORM\Connection::getConnection()->rollBack();
					return;
				}
			}

			\TORM\Connection::getConnection()->beginTransaction();

			$report = new \Classes\Report($attack);
			if (!$report->battle())
			{
				\TORM\Connection::getConnection()->rollBack();
				continue;
			}
			$attackerWon = $report->attackerWon();

			$attack->setAttackerWon($attackerWon);
			$attack->setBattleOver();
			if (!$attack->save())
			{
				\TORM\Connection::getConnection()->rollBack();
				continue;
			}

			// sync DistrictUnits with fight result
			$resultDefendUnits = $report->getResultDefendUnits();
			foreach ($resultDefendUnits as $unit)
			{
				$districtUnit = \Classes\DistrictUnit::where(array('district_id'=>$attack->getTargetDistrictId(), 'unit_id'=>$unit['id']))->next();
				if ($districtUnit == null)
				{
					$districtUnit = new \Classes\DefendingUnit();
					$districtUnit->setDistrictId($attack->getTargetDistrictId());
					$districtUnit->setUnitId($unit['id']);
					$districtUnit->setCount($unit['count']);
				}
				$districtUnit->setCount($unit['count']);

				if (!$districtUnit->save())
				{
					\TORM\Connection::getConnection()->rollBack();
					return;
				}
			}

			if (count($resultDefendUnits) > 0)
				$sql = 'DELETE FROM `district_units` WHERE `district_id` = ? and `unit_id` not in ('.str_repeat('?, ', count($resultDefendUnits) - 1).'?)';
			else
				$sql = 'DELETE FROM `district_units` WHERE `district_id` = ?';

			$stmt = \TORM\Connection::getConnection()->prepare($sql);
			$params = array();
			array_push($params, $attack->getTargetDistrictId());
			foreach ($resultDefendUnits as $unit)
			{
				array_push($params, $unit['id']);
			}
			if (!$stmt->execute($params))
			{
				\TORM\Connection::getConnection()->rollBack();
				continue;
			}

			// take district if all defenders died
			$count = \Classes\DistrictUnit::where(array('district_id'=>$attack->getTargetDistrictId))->sum('count');
			if ($count == null || $count < 1)
			{
				$sourceDistrict = \Classes\District::find($attack->getSourceDistrictId());
				$district = \Classes\District::find($attack->getTargetDistrictId());
				if ($district->getOwnerId() > 1) // district of admin user cannot be taken as this would break registration
				{
					$district->setOwnerId($sourceDistrict->getOwnerId());
					if (!$district->save())
					{
						\TORM\Connection::getConnection()->rollBack();
						continue;
					}
				}
			}

			\TORM\Connection::getConnection()->commit();
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

			$report = new \Classes\Report($attack);
			if (!$report->battle())
			{
				\TORM\Connection::getConnection()->rollBack();
				continue;
			}

		  // set to appropriate state for returned attack
			$attack->setBattleState($attack->getBattleState() + 2);
			if (!$attack->save())
			{
			  \TORM\Connection::getConnection()->rollBack();
			  continue;
			}

			// re-add DistrictUnits
			$resultAttackUnits = $report->getResultAttackUnits();
			foreach ($resultAttackUnits as $unit)
			{
				$districtUnit = \Classes\DistrictUnit::where(array('district_id'=>$attack->getSourceDistrictId(), 'unit_id'=>$unit['id']))->next();
				if ($districtUnit == null)
				{
					$districtUnit = new \Classes\DistrictUnit();
					$districtUnit->setDistrictId($attack->getSourceDistrictId());
					$districtUnit->setUnitId($unit['id']);
				}
				$districtUnit->setCount($districtUnit->getCount() + $unit['count']);
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

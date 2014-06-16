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

		if (isset($_GET['method']) && $_GET['method'] == 'createUnits')
		{
			if (!$this->createUnits())
				return $this;
		}

		$districtId;
		if (isset($_GET['districtId']) && is_numeric($_GET['districtId']))
		{
			$districtId = $_GET['districtId'];
		}
		else
		{
			$districtId = $this->getMainDistrictForCurrentPlayer();
			if ($districtId < 0)
				return;
		}

		$district = \Classes\District::find($districtId);
		if ($district->getOwnerId() != $_SESSION['userid'])
		{
			$this->setReturnCode(403);
			$this->setMessage('You cannot create units in a district you don\'t own');
			return $this;
		}

		$this->setPageData('districtId', $districtId);
		$this->setPageData('cityName', $district->getName());

		$builder = \Classes\Unit::makeBuilder();
		$units = new \Torm\Collection($builder, null, '\Classes\Unit');

		$unitData = array();
		while (($unit = $units->next()) != NULL)
		{
			array_push($unitData, array('id'=>$unit->getUnitId(), 'name'=>$unit->getUnitName(), 'resources'=>$unit->getUnitResources(), 'max'=>10));
			// TODO: getPlayersResources() and calculate max
		}

		$this->setPageData('units', $unitData);

	  return $this;
	}

	private function createUnits()
	{
		if (isset($_POST['districtId']))
			$districtId = $_POST['districtId'];

		if (!is_numeric($districtId) || $districtId <= 0
			|| \Classes\District::find($districtId) == null)
		{
			$this->setReturnCode(400);
			$this->setMessage('districtId is missing');
			return false;
		}

		\TORM\Connection::getConnection()->beginTransaction();
		$resourceCost = 0;
		$i = 1;
		while (isset($_POST['unit_'.$i]) && is_numeric($_POST['unit_'.$i]))
		{
			$unit = \Classes\Unit::find($i);
			if ($unit == null)
			{
				continue;
			}

			$collection = \Classes\DistrictUnit::where(array('district_id'=>$districtId, 'unit_id'=>$unit->getUnitId()));
			if ($collection->count() > 0)
			{
				$districtUnit = $collection->next();
			}
			else
			{
				$districtUnit = new \Classes\DistrictUnit();
				$districtUnit->setDistrictId($districtId);
				$districtUnit->setUnitId($unit->getUnitId());
			}
			$districtUnit->setCount($districtUnit->getCount() + $_POST['unit_'.$i]);
			$resourceCost += $unit->getUnitResources();
			if (!$districtUnit->save())
			{
				\TORM\Connection::rollBack();
				$this->setMessage("Failed to save unit");
				$this->setReturnCode(500);
				return false;
			}

			$i++;
		}

		//TODO: reduce resources for player; rollBack if he hasn't enough
		\TORM\Connection::getConnection()->commit();
		$this->setPageData('success', 1);
		return true;
	}

	private function getMainDistrictForCurrentPlayer()
	{
		$district = \Classes\District::first(array('owner_id'=>$_SESSION['userid']));
		if ($district == null)
		{
			$this->setReturnCode(500);
			$this->setMessage("Current player has no district");
			return -1;
		}
		return $district->getDistrictId();
	}
}

?>

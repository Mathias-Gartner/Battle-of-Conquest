<?php

namespace PageHandlers;

class PrepareAttackPageHandler extends PageHandler
{
	public function handle()
	{
		$sourceId = -1;
		$targetId = -1;

		if (isset($_GET['sourceId']))
			$sourceId = $_GET['sourceId'];

		if (isset($_GET['targetId']))
			$targetId = $_GET['targetId'];

		if (!is_numeric($sourceId) || $sourceId <= 0
			|| !is_numeric($targetId) || $targetId <= 0
			|| \Classes\District::find($sourceId) == null)
		{
			$this->setReturnCode(500);
			echo 'sourceId or targetId not valid';
			return $this;
		}

		$targetDistrict = \Classes\District::find($targetId);
		if ($targetDistrict == null)
		{
			$this->setReturnCode(500);
			echo 'targetId not found';
			return $this;
		}
		else if ($targetDistrict->getOwnerId() == $_SESSION['userid'])
		{
			$this->setReturnCode(500);
			echo 'you cannot attack your own city';
			return $this;
		}

		$this->setPageData('sourceId', $sourceId);
		$this->setPageData('targetId', $targetId);
		$this->setPageData('targetCityName', $targetDistrict->getName());

		$builder = \Classes\Unit::makeBuilder();
		$builder->where = 'district_units.district_id=?';
		$builder->joins = 'JOIN district_units ON units.unit_id = district_units.unit_id';
		$units = new \Torm\Collection($builder, array($sourceId), '\Classes\Unit');

		$unitData = array();
		while (($unit = $units->next()) != NULL)
		{
			$max = \Classes\DistrictUnit::where(array('district_id'=>$sourceId, 'unit_id'=>$unit->getUnitId()))->sum('count');
			$builder = \Classes\AttackUnit::makeBuilder();
			$builder->where = 'attacks.source_district_id = ? and attack_units.unit_id = ?';
			$builder->joins = 'JOIN attacks ON attacks.attack_id = attack_units.attack_id';
			$active = new \Torm\Collection($builder, array($sourceId, $unit->getUnitId()), '\Classes\AttackUnit');
			$active = $active->sum('count');

			array_push($unitData, array('id'=>$unit->getUnitId(),
							'name'=>$unit->getUnitName(),
							'class'=>$unit->getUnitClass(),
							'max'=>($max - $active)
						   ));
		}
		$this->setPageData('units', $unitData);

		$this->setPhpTemplate('prepareattack');
		return $this;
	}
}

?>

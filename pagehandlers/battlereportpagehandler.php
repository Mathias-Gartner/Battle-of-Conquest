<?php

namespace PageHandlers;

class BattleReportPageHandler extends PageHandler
{
	public function handle()
	{
		if (!isset($_GET['attackId']) && !is_numeric($_GET['attackId']))
		{
			$this->setReturnCode(400);
			$this->setMessage('Parameter attackId is required');
			return $this;
		}

		$report = \Classes\Report::createForAttack($_GET['attackId']);
		if ($report == false)
		{
			$this->setReturnCode(500);
			$this->setMessage("Attack not found or invalid");
			return $this;
		}

		$sourceDistrict = $report->getAttack()->sourceDistrict;
		$targetDistrict = $report->getAttack()->targetDistrict;

		// security check
		if ($sourceDistrict->getOwnerId() != $_SESSION['userid']
				&& $targetDistrict->getOwnerId() != $_SESSION['userid'])
	  {
				$this->setReturnCode(403);
				$this->setMessage('Attack is not concerning your user');
				return $this;
		}

		$this->setPhpTemplate('battlereport');

		$killedAttackers = $report->getKilledAttackersCount();
		$killedDefenders = $report->getKilledDefendersCount();
		$this->setPageData('sourceDistrict', $sourceDistrict->getName());
		$this->setPageData('targetDistrict', $targetDistrict->getName());
		$this->setPageData('isSpy', false);
		$this->setPageData('killedAttackers', $killedAttackers);
		$this->setPageData('killedDefenders', $killedDefenders);

		$attackUnits = array();
		while (($attackUnit = $report->getAttackUnits()->next()) != NULL)
		{
			//$unit = $attackUnit->unit;
			$unit = \Classes\Unit::find($attackUnit->getUnitId());
			array_push($attackUnits, array('name'=>$unit->getUnitName(), 'count'=>$attackUnit->getCount()));
		}
		$this->setPageData('attackUnits', $attackUnits);
		$this->setPageData('resultAttackUnits', $report->getResultAttackUnits());

		$defendUnits = array();
		while(($defendUnit = $report->getDefendUnits()->next()) != NULL)
		{
			//$unit = $defendUnit->unit;
			$unit = \Classes\Unit::find($defendUnit->getUnitId());
			array_push($defendUnits, array('name'=>$unit->getUnitName(), 'count'=>$defendUnit->getCount()));
		}
		$this->setPageData('defendUnits', $defendUnits);
		$this->setPageData('resultDefendUnits', $report->getResultDefendUnits());

		return $this;
	}
}

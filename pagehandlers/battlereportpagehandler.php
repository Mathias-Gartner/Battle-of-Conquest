<?php

namespace PageHandlers;

class BattleReportPageHandler extends PageHandler
{
	public function handle()
	{//\Torm\Log::enable(true);
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
		$resultAttackUnits = array();
		while (($attackUnit = $report->getAttackUnits()->next()) != NULL)
		{
			//$unit = $attackUnit->unit;
			$unit = \Classes\Unit::find($attackUnit->getUnitId());
			array_push($attackUnits, array('name'=>$unit->getUnitName(), 'count'=>$attackUnit->getCount()));
			if ($killedAttackers < $attackUnit->getCount())
				array_push($resultAttackUnits, array('name'=>$unit->getUnitName(), 'count'=>$attackUnit->getCount() - $killedAttackers));

			$killedAttackers -= $attackUnit->getCount();
			if ($killedAttackers < 0)
				$killedAttackers = 0;
		}
		$this->setPageData('attackUnits', $attackUnits);
		$this->setPageData('resultAttackUnits', $resultAttackUnits);

		$defendUnits = array();
		$resultDefendUnits = array();
		while(($defendUnit = $report->getDefendUnits()->next()) != NULL)
		{
			//$unit = $defendUnit->unit;
			$unit = \Classes\Unit::find($defendUnit->getUnitId());
			array_push($defendUnits, array('name'=>$unit->getUnitName(), 'count'=>$defendUnit->getCount()));
			if ($killedDefenders < $defendUnit->getCount())
				array_push($resultDefendUnits, array('name'=>$unit->getUnitName(), 'count'=>$defendUnit->getCount() - $killedDefenders));

			$killedDefenders -= $defendUnit->getCount();
			if ($killedDefenders < 0)
				$killedDefenders = 0;
		}
		$this->setPageData('defendUnits', $defendUnits);
		$this->setPageData('resultDefendUnits', $resultDefendUnits);

		return $this;
	}
}

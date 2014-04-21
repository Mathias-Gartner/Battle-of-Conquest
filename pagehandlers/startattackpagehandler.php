<?php

namespace PageHandlers;

class StartAttackPageHandler extends PageHandler
{
	public function handle()
	{
  	$sourceId = -1;
  	$targetId = -1;
  
  	if (isset($_POST['sourceId']))
    	$sourceId = $_POST['sourceId'];
  
		if (isset($_POST['targetId']))
			$targetId = $_POST['targetId'];
  
  	if (!is_numeric($sourceId) || $sourceId <= 0
        || !is_numeric($targetId) || $targetId <= 0)
  	{
			$this->setReturnCode(500);
			$this->setMessage('sourceId or targetId not valid');
			return $this;
  	}
  
  	$sourceDistrict = \Classes\District::find($sourceId);
  	$targetDistrict = \Classes\District::find($targetId);
  	if ($targetDistrict == null || $sourceDistrict == null)
  	{
   		$this->setReturnCode(500);
			$this->setMessage('targetId not found');
			return $this;
  	}
  	if ($targetDistrict->getOwnerId() == $_SESSION['userid'])
  	{
			$this->setReturnCode(500);
			$this->setMessage('you cannot attack your own city');
			return $this;
  	}
    if ($sourceDistrict->getOwnerId() != $_SESSION['userid'])
    {
      $this->setReturnCode(400);
      $this->setMessage('you can only start attacks from your city');
      return $this;
    }

  	$this->setPhpTemplate('startAttack');
  	$this->setPageData('targetCityName', $targetDistrict->getName());

  	$units = array();
  	$currentUnitId = 1;
  	$maxId = \Classes\Unit::executePrepared('SELECT max(unit_id) FROM units')->fetchColumn(0);

  	while ($currentUnitId <= $maxId)
  	{
    	if (isset($_POST['unit_'.$currentUnitId]))
    	{
				array_push($units, array('id'=>$currentUnitId, 'count'=>$_POST['unit_'.$currentUnitId]));
   		}
   		$currentUnitId++;
  	}
  
  	\TORM\Connection::getConnection()->beginTransaction();
  	$unitCountSum = 0;
  	foreach ($units as $unit)
  	{
    	$max = \Classes\DistrictUnit::where(array('district_id'=>$sourceId, 'unit_id'=>$unit['id']))->sum('count');
    	$builder = \Classes\AttackUnit::makeBuilder();
    	$builder->where = 'attacks.battle_over=0 and attacks.source_district_id = ? and attack_units.unit_id = ?';
    	$builder->joins = 'JOIN attacks ON attacks.attack_id = attack_units.attack_id';
    	$active = new \Torm\Collection($builder, array($sourceId, $unit['id']), '\Classes\AttackUnit');
	    $active = $active->sum('count');
	    if ($active == null) $active = 0;
	    $available = $max - $active;
    
    	if ($unit['count'] > $available)
			{
				$this->setPageData('notEnoughUnits', 1);
				\TORM\Connection::getConnection()->rollBack();
				return $this;
			}
			$unitCountSum += $unit['count'];
  	}
  
  	if ($unitCountSum < 1)
  	{
    	$this->setPageData('noUnitsSelected', 1);
    	\TORM\Connection::getConnection()->rollBack();
    	return $this;
  	}
  
  	$attack = new \Classes\Attack();
  	$attack->setSourceDistrictId($sourceId);
  	$attack->setTargetDistrictId($targetId);
  
    $battleTime = $this->getBattleTime($sourceDistrict, $targetDistrict, $units);
    if ($battleTime == false)
    {
      \TORM\Connection::getConnection()->rollBack();
      $this->setReturnCode(500);
      $this->setMessage('unit id invalid');
      return $this;
    }
    
  	$attack->setBattleTime($battleTime);
  	$attack->setBattleOver(false);
  	if (!$attack->save())
  	{
  	  \TORM\Connection::getConnection()->rollBack();
  	  $this->setReturnCode(500);
  	  $this->setMessage('cannot save attack');
  	  return;
  	}
	  
  	foreach ($units as $unit)
  	{
    	$attackUnit = new \Classes\AttackUnit();
    	$attackUnit->setAttackId($attack->getAttackId());
    	$attackUnit->setUnitId($unit['id']);
    	$attackUnit->setCount($unit['count']);
			if (!$attackUnit->save())
			{
			  \TORM\Connection::getConnection()->rollBack();
			  $this->setReturnCode(500);
			  $this->setMessage('cannot save AttackUnit');
			  return;
			}
		}
	  
		$this->setPageData('success', 1);
		\TORM\Connection::getConnection()->commit();
		return $this;
	}
	
	// 60 seconds wait for every distance unit times UnitSpeed multiplier of slowest unit
	function getBattleTime($sourceDistrict, $targetDistrict, $units)
	{
	  $movement = -1;
	  foreach ($units as $unit)
	  {
	    $dbUnit = \Classes\Unit::find($unit['id']);
	    if ($dbUnit == null)
	      return false;
      
      $mvmt = $dbUnit->getUnitSpeed();
      if ($movement < 0 || $mvmt < $movement)
      {
        $movement = $mvmt;
      }
	  }
	
	  $seconds = StartAttackPageHandler::getDistanceSeconds($sourceDistrict, $targetDistrict);
  	$datetime = new \DateTime();
		$datetime->add(new \DateInterval('PT'.round($seconds*$movement).'S'));
		return $datetime->format('Y-m-d H:i:s');
	}
	
	static function getDistanceSeconds($sourceDistrict, $targetDistrict)
	{
	  $x = abs($sourceDistrict->getPositionX() - $targetDistrict->getPositionX());
  	$y = abs($sourceDistrict->getPositionY() - $targetDistrict->getPositionY());
  	$distance = sqrt($x*$x+$y*$y);
  	return round($distance*60);
	}
}

?>

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
      echo 'sourceId or targetId not valid';
      return $this;
    }
    
    $sourceDistrict = \Classes\District::find($sourceId);
    $targetDistrict = \Classes\District::find($targetId);
    if ($targetDistrict == null || $sourceDistrict == null)
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
	  
	  // TODO: Use SQL Transaction
	  $unitCountSum = 0;
	  foreach ($units as $unit)
	  {
	    $max = \Classes\DistrictUnit::where(array('district_id'=>$sourceId, 'unit_id'=>$unit['id']))->sum('count');
	    $builder = \Classes\AttackUnit::makeBuilder();
	    $builder->where = 'attack.source_district_id = ? and attack_units.unit_id = ?';
	    $builder->joins = 'JOIN attack ON attack.attack_id = attack_units.attack_id';
	    $active = new \Torm\Collection($builder, array($sourceId, $unit['id']), '\Classes\AttackUnit');
	    $available = $max - $active->sum('count');
	    
	    if ($unit['count'] > $available)
      {
        $this->setPageData('notEnoughUnits', 1);
        return $this;
      }
      $unitCountSum += $unit['count'];
	  }
	  
	  if ($unitCountSum < 1)
	  {
	    $this->setPageData('noUnitsSelected', 1);
	    return $this;
	  }
	  
	  $attack = new \Classes\Attack();
	  $attack->setSourceDistrictId($sourceId);
	  $attack->setTargetDistrictId($targetId);
	  
	  $x = abs($sourceDistrict->getPositionX() - $targetDistrict->getPositionX());
	  $y = abs($sourceDistrict->getPositionY() - $targetDistrict->getPositionY());
	  $distance = sqrt($x*$x+$y*$y);
	  
	  $datetime = new \DateTime();
	  // 60 seconds wait for every distance unit
	  $datetime->add(new \DateInterval('PT'.round($distance*60).'S'));
	  $attack->setBattleTime($datetime->format('Y-m-d H:i:s'));
	  $attack->save();
	  
	  foreach ($units as $unit)
	  {
	    $attackUnit = new \Classes\AttackUnit();
	    $attackUnit->attack = $attack;
	    $attackUnit->setUnitId($unit['id']);
	    $attackUnit->setCount($unit['count']);
	    $attackUnit->save();
	  }
	  
	  $this->setPageData('success', 1);
	  return $this;
	}
}

?>

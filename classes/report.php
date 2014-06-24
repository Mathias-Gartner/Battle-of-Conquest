<?php

namespace Classes;

class Report
{
  public static function createForAttack($attackId)
  {
    $attack = \Classes\Attack::find($attackId);

    if ($attack == null || $attack->getBattleState() < 1)
      return false;

    $report = new Report($attack);

    if ($report->battle())
      return $report;

    return false;
  }

  private $attack;
  private $attackUnits;
  private $attackUnitCount;
  private $defendUnits;
  private $defendUnitCount;
  private $killedAttackersPercent;
  private $killedAttackersCount;
  private $killedDefendersPercent;
  private $killedDefendersCount;
  private $resultingAttackUnits;
  private $resultingAttackUnitCount;
  private $resultingDefendUnits;
  private $resultingDefendUnitCount;

  public function __construct($attack)
  {
    if ($attack == null)
      throw new Exception('$attack must not be null');

    $this->attack = $attack;
  }

  // calculates the results for the attack
	// 20% of the loosing troops are hiding/fleeing, so they won't get killed
  public function battle()
  {
    $this->attackUnits = $this->attack->attackUnits;
    $this->attackUnitCount = $this->attackUnits->sum('count')+0;

    if ($this->attackUnitCount < 1)
      return false;

    $this->defendUnits = $this->attack->defendUnits;
    $this->defendUnitCount = $this->defendUnits->sum('count')+0;

    if ($this->attackUnitCount < 1 || $this->defendUnitCount < 0)
      return false;

    if ($this->defendUnitCount == 0)
    {
      $this->killedAttackersPercent = 0;
      $this->killedDefendersPercent = 1;
      $this->killedAttackersCount = 0;
      $this->killedDefendersCount = 0;
      $this->resultingAttackUnitCount = $this->attackUnitCount;
      $this->resultingDefendUnitCount = 0;
      return true;
    }

  	$attackerWon = $this->attackerWon();
  	$actualAttackUnitCount = $this->getModifiedAttackUnitCount();
  	$actualDefendUnitCount = $this->getModifiedDefendUnitCount();

    // not all units will die
  	if ($attackerWon)
  	  $actualDefendUnitCount *= 0.8;
    else
      $actualAttackUnitCount *= 0.8;

  	$this->killedAttackersPercent = $actualDefendUnitCount / $actualAttackUnitCount;
    if ($this->killedAttackersPercent > 1)
      $this->killedAttackersPercent = 1;

  	$this->killedDefendersPercent = $actualAttackUnitCount / $actualDefendUnitCount;
    if ($this->killedDefendersPercent > 1)
      $this->killedDefendersPercent = 1;

  	$this->killedAttackersCount = ceil($this->attackUnitCount * $this->killedAttackersPercent);
  	$this->killedDefendersCount = ceil($this->defendUnitCount * $this->killedDefendersPercent);

    $this->resultingAttackUnitCount = $this->attackUnitCount - $this->killedAttackersCount;
    $this->resultingDefendUnitCount = $this->defendUnitCount - $this->killedDefendersCount;

  	return true;
  }

  public function attackerWon()
  {
    return ($this->getModifiedAttackUnitCount() > $this->getModifiedDefendUnitCount());
  }

  public function getModifiedAttackUnitCount()
  {
    $attackingDistrict = $this->attack->getSourceDistrictId();
    $buildingLevels = \Classes\BuildingLevel::where(array('district_id' => $attackingDistrict));
    $attackModifierSum = 0;
    $buildingCount = 0;
    if (null != $buildingLevels) {
      while (null != ($buildingLevel = $buildingLevels->next())) {
        $building = $buildingLevel->building;
        $attackModifier = $building->getUnitsAtk();
        $attackModifierSum += $attackModifier;
        $buildingCount += 1;
      }
    }

    if ($buildingCount < 1)
      $averageAttackModifier = 1;
    else
      $averageAttackModifier = $attackModifierSum / $buildingCount;

    return $this->attackUnitCount * $averageAttackModifier;
  }

  public function getModifiedDefendUnitCount()
  {
    $defendingDistrict = $this->attack->getTargetDistrictId();
    $buildingLevels = \Classes\BuildingLevel::where(array('district_id' => $defendingDistrict));
    $defenseModifierSum = 0;
    $buildingCount = 0;
    if (null != $buildingLevels) {
      while (null != ($buildingLevel = $buildingLevels->next())) {
        $building = $buildingLevel->building;
        $defenseModifier = $building->getUnitsDef();
        $defenseModifierSum += $defenseModifier;
        $buildingCount += 1;
      }
    }
    if ($buildingCount < 1)
      $averageDefenseModifier = 1;
    else
      $averageDefenseModifier = $defenseModifierSum / $buildingCount;

    return $this->defendUnitCount * $averageDefenseModifier;
  }

  public function getAttack()
  {
    return $this->attack;
  }

  public function getAttackUnits()
  {
    return $this->attackUnits;
  }

  public function getAttackUnitCount()
  {
    return $this->attackUnitCount;
  }

  public function getDefendUnits()
  {
    return $this->defendUnits;
  }

  public function getDefendUnitCount()
  {
    return $this->getDefendUnitCount;
  }

  public function getKilledAttackersPercent()
  {
    return $this->killedAttackersPercent;
  }

  public function getKilledAttackersCount()
  {
    return $this->killedAttackersCount;
  }

  public function getKilledDefendersPercent()
  {
    return $this->killedDefendersPercent;
  }

  public function getKilledDefendersCount()
  {
    return $this->killedDefendersCount;
  }

  public function getResultAttackUnits()
  {
    $resultAttackUnits = array();
    $killedAttackers = $this->killedAttackersCount;
    $attackUnits = $this->getAttackUnits();
    $attackUnits->rewind();
    while (($attackUnit = $attackUnits->next()) != NULL)
    {
      if ($killedAttackers < $attackUnit->getCount())
      {
        $unit = \Classes\Unit::find($attackUnit->getUnitId());
        array_push($resultAttackUnits, array('id'=>$unit->getUnitId(), 'name'=>$unit->getUnitName(), 'count'=>$attackUnit->getCount() - $killedAttackers));
      }

      $killedAttackers -= $attackUnit->getCount();
      if ($killedAttackers < 0)
        $killedAttackers = 0;
    }
    return $resultAttackUnits;
  }

  public function getResultDefendUnits()
  {
    $resultDefendUnits = array();
    $killedDefenders = $this->killedDefendersCount;
    $defendUnits = $this->getDefendUnits();
    $defendUnits->rewind();
    while(($defendUnit = $defendUnits->next()) != NULL)
    {
      if ($killedDefenders < $defendUnit->getCount())
      {
        $unit = \Classes\Unit::find($defendUnit->getUnitId());
        array_push($resultDefendUnits, array('id'=>$unit->getUnitId(), 'name'=>$unit->getUnitName(), 'count'=>$defendUnit->getCount() - $killedDefenders));
      }

      $killedDefenders -= $defendUnit->getCount();
      if ($killedDefenders < 0)
        $killedDefenders = 0;
    }

    return $resultDefendUnits;
  }
}

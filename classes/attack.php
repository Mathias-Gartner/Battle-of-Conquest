<?php

namespace Classes;

class Attack extends \TORM\Model
{
  /*public enum AttackState
  {
    Engaging = 0,
    BattleOver = 1,
    Cancelled = 2
  }*/

  public function getAttackId()
  {
    return $this->get("attack_id");
  }

  public function getSourceDistrictId()
  {
    return $this->get("source_district_id");
  }
  
  public function setSourceDistrictId($sourceDistrictId)
  {
    $this->set("source_district_id", $sourceDistrictId);
  }
  
  public function getTargetDistrictId()
  {
    return $this->get("target_district_id");
  }
  
  public function setTargetDistrictId($targetDistrictId)
  {
    $this->set("target_district_id", $targetDistrictId);
  }
  
  public function getStartTime()
  {
    return $this->get("start_time");
  }
  
  public function setStartTime($startTime)
  {
    $this->set("start_time", $startTime);
  }
  
  public function getBattleTime()
  {
    return $this->get("battle_time");
  }
  
  public function setBattleTime($battleTime)
  {
    $this->set("battle_time", $battleTime);
  }
  
  public function getBattleState()
  {
    return $this->get("battle_state");
  }
  
  public function setBattleState($state)
  {
    return $this->set("battle_state", $state);
  }
  
  public function getBattleOver()
  {
  	return $this->getBattleState() == 1;
  }
  
  public function setBattleOver()
  {
  	$this->setBattleState(1);
  }
  
  public function getAttackerWon()
  {
  	return $this->get("attacker_won");
  }
  
  public function setAttackerWon($attackerWon)
  {
  	$this->set("attacker_won", $attackerWon);
  }
  
  public function cancel()
  {
    if ($this->getBattleOver())
      return;
      
    $this->setBattleState(2);
    return $this->save();
  }
}

Attack::setPK("attack_id");
Attack::setTableName("attacks");
Attack::belongsTo("sourceDistrict", array("class_name"=>"\Classes\District", "primary_key"=>"district_id", "foreign_key"=>"source_district_id"));
Attack::belongsTo("targetDistrict", array("class_name"=>"\Classes\District", "primary_key"=>"district_id", "foreign_key"=>"target_district_id"));
Attack::hasMany("attackUnits", array("class_name"=>"\Classes\AttackUnit", "foreign_key"=>"attack_id"));
Attack::validates("battle_time", array("presence"=>true));

?>

<?php

namespace Classes;

class Attack extends \TORM\Model
{
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
  
  public function getBattleTime()
  {
    return $this->get("battle_time");
  }
  
  public function setBattleTime($battleTime)
  {
    $this->set("battle_time", $battleTime);
  }
  
  public function getBattleOver()
  {
  	return $this->get("battle_over");
  }
  
  public function setBattleOver($battleOver)
  {
  	$this->set("battle_over", $battleOver);
  }
  
  public function getAttackerWon()
  {
  	return $this->get("attacker_won");
  }
  
  public function setAttackerWon($attackerWon)
  {
  	$this->set("attacker_won", $attackerWon);
  }
}

Attack::setPK("attack_id");
Attack::setTableName("attacks");
Attack::belongsTo("sourceDistrict", array("class_name"=>"\Classes\District", "primary_key"=>"district_id", "foreign_key"=>"source_district_id"));
Attack::belongsTo("targetDistrict", array("class_name"=>"\Classes\District", "primary_key"=>"district_id", "foreign_key"=>"target_district_id"));
Attack::hasMany("attackUnits", array("class_name"=>"\Classes\AttackUnit", "foreign_key"=>"attack_id"));
Attack::validates("battle_time", array("presence"=>true));

?>

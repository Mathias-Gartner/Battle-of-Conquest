<?php

namespace Classes;

class Attack extends \TORM\Model
{
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
}

AttackUnit::setTableName("attacks");
AttackUnit::belongsTo("sourceDistrict", array("class_name"=>"District", "primary_key"=>"district_id", "foreign_key"=>"source_district_id"));
AttackUnit::hasOne("targetDistrict", array("class_name"=>"District", "primary_key"=>"district_id", "foreign_key"=>"target_district_id"));
AttackUnit::validates("battle_time", array("presence"=>true));

?>

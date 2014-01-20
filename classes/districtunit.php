<?php 

namespace Classes;

class DistrictUnit extends \TORM\Model
{
	public function setUnitId($unitId)
	{
		$this->set("unit_id", $unitId);
	}
	
	public function setDistrictId($districtId)
	{
		$this->set("district_id", $districtId);
	}

	public function getCount()
	{
		return $this->get("count");
	}
	
	public function setCount($count)
	{
		$this->set("count", $count);
	}
}

DistrictUnit::setPK("id");
DistrictUnit::setTableName("district_units");
DistrictUnit::belongsTo("district", array("class_name"=>"District", "primary_key"=>"district_id", "foreign_key"=>"district_id"));
DistrictUnit::hasOne("unit", array("class_name"=>"Unit", "primary_key"=>"unit_id", "foreign_key"=>"unit_id"));
DistrictUnit::validates("count", array("numericality"=>true));

 ?>

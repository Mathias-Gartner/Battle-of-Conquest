<?php

namespace Classes;

class DistrictUnit extends \TORM\Model
{
	public function setUnitId($unitId)
	{
		$this->set("unit_id", $unitId);
	}

	public function getUnitId()
	{
		return $this->get("unit_id");
	}

	public function setDistrictId($districtId)
	{
		$this->set("district_id", $districtId);
	}

	public function getDistrictId()
	{
		return $this->get("district_id");
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
DistrictUnit::belongsTo("districts", array("class_name"=>"\Classes\District", "primary_key"=>"district_id", "foreign_key"=>"district_id"));
DistrictUnit::hasOne("units", array("class_name"=>"\Classes\Unit", "primary_key"=>"unit_id", "foreign_key"=>"unit_id"));
DistrictUnit::validates("count", array("numericality"=>true));

 ?>

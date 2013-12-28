<?php 

namespace Classes;

class District extends \TORM\Model
{
	public function getName()
	{
		return $this->get("district_name");
	}
	
	public function setName($name)
	{
		$this->set("district_name", $name);
	}
	
	public function getOwnerId()
	{
	  return $this->get("owner_id");
	}
	
	public function getPositionX()
	{
		return $this->get("position_x");
	}
	
	public function getPositionY()
	{
		return $this->get("position_y");
	}
	
	public function setPosition($x, $y)
	{
		if ($this->is_new())
		{
			$this->set("position_x", $x);
			$this->set("position_y", $y);
		}
		else
		{
			TROM\Log::log("setPosition failed. Operation not allowed.");
		}
	}
	
	public function getDistrictThreat()
	{
	  return $this->get("district_threat");
	}
	
	public function setDistrictThreat($districtThreat)
	{
	  $this->set("district_threat", $districtThreat);
	}
}

District::setPK("district_id");
District::belongsTo("owner", array("class_name"=>"User", "primary_key"=>"user_id", "foreign_key"=>"owner_id"));
District::hasMany("activeUsers", array("class_name"=>"ActiveUser", "foreign_key"=>"district_id"));
District::hasMany("buildings", array("class_name"=>"BuildingLevel", "foreign_key"=>"district_id"));
District::hasMany("distances", array("class_name"=>"Distance", "foreign_key"=>"district_a"));
District::hasMany("districtUnits", array("class_name"=>"DistrictUnit", "foreign_key"=>"district_id"));
District::validates("district_name", array("presence"=>true));
District::validates("position_x", array("numericality"=>true));
District::validates("position_y", array("numericality"=>true));
District::validates("district_threat", array("numericality"=>true));

 ?>

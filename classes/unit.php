<?php 

namespace Classes;

class Unit extends \TORM\Model
{
	public function getUnitName()
	{
		return $this->get("unit_name");
	}
	
	public function setUnitName($name)
	{
		$this->set("unit_name", $name);
	}
	
	public function getUnitClass()
	{
		return $this->get("unit_class");
	}
	
	public function setUnitClass($class)
	{
		$this->set("unit_class");
	}
	
	public function getUnitAtk()
	{
		return $this->get("unit_atk");
	}
	
	public function setUnitAtk($atk)
	{
		$this->set("unit_atk", $atk);
	}
	
	public function getUnitDef()
	{
		return $this->get("unit_def");
	}
	
	public function setUnitDef($def)
	{
		$this->set("unit_def", $def);
	}
	
	public function getUnitSpeed()
	{
		return $this->get("unit_speed");
	}
	
	public function setUnitSpeed($speed)
	{
		$this->set("unit_speed", $speed);
	}
	
	public function getUnitResources()
	{
		return $this->get("unit_res");
	}
	
	public function setUnitResources($resources)
	{
		$this->set("unit_res", $resources);
	}
}

Unit::setPK("user_id");
Unit::validates("unit_name", array("presence"=>true));
Unit::validates("unit_class", array("presence"=>true));
Unit::validates("unit_atk", array("numericality"=>true));
Unit::validates("unit_def", array("numericality"=>true));
Unit::validates("unit_speed", array("numericality"=>true));
Unit::validates("unit_res", array("numericality"=>true));

 ?>

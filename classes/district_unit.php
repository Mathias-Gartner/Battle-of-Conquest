<?php 

namespace Classes;

class BuiltUnit extends \TORM\Model
{
	public function getCount()
	{
		return $this->get("count");
	}
	
	public function setCount($count)
	{
		$this->set("count", $count);
	}
}

Unit::setPK("id");
Unit::belongsTo("district", array("class_name"=>"District", "primary_key"=>"district_id", "foreign_key"=>"district_id"));
Unit::validates("count", array("numericality"=>true));

 ?>

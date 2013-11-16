<?PHP

class BuildingLevel extends TORM\Model
{
	public function getLevel()
	{
	  return get("level");
	}
	
	public function setLevel($level)
	{
	  return set("level", $level);
	}
}

BuildingLevel::setTableName("buildings_level");
BuildingLevel::belongsTo("building", array("class_name"=>"Building", "primary_key"=>"building_id", "foreign_key"=>"building_id"));
BuildingLevel::belongsTo("district", array("class_name"=>"District", "primary_key"=>"district_id", "foreign_key"=>"district_id"));
BuildingLevel::validates("level", array("numericality"=>true));

?>

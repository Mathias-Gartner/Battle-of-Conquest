<?PHP

namespace Classes;

class Building extends \TORM\Model
{
	public function getBuildingID()
	{
		return $this->get("building_id");
	}
    
	public function getBuildingName()
	{
		return $this->get("building");
	}

	public function setBuildingName($building)
	{
		$this->set("building", $building);
	}

	public function getResources()
	{
		return $this->get("resources");
	}

	public function setResources($resources)
	{
		$this->set("resources", $resources);
	}

	public function getMoral()
	{
		return $this->get("moral");
	}

	public function setMoral($moral)
	{
		$this->set("moral", $moral);
	}

	public function getPeople()
	{
		return $this->get("people");
	}

	public function setPeople($people)
	{
		$this->set("people", $people);
	}

	public function getDiseases()
	{
		return $this->get("diseases");
	}

	public function setDiseases($diseases)
	{
		$this->set("diseases", $diseases);
	}

	public function getLuck()
	{
		return $this->get("luck");
	}

	public function setLuck($luck)
	{
		$this->set("luck", $luck);
	}

	public function getUnitsAtk()
	{
		return $this->get("units_atk");
	}

	public function setUnitsAtk($atk)
	{
		$this->set("units_atk", $atk);
	}

	public function getUnitsDef()
	{
		return $this->get("units_def");
	}

	public function setUnitsDef($def)
	{
		$this->set("units_def", $def);
	}

	public function getMoveSpeed()
	{
		return $this->get("move_speed");
	}

	public function setMoveSpeed($moveSpeed)
	{
		$this->set("move_speed", $moveSpeed);
	}

	public function getBuildSpeed()
	{
		return $this->get("build_speed");
	}

	public function setBuildSpeed($buildSpeed)
	{
		$this->set("build_speed", $buildSpeed);
	}

	public function getResourceSpeed()
	{
		return $this->get("resource_speed");
	}

	public function setResourceSpeed($resourceSpeed)
	{
		return $this->set("resource_speed", $resourceSpeed);
	}
}

Building::setPK("building_id");
Building::validates("building", array("presence"=>true));
Building::validates("resources", array("numericality"=>true));
Building::validates("moral", array("numericality"=>true));
Building::validates("people", array("numericality"=>true));
Building::validates("diseases", array("numericality"=>true));
Building::validates("luck", array("numericality"=>true));
Building::validates("units_atk", array("numericality"=>true));
Building::validates("units_def", array("numericality"=>true));
Building::validates("move_speed", array("numericality"=>true));
Building::validates("build_speed", array("numericality"=>true));
Building::validates("resource_speed", array("numericality"=>true));

?>

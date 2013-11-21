<?PHP

namespace Classes;

class Distance extends \TORM\Model
{
	public function setDistricts($districtA, $districtB)
	{
		$this->set("district_a", $districtA);
		$this->set("district_b", $districtB);
	}
	
	public function getTime()
	{
		return $this->get("time");
	}
	
	public function setTime($time)
	{
		$this->set("time", $time);
	}
	
	public function getDistance()
	{
		return $this->get("distance");
	}
	
	public function setDistance($distance)
	{
		return $this->set("distance", $distance);
	}
}

Distance::setPK("distance_id");
Distance::belongsTo("districtA", array("class_name"=>"District", "primary_key"=>"district_id", "foreign_key"=>"district_a");
Distance::belongsTo("districtB", array("class_name"=>"District", "primary_key"=>"district_id", "foreign_key"=>"district_b");
Distance::validates("distance", array("numericality"=>true));

?>

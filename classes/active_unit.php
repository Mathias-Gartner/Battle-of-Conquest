<?PHP

class ActiveUnit extends TORM\Model
{
  public function getAttacker()
	{
		return $this->get("attacker");
	}
	
	public function setAttacker($attacker)
	{
		$this->set("attacker", $attacker);
	}
	
	public function getDefender()
	{
		return $this->get("defender");
	}
	
	public function setDefender($defender)
	{
		$this->set("defender", $defender);
	}
	
	public function getSupporter()
	{
		return $this->get("supporter");
	}
	
	public function setSupporter($supporter)
	{
		$this->set("supporter", $supporter);
	}
}

ActiveUnit::setTableName("active_units");
ActiveUnit::belongsTo("district", array("class_name"=>"District", "primary_key"=>"district_id", "foreign_key"=>"district_id"));
ActiveUnit::validates("attacker", array("numericality"=>true));
ActiveUnit::validates("defender", array("numericality"=>true));
ActiveUnit::validates("supporter", array("numericality"=>true));

?>

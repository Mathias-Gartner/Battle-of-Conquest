<?PHP

namespace Classes;

class AttackUnit extends \TORM\Model
{
  public function getUnitId()
  {
    return $this->get('unit_id');
  }
  
  public function setUnitId($unitId)
  {
    $this->set('unit_id', $unitId);
  }

  public function getAttackId()
  {
    return $this->get('attack_id');
  }
  
  public function setAttackId($attackId)
  {
    $this->set('attack_id', $attackId);
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

AttackUnit::setTableName("attack_units");
AttackUnit::belongsTo("district", array("class_name"=>"District", "primary_key"=>"district_id", "foreign_key"=>"district_id"));
AttackUnit::hasOne("unit", array("class_name"=>"unit_id", "primary_key"=>"unit_id", "foreign_key"=>"unit_id"));
AttackUnit::validates("count", array("numericality"=>true));

?>

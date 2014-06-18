<?PHP

namespace Classes;

class AttackingUnit extends \TORM\Model
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

AttackingUnit::setTableName("attacking_units");
AttackingUnit::belongsTo("district", array("class_name"=>"\Classes\District", "primary_key"=>"district_id", "foreign_key"=>"district_id"));
AttackingUnit::hasOne("unit", array("class_name"=>"\Classes\Unit", "primary_key"=>"unit_id", "foreign_key"=>"unit_id"));
AttackingUnit::validates("count", array("numericality"=>true));

?>

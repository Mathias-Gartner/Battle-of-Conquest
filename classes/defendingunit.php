<?PHP

namespace Classes;

class DefendingUnit extends \TORM\Model
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

DefendingUnit::setTableName("defending_units");
DefendingUnit::belongsTo("district", array("class_name"=>"\Classes\District", "primary_key"=>"district_id", "foreign_key"=>"district_id"));
DefendingUnit::hasOne("unit", array("class_name"=>"\Classes\Unit", "primary_key"=>"unit_id", "foreign_key"=>"unit_id"));
DefendingUnit::validates("count", array("numericality"=>true));

?>

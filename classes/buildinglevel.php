<?PHP

namespace Classes;

class BuildingLevel extends \TORM\Model {

  public function getDistrict() {
    return $this->get("district_id");
  }
  
  public function setDistrict($id) {
    return $this->set("district_id", $id);
  }

  public function getBuildingID() {
    return $this->get("building_id");
  }
  
  public function setBuildingID($id) {
    return $this->set("building_id", $id);
  }

  public function getLevel() {
    return $this->get("level");
  }

  public function setLevel($level) {
    return $this->set("level", $level);
  }

}

BuildingLevel::setTableName("buildings_level");
BuildingLevel::belongsTo("building", array("class_name" => "\Classes\Building", "primary_key"=>"building_id", "foreign_key"=>"building_id"));
BuildingLevel::belongsTo("district", array("class_name" => "\Classes\District", "primary_key"=>"district_id", "foreign_key"=>"district_id"));
BuildingLevel::validates("level", array("numericality" => true));
?>

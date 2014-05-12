<?php

namespace PageHandlers;

use Classes\BuildingLevel;

class BuildingsPageHandler extends PageHandler {

  public function handle() {
    if (isset($_GET['district'])) {
      $this->districtID = $_GET['district'];
    }
    if (isset($_GET['id'])) {
      $this->setAjaxTemplate('string');
      $this->ajaxRequest();
    } else {
      $this->setPhpTemplate('buildings');
    }
    return $this;
  }
  
  private $districtID = 0;

  private function ajaxRequest() {
    if (isset($_GET['list'])) {
      $this->getBuiltBuildings();
    } else if (isset($_GET['build'])) {
      $this->build();
    } else {
      $this->getName();
    }
    return $this;
  }

  private function getBuiltBuildings() {
    $result = array();
    $buildings = \Classes\BuildingLevel::where(array('district_id' => $this->$districtID));
    if (null != $buildings) {
      while (null != ($building = $buildings->next())) {
        array_push($result, array(
            'district' => $building->getDistrict(),
            'building' => $building->getBuilding()));
      }
    }
    $this->setPageData('value', json_encode($array));
  }

  private function build() {
    $buildingTest = \Classes\BuildingLevel::where(array('building_id' => $_GET['id']));
    if (0 == $buildingTest->count()) {
      $building = new BuildingLevel();
      $building->setDistrict(1);
      $building->setBuilding($_GET['id']);
      $building->setLevel(1);
      $save = $building->save();
      if (1 != $save) {
        $this->setPageData('value', 'err');
      }
    } else {
      $this->setPageData('value', 'false');
    }
  }

  private function getName() {
    $buildingName = \Classes\Building::find($_GET['id']);
    if (null != $buildingName) {
      $this->setPageData('value', $buildingName->getBuilding());
    }
  }

}

?>

<?php

namespace PageHandlers;

use Classes\BuildingLevel;

class BuildingsPageHandler extends PageHandler {

  public function handle() {
    if (isset($_GET['id']) || isset($_POST['district'])) {
      $this->setAjaxTemplate('string');
      $this->ajaxRequest();
    } else {
      $this->setPhpTemplate('buildings');
    }
    return $this;
  }

  private function ajaxRequest() {
    if (isset($_POST['district'])) {
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
    $buildings = \Classes\BuildingLevel::where(array('district_id' => $_POST['district']));
    if (null != $buildings) {
      while (null != ($building = $buildings->next())) {
        array_push($result, array(
            'district' => $building->getDistrict(),
            'building' => $building->getBuilding(),
            'level' => $building->getLevel()));
      }
    }
    $this->setPageData('value', json_encode($result));
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
      } else {
        $this->setPageData('value', 'ok');
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

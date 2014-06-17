<?php

namespace PageHandlers;

use Classes\BuildingLevel;

class BuildingsPageHandler extends PageHandler {

  public function handle() {
    if (isset($_POST['districtID'])) {
      $this->ajaxRequest();
    } else {
      $this->setPhpTemplate('buildings');
    }
    return $this;
  }

  private function ajaxRequest() {
    if (isset($_POST['loadBuildings'])) {
      $this->sendBuiltBuildings($_POST['districtID']);
    } else if (isset($_POST['loadCityName'])) {
      $this->sendDistrictName($_POST['districtID']);
//    } else if (isset($_POST['getAllBuildingNames'])) {
//      $this->setAjaxTemplate('json');
//      $this->getAllBuildingNames();
//    } else if (isset($_POST['getName'])) {
//      $this->setAjaxTemplate('string');
//      $this->setPageData('value', $this->getBuildingName($_POST['buildingID']));
    } else if (isset($_POST['build']) && isset($_POST['buildingID'])) {
      $this->build($_POST['districtID']);
    } else {
      $this->getBuildingName();
    }
    return $this;
  }

//  private function getAllBuildingNames() {
//    $result = array();
//    $buildings = \Classes\Building::all();
//    if (null != $buildings) {
//      while (null != ($building = $buildings->next())) {
//        array_push($result, array('buildingName' => $building->getBuilding()));
//      }
//    }
//    $this->setPageData('value', $result);
//  }
  
  private function sendDistrictName($districtID) {
    $this->setAjaxTemplate('string');
    
    $district = \Classes\District::find($districtID);
    $name = $district->getName();
    $this->setPageData('value', $name);
  }
  
  private function sendBuiltBuildings($districtID) {
    $this->setAjaxTemplate('json');
    $result = array();

    $buildingLevel = \Classes\BuildingLevel::where(array('district_id' => $districtID));
    if (null != $buildingLevel) {
      while (null != ($building = $buildingLevel->next())) {
        $buildingID = $building->getBuilding();
        array_push($result, array(
            'buildingID' => $buildingID,
            'level' => $building->getLevel(),
            'buildingName' => $this->getBuildingName($buildingID)));
      }
    }

    $this->setPageData('value', $result);
  }

  private function getBuildingName($buildingID) {
    $building = \Classes\Building::find($buildingID);
    return $building->getBuilding();
  }

  private function build($districtID) {
    $this->setAjaxTemplate('string');

    $buildingID = $_POST['buildingID'];
    $buildingTest = \Classes\BuildingLevel::where(array('building_id' => $buildingID));
    if (0 == $buildingTest->count()) {
      $building = new BuildingLevel();
      $building->setDistrict($districtID);
      $building->setBuilding($buildingID);
      $building->setLevel(1);
      $save = $building->save();
    }
  }

}

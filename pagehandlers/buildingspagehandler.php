<?php

namespace PageHandlers;

use Classes\BuildingLevel;

class BuildingsPageHandler extends PageHandler {

  public function handle() {
    if (isset($_POST['districtID'])) {
      $this->ajaxRequest();
    } else {
      if (isset($_GET['mapid']) && is_numeric($_GET['mapid'])) {
        $district = \Classes\District::find($_GET['mapid']);
        if ($district != null)
        {
          if ($district->getOwnerId() != $_SESSION['userid'])
          {
            $this->setReturnCode(403);
            $this->setMessage('You can only view your own districts');
            return $this;
          }
          $_SESSION['currentdistrict'] = $_GET['mapid'];
        }
      }
      $this->setPhpTemplate('buildings');
    }
    return $this;
  }

  private function ajaxRequest() {
    if (isset($_POST['loadBuildings'])) {
      $this->sendBuiltBuildings($_POST['districtID']);
    } else if (isset($_POST['loadDistrictName'])) {
      $this->sendDistrictName($_POST['districtID']);
    } else if (isset($_POST['getAllBuildings'])) {
      $this->sendAllBuildings();
    } else if (isset($_POST['build']) && isset($_POST['buildingID'])) {
      $this->build($_POST['districtID']);
    }
    return $this;
  }

  private function sendAllBuildings() {
    $this->setAjaxTemplate('json');
    $result = array();

    $buildings = \Classes\Building::all();
    if (null != $buildings) {
      while (null != ($building = $buildings->next())) {
        array_push($result, array(
            'buildingID' => $building->getBuildingID(),
            'buildingName' => $building->getBuildingName(),
            'buildingCost' => $building->getResources(),
            'attackModifier' => $building->getUnitsAtk(),
            'defenseModifier' => $building->getUnitsDef(),
            'moraleModifier' => $building->getMoral()));
      }
    }

    $this->setPageData('value', $result);
  }

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
        $buildingID = $building->getBuildingID();
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
    return $building->getBuildingName();
  }

  private function build($districtID) {
    $buildingID = $_POST['buildingID'];

    $builder = \Classes\BuildingLevel::makeBuilder();
    $builder->limit = 2;
    $builder->where = 'building_id = ? AND district_id = ?';
    $buildingTest = new \Torm\Collection(
            $builder, array($buildingID, $districtID), '\Classes\BuildingLevel');

    if (0 == $buildingTest->count()) {
      $building = new BuildingLevel();
      $building->setDistrict($districtID);
      $building->setBuildingID($buildingID);
      $building->setLevel(1);
      $save = $building->save();
    }
  }

}

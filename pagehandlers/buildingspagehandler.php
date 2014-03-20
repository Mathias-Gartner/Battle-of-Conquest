<?php
namespace PageHandlers;

use Classes\BuildingLevel;
class BuildingsPageHandler extends PageHandler
{

    public function handle()
    {
        if (isset($_GET['id']))
        {
            return $this->ajaxRequest();
        }
        else if (isset($_GET['buildId']))
        {
           //$building = new BuildingLevel() ;
           //$building->save();
           $this->setPhpTemplate('buildings');
           return $this;
        }
        else
        {
            $this->setPhpTemplate('buildings');
            return $this;
        }
    }

    private function ajaxRequest()
    {
        // get building name from id
        $buildingName = \Classes\Building::find($_GET['id']);
        if ($buildingName != null)
	        echo $buildingName->getBuilding();
	        
        return $this;
    }

    private function hey()
    {
        $this->setPhpTemplate('buildings');
        return $this;
    }
}

?>

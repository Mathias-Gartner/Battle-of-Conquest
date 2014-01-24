<?php
namespace PageHandlers;

class BuildingsPageHandler extends PageHandler
{

    public function handle()
    {
        if (isset($_GET['id'])) {
            return $this->ajaxRequest();
        } else {
            $this->setPhpTemplate('buildings');
            return $this;
        }
    }

    private function ajaxRequest()
    {
        // get building name from id
        $buildingName = \Classes\Building::find($_GET['id']);
        echo $buildingName->getBuilding();
        return $this;
    }
}

?>

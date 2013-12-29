<?php

namespace PageHandlers;

class MapPageHandler extends PageHandler
{
	public function handle()
	{
		if (isset($_GET['terrain']))
		{
			switch($_GET['terrain'])
			{
				case 'high_cities':
					$this->setPhpTemplate('high_cities');
					break;
				case 'open_docks':
					$this->setPhpTemplate('open_docks');
					break;
				case 'great_canyons':
					$this->setPhpTemplate('great_canyons');
					break;
			}
		}
		else
		{
			$this->setPhpTemplate('map');
		}
	  return $this;
	}
}

?>

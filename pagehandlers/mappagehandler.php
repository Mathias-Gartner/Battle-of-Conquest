<?php

namespace PageHandlers;

class MapPageHandler extends PageHandler
{
	public function handle()
	{
		$this->setPhpTemplate('map');
	  return $this;
	}
}

?>

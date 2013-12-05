<?php

namespace PageHandlers;

class BuildingsPageHandler extends PageHandler
{
	public function handle()
	{
		$this->setPhpTemplate('buildings');
	  return $this;
	}
}

?>

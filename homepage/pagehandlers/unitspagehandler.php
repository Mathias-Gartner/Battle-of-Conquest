<?php

namespace PageHandlers;

class UnitsPageHandler extends PageHandler
{
	public function handle()
	{
		$this->setPhpTemplate('units');
	  return $this;
	}
}

?>

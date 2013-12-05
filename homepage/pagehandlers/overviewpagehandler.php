<?php

namespace PageHandlers;

class OverviewPageHandler extends PageHandler
{
	public function handle()
	{
		$this->setPhpTemplate('overview');
	  return $this;
	}
}

?>

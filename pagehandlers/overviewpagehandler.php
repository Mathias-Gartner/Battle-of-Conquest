<?php

namespace PageHandlers;

class OverviewPageHandler extends PageHandler
{
	public function handle()
	{
		$this->setTemplate('overview');
	  return $this;
	}
}

?>

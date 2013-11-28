<?php

namespace PageHandlers;

class WelcomePageHandler extends PageHandler
{
	public function handle()
	{
		$this->setTemplate('welcome');
	  return $this;
	}
}

?>

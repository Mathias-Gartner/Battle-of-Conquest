<?php

namespace PageHandlers;

class WelcomePageHandler extends PageHandler
{
	public function handle()
	{
		$this->setPhpTemplate('welcome');
	  return $this;
	}
	
	public function loginRequired()
  {
    return false;
  }
}

?>

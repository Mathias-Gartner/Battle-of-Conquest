<?php

namespace PageHandlers;

class FooterPageHandler extends PageHandler
{
	public function handle()
	{
		$this->setPhpTemplate('footerpages');
	  	return $this;
	}
	
	public function loginRequired()
  {
    return false;
  }
}

?>

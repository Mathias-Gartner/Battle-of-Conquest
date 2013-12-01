<?php

namespace PageHandlers;

class AttacksPageHandler extends PageHandler
{
	public function handle()
	{
		$this->setPhpTemplate('attacks');
	  return $this;
	}
}

?>

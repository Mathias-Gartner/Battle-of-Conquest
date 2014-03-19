<?php

namespace PageHandlers;

class LogoutPageHandler extends PageHandler
{
	public function handle()
	{
		unset($_SESSION['username']);
		unset($_SESSION['userid']);
		
		//redirect
		$handler = new WelcomePageHandler();
		$handler->handle();
		return $handler;
	}
}

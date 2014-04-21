<?php

class RequestHandler
{
	public static function handle()
	{
		BattleHandler::handlePendingBattles();

		TORM\Log::enable(false);

		$action = null;
		if (isset($_GET['action']))
			$action = $_GET['action'];

		$pageHandler = RequestHandler::getPageHandlerForAction($action);

		if ($pageHandler != null)
		{
			if ($pageHandler->loginRequired() && !SessionUtility::isLoggedIn())
				$pageHandler = new PageHandlers\LoginPageHandler();

			$pageHandler = $pageHandler->handle();
			$pageHandler->render();
			exit(0);
		}

		// orm samples
		/* create object
		$user = new Classes\User();
		$user->setUsername('admin');
		$user->setAge(1);
		$user->mail('admin@localhost.com');
		$user->setPassword('123456');
		$user->save();
		/**/

		/* load object
		$user = Classes\User::find(1);
		var_dump($user);
		$collection = $user->districts;
		while (($district = $collection->next()) != NULL)
		echo '<p>'.$district->getName().'</p>';
		/**/

		/* create object with relation
		$district = new Classes\District();
		$district->setName('Entenhausen');
		$district->setPosition(5, 10);
		$district->setDistrictThreat(2);
		$district->owner_id = 0; // 0 .. pk of user
		$district->save();
		/**/

		/* load object with relation
		$district = Classes\District::first(array('district_name'=>'Entenhausen'));
		var_dump($district->owner); // prints user
		/**/
	}
	
	public static function getPageHandlerForAction($action)
	{
		$pageHandler = null;
		if ($action != null)
		{
			switch ($action)
			{
			case 'login':
				$pageHandler = new PageHandlers\LoginPageHandler();
				break;
			case 'logout':
				$pageHandler = new PageHandlers\LogoutPageHandler();
				break;
			case 'register':
				$pageHandler = new PageHandlers\RegisterPageHandler();
				break;
			case 'overview':
				$pageHandler = new PageHandlers\OverviewPageHandler();
				break;
			case 'buildings':
				$pageHandler = new PageHandlers\BuildingsPageHandler();
				break;
			case 'units':
				$pageHandler = new PageHandlers\UnitsPageHandler();
				break;
			case 'attacks':
				$pageHandler = new PageHandlers\AttacksPageHandler();
				break;
			case 'map':
				$pageHandler = new PageHandlers\MapPageHandler();
				break;
			case 'prepareAttack':
				$pageHandler = new PageHandlers\PrepareAttackPageHandler();
				break;
			case 'startAttack':
				$pageHandler = new PageHandlers\StartAttackPageHandler();
				break;
			case 'cityname':
				$pageHandler = new PageHandlers\CityNamesPageHandler();
				break;
			case 'footer':
				$pageHandler = new PageHandlers\FooterPageHandler();
				break;
			default:
				header('HTTP/1.1 404 Not Found');
				echo '<h1>404 Unkown Action</h1>';
				break;
			}
		}
		else
		{
			$pageHandler = new PageHandlers\WelcomePageHandler();
		}
		return $pageHandler;
	}
}

?>

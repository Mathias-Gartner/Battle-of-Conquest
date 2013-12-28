<?php

class RequestHandler
{
	public static function handle()
	{
		TORM\Log::enable(true);
  	
		$pageHandler = null;
		if (isset($_GET['action']) )
		{
			switch ($_GET['action'])
			{
			case 'login':
				$pageHandler = new PageHandlers\LoginPageHandler();
				break;
			case 'overview':
				$pageHandler = new PageHandlers\OverviewPageHandler();
				break;
			case 'buildings':
				$pageHandler = new Pagehandlers\BuildingsPageHandler();
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
}

?>

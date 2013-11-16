<?php

require 'classes/user.php';
require 'classes/district.php';

class RequestHandler
{
  public static function handle()
  {
  	TORM\Log::enable(true);
  	
    /* create object
    $user = new User();
    $user->setUsername("admin");
    $user->setAge(1);
    $user->mail("admin@localhost.com");
    $user->setPassword("123456");
    $user->save();
    /**/
    
    //* load object
   	$user = User::find(1);
   	var_dump($user);
   	$collection = $user->districts;
   	while (($district = $collection->next()) != NULL)
   	  echo "<p>".$district->getName()."</p>";
   	/**/
   	
   	/* create object with relation
   	$district = new District();
   	$district->setName("Entenhausen");
   	$district->setPosition(5, 10);
   	$district->setDistrictThreat(2);
   	$district->owner_id = 0; // 0 .. pk of user
   	$district->save();
   	/**/
   	
   	/* load object with relation
   	$district = District::first(array("district_name"=>"Entenhausen"));
   	var_dump($district->owner); // prints user
   	/**/
  }
}

?>

<?php

namespace PageHandlers;

class RegisterPageHandler extends PageHandler
{ 
  public function handle()
  {
    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['mail']))
    {
      $user = \Classes\User::first(array('username'=>$_POST['username']));
      if ($user == null)
      {
		  //create user
		  $user = new \Classes\User();
		  $user->setUsername($_POST['username']);
		  $user->setMail($_POST['mail']);
		  $user->setPassword($_POST['password']);
		  $user->setAge($_POST['age']);
		  $user->save();
		  
		  //set users district
		  $district = \Classes\District::first(array("owner_id"=>1));
		  $district->setOwnerId($user->getUserId());
		  $district->save();
		  
		  //set users units
		  $districtunit = new \Classes\DistrictUnit();
		  $districtunit->setUnitId(1);			//temporary set always 1
		  $districtunit->setCount(20);
		  $districtunit->setDistrictId($district->getDistrictId());
		  $districtunit->save();
		  
          $_SESSION['username'] = $user->getUsername();
          $_SESSION['userid'] = $user->getUserId();
		  
          // redirect internally
          $overviewPageHandler = new OverviewPageHandler();
          $overviewPageHandler->handle();
		  
		  		  
		  
          return $overviewPageHandler;
      }else{
		  //username already exists
		  $this->showLoginValidationError('Username already exists');
		  $this->setPhpTemplate('register');
    	  return $this;
	  }
      
      // only reached in case of unsuccessful login
      $this->showLoginValidationError('Registration failed. Please check your input.');
    }
    
    $this->setPhpTemplate('register');
    return $this;
  }
  
  
  public function showLoginValidationError($errormsg)
  {
    $this->setPageData('registerError', true);
	$this->setPageData('errormsg', $errormsg);
  }
  
  public function loginRequired()
  {
    return false;
  }
}

?>

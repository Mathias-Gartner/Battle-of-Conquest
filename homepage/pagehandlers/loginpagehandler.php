<?php

namespace PageHandlers;

class LoginPageHandler extends PageHandler
{
  public function handle()
  {
    if (isset($_POST['username']) && isset($_POST['password']))
    {
      $user = \Classes\User::first(array('username'=>$_POST['username']));
      if ($user != null)
      {
        if ($user->comparePassword($_POST['password']))
        {
          $_SESSION['username'] = $user->getUsername();
          // redirect internally
          $overviewPageHandler = new OverviewPageHandler();
          $overviewPageHandler->handle();
          return $overviewPageHandler;
        }
      }
      
      // only reached in case of unsuccessful login
      $this->showLoginValidationError();
    }
    
    $this->setPhpTemplate('login');
    return $this;
  }
  
  
  public function showLoginValidationError()
  {
    $this->setPageData('loginError', true);
  }
  
	public function loginRequired()
  {
    return false;
  }
}

?>

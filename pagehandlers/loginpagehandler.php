<?php

class LoginPageHandler extends PageHandler
{
  public function handle()
  {
    if (isset($_POST['username']) && isset($_POST['password']))
    {
      $user = Classes\User::first(array('username')=>$_POST['username']);
      if ($user != null)
      {
        if ($user->comparePassword($_POST['password']))
        {
          $_SESSION['username'] = user->getUsername();
          // redirect internally
          $overviewPageHandler = new OverviewPageHandler();
          $overviewPagehandler->handle();
          return;
        }
      }
      
      // only reached in case of unsuccessful login
      showLoginValidationError();
    }
    
    // TODO: show login page
  }
  
  
  public showLoginValidationError()
  {
    // TODO: add error message to login form
  }
}

?>

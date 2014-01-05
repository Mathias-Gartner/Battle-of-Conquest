<?php

namespace PageHandlers;

abstract class PageHandler
{
	private static $_baseDir;
	
	private $_returnCode = 200;
	private $_headers = array();
	private $_cookies = array();
	private $_pageData = array();
	private $_template = '';
	private $_message = '';
	
	public static function setBaseDir($baseDir)
	{
	  self::$_baseDir = $baseDir;
	}
	
	// does all the work
	// returns actual PageHandler (in case it changed for a redirection)
  abstract public function handle();
  
  public function render()
  {
    $pageData = array();
    $keys = array_keys($this->_pageData);
    foreach ($keys as $key)
    {
      $value = $this->_pageData[$key];
      if (is_string($value))
        $value = htmlspecialchars($value);
        
      $pageData[$key] = $value;
    }
  
    // disable client side/proxy caching
    header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
    header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
    header('Pragma: no-cache');
    
    $this->sendHeaders();
    $this->sendCookies();
  
    if ($this->_template != '')
    {
      $PAGEDATA = $pageData;
      include self::$_baseDir.'templates/'.$this->_template;
    }
    else if ($this->_message != '')
      echo $this->_message;
  }
  
  public function loginRequired()
  {
    return true;
  }
  
  // $template must not be user input
  protected function setTemplate($template)
  {
  	$this->_template = $template;
  }
  
  // method for outputing simple error messages, when no template can be rendered
  protected function setMessage($message)
  {
    $this->_message = $message;
  }
  
  protected function setPhpTemplate($template)
  {
    $this->setTemplate($template.'.php');
  }
  
  protected function setAjaxTemplate($template)
  {
  	\Torm\Log::enable(false); // to make sure nothing destroys any JSON output
    $this->setTemplate($template.'.ajax');
  }
  
  protected function setPageData($key, $value)
  {
  	$this->_pageData[$key] = $value;
  }
  
  protected function setReturnCode($code)
  {
    if (is_numeric($code))
      $this->_returnCode = $code;
  }
  
  protected function setHeader($name, $value)
  {
    array_push($this->_headers, array('name'=>$name, 'value'=>$value));
  }
  
  protected function setCookie($name, $value, $expire = 0)
  {
    array_push($this->_cookies, array('name'=>$name, 'value'=>$value, 'expire'=>$expire));
  }
  
  private function sendHeaders()
  {
    $return = 'HTTP/1.1 '.$this->_returnCode;
    $text = 'OK';
    switch($this->_returnCode)
    {
      case 400:
        $text = 'Bad Request';
        break;
      case 401:
        $text = 'Authentication Required';
        break;
      case 403:
        $text = 'Forbidden';
        break;
      case 404:
        $text = 'Not Found';
        break;
    }
    header($return.' '.$text);
  
    foreach ($this->_headers as $header)
    {
      header($header['name'].': '.$header['value']);
    }
  }
  
  private function sendCookies()
  {
    foreach ($this->_cookies as $cookie)
    {
      setcookie($cookie['name'], $cookie['value'], $cookie['expire']);
    }
  }
}

?>

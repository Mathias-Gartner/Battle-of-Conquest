<?php

namespace PageHandlers;

abstract class PageHandler
{
	private static $_baseDir;
	
	private $_headers = array();
	private $_cookies = array();
	private $_pageData = array();
	private $_template;
	
	public static function setBaseDir($baseDir)
	{
	  self::$_baseDir = $baseDir;
	}
	
	// returns actual PageHandler (useful for redirections)
  abstract public function handle();
  
  public function render()
  {
    $this->sendHeaders();
    $this->sendCookies();
  
    $PAGEDATA = $this->_pageData;
    include self::$_baseDir.'templates/'.$this->_template;
  }
  
  public function loginRequired()
  {
    return true;
  }
  
  // template must not be user input
  protected function setTemplate($template)
  {
  	$this->_template = $template;
  }
  
  protected function setPhpTemplate($template)
  {
    $this->setTemplate($template.'.php');
  }
  
  protected function setAjaxTemplate($template)
  {
    $this->setTemlpate($template.'.ajax');
  }
  
  protected function setPageData($key, $value)
  {
  	$this->_pageData[$key] = $value;
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

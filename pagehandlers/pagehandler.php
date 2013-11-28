<?php

namespace PageHandlers;

abstract class PageHandler
{
	private static $_baseDir;
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
    $PAGEDATA = $this->_pageData;
    include self::$_baseDir.'templates/'.$this->_template;
  }
  
  // template must not be user input
  protected function setTemplate($template)
  {
  	$this->_template = $template.'.php';
  }
  
  protected function setPageData($key, $value)
  {
  	$this->_pageData[$key] = $value;
  }
}

?>

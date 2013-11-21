<?php

namespace Classes;

class User extends \TORM\Model
{
  public function getUsername()
  {
    return $this->get("username");
  }

  public function setUsername($username)
  {
  	if ($this->is_new())
	    $this->set("username", $username);
    else
    	TORM\Log::log("setUsername failed. Operation now allowed.");
  }
  
  public function getAge()
  {
    return $this->get("age");
  }
  
  public function setAge($age)
  {
    $this->set("age", $age);
  }
  
  public function setMail($mail)
  {
    $this->set("mail", $mail);
  }
  
  public function comparePassword($password)
  {
    if (sha1($password.$this->get("salt"), true) == $this->get("password"))
      return true;
    return false;
  }
  
  public function setPassword($password)
  {
    $salt = "".rand(10000, 99999);
    $this->set("password", sha1($password.$salt, true));
    $this->setSalt($salt);
  }
  
  private function setSalt($salt)
  {
    $this->set("salt", $salt);
  }
  
}

User::setPK("user_id");
User::hasMany("districts", array("class_name"=>"District", "foreign_key"=>"owner_id"));
User::validates("username", array("presence"=>true));
User::validates("username", array("uniqueness"=>true));
User::validates("mail", array("format"=>"^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$"));
User::validates("password", array("presence"=>true));

?>

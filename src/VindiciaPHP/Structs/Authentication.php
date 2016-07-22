<?php
/**
 * @author Sam Waters <sam@samwaters.com>
 * @created 21/07/2016 18:39
 */
namespace VindiciaPHP\Structs;

class Authentication
{
  public $version;
  public $login;
  public $password;
  public $evid;
  public $userAgent;

  public function __construct($username, $password)
  {
    $this->version = "1.1";
    $this->login = $username;
    $this->password = $password;
    $this->userAgent = "VindiciaPHP";
  }
}

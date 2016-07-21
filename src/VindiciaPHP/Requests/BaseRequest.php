<?php
/**
 * @author Sam Waters <sam@samwaters.com>
 * @created 21/07/2016 18:36
 */
namespace VindiciaPHP\Requests;

use VindiciaPHP\Exceptions\RequestException;
use VindiciaPHP\Structs\Authentication;

abstract class BaseRequest
{
  public $auth;

  abstract function requiresAuth();

  public function setAuthentication(Authentication $authentication)
  {
    $this->auth = $authentication;
  }

  public final function validate()
  {
    if($this->requiresAuth() && !isset($this->auth))
    {
      throw new RequestException("Call requires authentication, but none is set");
    }
  }
}

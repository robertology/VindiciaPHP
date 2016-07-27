<?php
/**
 * @author Sam Waters <sam@samwaters.com>
 * @created 27/07/2016 12:09
 */
namespace VindiciaPHP\Structs;

class NameValuePair
{
  public $name;
  public $value;

  public function __construct($name, $value)
  {
    $this->name = $name;
    $this->value = $value;
  }
}

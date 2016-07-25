<?php
/**
 * @author Sam Waters <sam@samwaters.com>
 * @created 25/07/2016 14:57
 */
namespace VindiciaPHP\Structs;

class InvalidTransaction
{
  private $_code;
  private $_description;
  private $_merchantTransactionId;

  public function __construct($code, $description, $merchantTransactionId)
  {
    $this->_code = $code;
    $this->_description = $description;
    $this->_merchantTransactionId = $merchantTransactionId;
  }

  public function getCode()
  {
    return $this->_code;
  }

  public function getDescription()
  {
    return $this->_description;
  }

  public function getMerchantTransactionId()
  {
    return $this->_merchantTransactionId;
  }
}

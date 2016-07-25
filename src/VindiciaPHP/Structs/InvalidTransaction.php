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

  /**
   * Invalid transactions returned by a bill request
   * @param $code
   * @param $description
   * @param $merchantTransactionId
   */
  public function __construct($code, $description, $merchantTransactionId)
  {
    $this->_code = $code;
    $this->_description = $description;
    $this->_merchantTransactionId = $merchantTransactionId;
  }

  /**
   * @return string
   */
  public function getCode()
  {
    return $this->_code;
  }

  /**
   * @return string
   */
  public function getDescription()
  {
    return $this->_description;
  }

  /**
   * @return string
   */
  public function getMerchantTransactionId()
  {
    return $this->_merchantTransactionId;
  }
}

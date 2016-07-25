<?php
/**
 * @author Sam Waters <sam@samwaters.com>
 * @created 25/07/2016 14:11
 */
namespace VindiciaPHP\Responses;

abstract class BaseResponse
{
  private $_returnCode;
  private $_returnString;
  private $_soapId;

  /**
   * Base for all responses
   * @param $returnCode
   * @param $returnString
   * @param $soapId
   */
  public function __construct($returnCode, $returnString, $soapId)
  {
    $this->_returnCode = $returnCode;
    $this->_returnString = $returnString;
    $this->_soapId = $soapId;
  }

  /**
   * @return string
   */
  public function getReturnCode()
  {
    return $this->_returnCode;
  }

  /**
   * @return string
   */
  public function getReturnString()
  {
    return $this->_returnString;
  }

  /**
   * @return string
   */
  public function getSoapId()
  {
    return $this->_soapId;
  }
}

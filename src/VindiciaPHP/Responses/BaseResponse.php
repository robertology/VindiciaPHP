<?php
/**
 * @author Sam Waters <sam@samwaters.com>
 * @created 25/07/2016 14:11
 */
namespace VindiciaPHP\Responses;

use VindiciaPHP\Exceptions\CallException;

abstract class BaseResponse
{
  private $_returnCode;
  private $_returnString;
  private $_soapId;

  /**
   * Base for all responses
   * @param $returnObj
   */
  public function __construct($returnObj)
  {
    $this->_returnCode = $returnObj->returnCode;
    $this->_returnString = $returnObj->returnString;
    $this->_soapId = $returnObj->soapId;
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

  /**
   * Make sure the response is valid and has all the required fields
   * @param $raw
   * @throws CallException
   */
  public static function validate($raw)
  {
    if(!is_object($raw) || !isset($raw->return))
    {
      throw new CallException("Invalid response from api");
    }
    if(!isset($raw->return->returnCode) || !isset($raw->return->returnString) || !isset($raw->return->soapId))
    {
      throw new CallException("Missing required fields in api response");
    }
  }
}

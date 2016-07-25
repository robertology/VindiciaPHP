<?php
/**
 * @author Sam Waters <sam@samwaters.com>
 * @created 25/07/2016 18:38
 */
namespace VindiciaPHP\Structs;

class Chargeback
{
  public $amount;
  public $caseNumber;
  public $currency;
  public $merchantNumber;
  public $merchantTransactionId;
  public $merchantTransactionTimestamp;
  public $merchantUserId;
  public $nameValues;
  public $note;
  public $postedTimestamp;
  public $presentmentAmount;
  public $presentmentCurrency;
  public $processorReceivedTimestamp;
  public $reasonCode;
  public $referenceNumber;
  public $status;
  public $statusChangedTimestamp;
  public $VID;

  /**
   * Hydrate this instance from a response object
   * @param \stdClass $object
   */
  public function hydrate(\stdClass $object)
  {
    $data = get_object_vars($object);
    foreach($data as $key => $value)
    {
      $this->$key = $value;
    }
  }
}

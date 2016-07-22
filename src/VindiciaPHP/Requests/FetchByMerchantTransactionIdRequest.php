<?php
/**
 * @author Sam Waters <sam@samwaters.com>
 * @created 22/07/2016 18:25
 */
namespace VindiciaPHP\Requests;

class FetchByMerchantTransactionIdRequest extends BaseRequest
{
  public $merchantTransactionId;

  public function requiresAuth()
  {
    return true;
  }

  public function __construct($merchantTransactionId)
  {
    $this->merchantTransactionId = $merchantTransactionId;
  }
}

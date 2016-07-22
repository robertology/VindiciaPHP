<?php
/**
 * @author Sam Waters <sam@samwaters.com>
 * @created 22/07/2016 19:05
 */
namespace VindiciaPHP\Requests;

class RefundTransactionsRequest extends BaseRequest
{
  public $refunds = [];

  public function requiresAuth()
  {
    return true;
  }

  public function __construct()
  {

  }

  public function addTransaction($transactionId)
  {
    $this->refunds[] = $transactionId;
  }

  public function addTransactions($transactionIds)
  {
    if(is_array($transactionIds))
    {
      $this->refunds = array_merge($this->refunds, $transactionIds);
    }
  }

  public function clearTransactions()
  {
    $this->refunds = [];
  }

  public function setTransactionIds($transactionIds)
  {
    if(is_array($transactionIds))
    {
      $this->refunds = $transactionIds;
    }
  }
}

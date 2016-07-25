<?php
/**
 * @author Sam Waters <sam@samwaters.com>
 * @created 25/07/2016 14:29
 */
namespace VindiciaPHP\Responses;

use VindiciaPHP\Structs\InvalidTransaction;

class BillTransactionsResponse extends BaseResponse
{
  private $_failedTransactions = [];

  /**
   * Add failed transactions to the response
   * This can be an array or an object
   * @param $failedTransactions
   */
  public function addFailedTransactions($failedTransactions)
  {
    //Why can api designers never make this consistent?
    if(is_object($failedTransactions))
    {
      $failedTransactions = [$failedTransactions];
    }
    foreach($failedTransactions as $failedTransaction)
    {
      $this->_failedTransactions[] = new InvalidTransaction(
        isset($failedTransaction->code) ? $failedTransaction->code : "Unknown",
        isset($failedTransaction->description) ? $failedTransaction->description : "Unknown",
        isset($failedTransaction->merchantTransactionId) ? $failedTransaction->merchantTransactionId : "Unknown"
      );
    }
  }

  /**
   * @return InvalidTransaction[]
   */
  public function getFailedTransasctions()
  {
    return $this->_failedTransactions;
  }
}

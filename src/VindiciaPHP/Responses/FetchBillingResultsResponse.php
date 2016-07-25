<?php
/**
 * @author Sam Waters <sam@samwaters.com>
 * @created 25/07/2016 16:19
 */
namespace VindiciaPHP\Responses;

use VindiciaPHP\Structs\Transaction;

class FetchBillingResultsResponse extends BaseResponse
{
  private $_transactions = [];

  public function addTransactions($transactions)
  {
    if(!is_array($transactions))
    {
      $transactions = [$transactions];
    }
    foreach($transactions as $rawTransaction)
    {
      $transaction = new Transaction();
      $transaction->hydrate($rawTransaction);
      $this->_transactions[] = $transaction;
    }
  }

  /**
   * @return Transaction[]
   */
  public function getTransactions()
  {
    return $this->_transactions;
  }
}

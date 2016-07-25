<?php
/**
 * @author Sam Waters <sam@samwaters.com>
 * @created 25/07/2016 17:40
 */
namespace VindiciaPHP\Responses;

use VindiciaPHP\Structs\Transaction;

class FetchByMerchantTransactionIdResponse extends BaseResponse
{
  private $_transaction = null;

  public function setTransaction($rawTransaction)
  {
    $transaction = new Transaction();
    $transaction->hydrate($rawTransaction);
    $this->_transaction = $transaction;
  }

  /**
   * @return Transaction|null
   */
  public function getTransaction()
  {
    return $this->_transaction;
  }
}

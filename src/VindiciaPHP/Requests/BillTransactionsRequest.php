<?php
/**
 * @author Sam Waters <sam@samwaters.com>
 * @created 21/07/2016 18:37
 */
namespace VindiciaPHP\Requests;

use VindiciaPHP\Structs\Transaction;

class BillTransactionsRequest extends BaseRequest
{
  public $transactions = [];

  public function addTransaction(Transaction $transaction)
  {
    $this->transactions[] = $transaction;
  }

  public function requiresAuth()
  {
    return true;
  }
}

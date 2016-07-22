<?php
/**
 * @author Sam Waters <sam@samwaters.com>
 * @created 22/07/2016 19:16
 */
namespace VindiciaPHP\Requests;

use VindiciaPHP\Structs\Transaction;

class ReportTransactionsRequest extends BaseRequest
{
  public $transactions = [];

  public function requiresAuth()
  {
    return true;
  }

  public function addTransaction(Transaction $transaction)
  {
    $this->transactions[] = $transaction;
  }
}

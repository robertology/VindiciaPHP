<?php
/**
 * @author Sam Waters <sam@samwaters.com>
 * @created 25/07/2016 18:41
 */
namespace VindiciaPHP\Responses;

use VindiciaPHP\Structs\Chargeback;

class FetchChargebacksResponse extends BaseResponse
{
  private $_chargebacks = [];

  public function addChargebacks($chargebacks)
  {
    if(!is_array($chargebacks))
    {
      $chargebacks = [$chargebacks];
    }
    foreach($chargebacks as $rawChargeback)
    {
      $chargeback = new Chargeback();
      $chargeback->hydrate($rawChargeback);
      $this->_chargebacks[] = $rawChargeback;
    }
  }

  /**
   * @return Chargeback[]
   */
  public function getChargebacks()
  {
    return $this->_chargebacks;
  }
}

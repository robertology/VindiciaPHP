<?php
/**
 * @author Sam Waters <sam@samwaters.com>
 * @created 21/07/2016 17:34
 */
namespace VindiciaPHP;

use VindiciaPHP\Requests\BillTransactionsRequest;
use VindiciaPHP\Structs\Authentication;

class VindiciaClient
{
  /** @var Authentication $_authentication */
  private $_authentication;
  /** @var \SoapClient $_client */
  private $_client;

  public function __construct($username, $password)
  {
    $this->_authentication = new Authentication($username, $password, $mode = "live");
    $wsdl = $mode == "live" ? "https://soap.vindicia.com/1.1/Select.wsdl" : "https://soap.prodtest.sj.vindicia.com/1.1/Select.wsdl";
    $this->_client = new \SoapClient($wsdl);
  }

  public function billTransactionsRequest(BillTransactionsRequest $request)
  {
    $request->setAuthentication($this->_authentication);
    $request->validate();
    $response = $this->_client->billTransactions($request);
    var_dump($response);
  }

  public function listMethods()
  {
    var_dump($this->_client->__getFunctions());
  }
}

<?php
/**
 * @author Sam Waters <sam@samwaters.com>
 * @created 21/07/2016 17:34
 */
namespace VindiciaPHP;

use VindiciaPHP\Exceptions\RequestException;
use VindiciaPHP\Requests\BaseRequest;
use VindiciaPHP\Requests\BillTransactionsRequest;
use VindiciaPHP\Requests\FetchBillingResultsRequest;
use VindiciaPHP\Structs\Authentication;

class VindiciaClient
{
  /** @var Authentication $_authentication */
  private $_authentication;
  /** @var \SoapClient $_client */
  private $_client;

  public function __construct($username, $password, $mode = "live")
  {
    $this->_authentication = new Authentication($username, $password);
    $wsdl = $mode == "live" ? "https://soap.vindicia.com/1.1/Select.wsdl" : dirname(__FILE__) . "/Resources/ProdTest.wsdl";
    $this->_client = new \SoapClient($wsdl, array(
      "cache_wsdl" => WSDL_CACHE_BOTH,
      "compression" => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP | SOAP_COMPRESSION_DEFLATE,
      "encoding" => "utf-8",
      "exceptions" => true,
      "connection_timeout" => 30,
      "trace" => 1
    ));
  }

  private function _runRequest($request, BaseRequest $params)
  {
    $knownCalls = ["reportTransactions", "billTransactions", "refundTransactions", "fetchBillingResults", "fetchChargebacks", "fetchByMerchantTransactionId"];
    if(!in_array($request, $knownCalls))
    {
      throw new RequestException("Unknown soap call $request");
    }
    $params->validate();
    return $this->_client->$request($params);
  }

  public function billTransactionsRequest(BillTransactionsRequest $request)
  {
    $request->setAuthentication($this->_authentication);
    return $this->_runRequest("billTransactions", $request);
  }

  public function fetchBillingResultsRequest(FetchBillingResultsRequest $request)
  {
    $request->setAuthentication($this->_authentication);
    return $this->_runRequest("fetchBillingResults", $request);
  }

  public function listMethods()
  {
    var_dump($this->_client->__getFunctions());
  }

  public function getLastRequest()
  {
    return $this->_client->__getLastRequest();
  }

  public function getLastResponse()
  {
    return $this->_client->__getLastResponse();
  }
}

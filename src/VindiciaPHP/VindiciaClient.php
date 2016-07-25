<?php
/**
 * @author Sam Waters <sam@samwaters.com>
 * @created 21/07/2016 17:34
 */
namespace VindiciaPHP;

use VindiciaPHP\Enums\ConnectionMode;
use VindiciaPHP\Exceptions\RequestException;
use VindiciaPHP\Requests\BaseRequest;
use VindiciaPHP\Requests\BillTransactionsRequest;
use VindiciaPHP\Requests\FetchBillingResultsRequest;
use VindiciaPHP\Requests\FetchByMerchantTransactionIdRequest;
use VindiciaPHP\Requests\FetchChargebacksRequest;
use VindiciaPHP\Requests\RefundTransactionsRequest;
use VindiciaPHP\Requests\ReportTransactionsRequest;
use VindiciaPHP\Responses\BaseResponse;
use VindiciaPHP\Responses\BillTransactionsResponse;
use VindiciaPHP\Responses\FetchBillingResultsResponse;
use VindiciaPHP\Responses\FetchByMerchantTransactionIdResponse;
use VindiciaPHP\Responses\ReportTransactionsResponse;
use VindiciaPHP\Structs\Authentication;

class VindiciaClient
{
  /** @var Authentication $_authentication */
  private $_authentication;
  /** @var \SoapClient $_client */
  private $_client;

  public function __construct($username, $password, $mode = ConnectionMode::LIVE, $options = [])
  {
    $this->_authentication = new Authentication($username, $password);
    $wsdl = $mode == ConnectionMode::LIVE ? "https://soap.vindicia.com/1.1/Select.wsdl" : dirname(__FILE__) . "/Resources/ProdTest.wsdl";
    $options = array_merge([
      "cache_wsdl" => WSDL_CACHE_BOTH,
      "compression" => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP | SOAP_COMPRESSION_DEFLATE,
      "encoding" => "utf-8",
      "exceptions" => true,
      "connection_timeout" => 30,
      "trace" => 1
    ], $options);
    $this->_client = new \SoapClient($wsdl, $options);
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

  /**
   * Make a Bill Transaction Request to Vindicia
   * @param BillTransactionsRequest $request
   * @return BillTransactionsResponse
   */
  public function billTransactionsRequest(BillTransactionsRequest $request)
  {
    $request->setAuthentication($this->_authentication);
    $rawResponse = $this->_runRequest("billTransactions", $request);
    BaseResponse::validate($rawResponse);
    $response = new BillTransactionsResponse($rawResponse->return);
    if(isset($rawResponse->response))
    {
      $response->addFailedTransactions($rawResponse->response);
    }
    return $response;
  }

  /**
   * Fetch processed billing requests
   * @param FetchBillingResultsRequest $request
   * @return FetchBillingResultsResponse
   */
  public function fetchBillingResultsRequest(FetchBillingResultsRequest $request)
  {
    $request->setAuthentication($this->_authentication);
    $rawResponse = $this->_runRequest("fetchBillingResults", $request);
    BaseResponse::validate($rawResponse);
    $response = new FetchBillingResultsResponse($rawResponse->return);
    if(isset($rawResponse->transactions))
    {
      $response->addTransactions($rawResponse->transactions);
    }
    return $response;
  }

  public function fetchChargebacksRequest(FetchChargebacksRequest $request)
  {
    $request->setAuthentication($this->_authentication);
    return $this->_runRequest("fetchChargebacks", $request);
  }

  /**
   * Fetch a transaction by its merchant Id
   * @param FetchByMerchantTransactionIdRequest $request
   * @return FetchByMerchantTransactionIdResponse
   */
  public function fetchByMerchantTransactionIdRequest(FetchByMerchantTransactionIdRequest $request)
  {
    $request->setAuthentication($this->_authentication);
    $rawResponse = $this->_runRequest("fetchByMerchantTransactionId", $request);
    BaseResponse::validate($rawResponse);
    $response = new FetchByMerchantTransactionIdResponse($rawResponse->return);
    if(isset($rawResponse->transaction))
    {
      $response->setTransaction($rawResponse->transaction);
    }
    return $response;
  }

  /**
   * Submit transactions for refunding
   * @param RefundTransactionsRequest $request
   * @return ReportTransactionsResponse
   */
  public function refundTransactionsRequest(RefundTransactionsRequest $request)
  {
    $request->setAuthentication($this->_authentication);
    $rawResponse = $this->_runRequest("refundTransactions", $request);
    BaseResponse::validate($rawResponse);
    $response = new ReportTransactionsResponse($rawResponse->return);
    if(isset($rawResponse->response))
    {
      $response->addFailedTransactions($rawResponse->response);
    }
    return $response;
  }

  /**
   * Submit transactions for fighting chargebacks
   * @param ReportTransactionsRequest $request
   * @return ReportTransactionsResponse
   */
  public function reportTransactionsRequest(ReportTransactionsRequest $request)
  {
    $request->setAuthentication($this->_authentication);
    $rawResponse = $this->_runRequest("reportTransactions", $request);
    BaseResponse::validate($rawResponse);
    $response = new ReportTransactionsResponse($rawResponse->return);
    if(isset($rawResponse->response))
    {
      $response->addFailedTransactions($rawResponse->response);
    }
    return $response;
  }

  /**
   * Debug Functions
   */
  public function listMethods()
  {
    return $this->_client->__getFunctions();
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

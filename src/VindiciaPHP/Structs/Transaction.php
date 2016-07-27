<?php
/**
 * @author Sam Waters <sam@samwaters.com>
 * @created 21/07/2016 19:03
 */
namespace VindiciaPHP\Structs;

use VindiciaPHP\Enums\PaymentStatusEnum;

class Transaction
{
  public $accountHolderName;
  public $affiliateId;
  public $affiliateSubId;
  public $amount;
  public $authCode;
  public $avsCode;
  public $billingAddressLine1;
  public $billingAddressLine2;
  public $billingAddressLine3;
  public $billingAddressCity;
  public $billingAddressCounty;
  public $billingAddressDistrict;
  public $billingAddressPostalCode;
  public $billingAddressCountry;
  public $billingFrequency;
  public $billingStatementIdentifier;
  public $creditCardAccount;
  public $creditCardAccountHash;
  public $creditCardAccountUpdated;
  public $creditCardExpirationDate;
  public $currency;
  public $customerId;
  public $cvnCode;
  public $divisionNumber;
  public $merchantTransactionId;
  public $nameValues = [];
  public $paymentMethodId;
  public $paymentMethodIsTokenized;
  public $previousBillingCount;
  public $previousBillingDate;
  public $selectRefundId;
  public $selectTransactionId;
  public $status;
  public $subscriptionId;
  public $subscriptionStartDate;
  public $timestamp;
  public $VID;

  public function addNameValuePair(NameValuePair $nvp)
  {
    $this->nameValues[] = $nvp;
  }

  /**
   * Hydrate this instance from a response object
   * @param \stdClass $object
   */
  public function hydrate(\stdClass $object)
  {
    $data = get_object_vars($object);
    foreach($data as $key => $value)
    {
      $this->$key = $value;
    }
    //Fix the name values to a more readable format
    if(is_array($this->nameValues))
    {
      $nvps = $this->nameValues;
      $this->nameValues = [];
      foreach($nvps as $nvp)
      {
        if(isset($nvp->name) && isset($nvp->value))
        {
          $this->nameValues[$nvp->name] = $nvp->value;
        }
      }
    }
  }

  /**
   * @param String $affiliateId
   * @param String $affiliateSubId
   */
  public function setAffiliate($affiliateId, $affiliateSubId)
  {
    $this->affiliateId = $affiliateId;
    $this->affiliateSubId = $affiliateSubId;
  }

  /**
   * @param String $line1
   * @param String $city
   * @param String $state
   * @param String $postcode
   * @param String $country
   */
  public function setBillingAddress($line1, $city, $state, $postcode, $country)
  {
    $this->billingAddressLine1 = $line1;
    $this->billingAddressCity = $city;
    $this->billingAddressDistrict = $state;
    $this->billingAddressPostalCode = $postcode;
    $this->billingAddressCountry = $country;
  }

  /**
   * @param String $number Credit card number or hash
   * @param String $expiry Credit card expiry (YYYYMM)
   * @param bool $tokenized Whether the card number is tokenized
   */
  public function setCreditCard($number, $expiry, $tokenized = false)
  {
    if($tokenized)
    {
      $this->creditCardAccountHash = $number;
      $this->paymentMethodIsTokenized = true;
    }
    else
    {
      $this->creditCardAccount = $number;
      $this->paymentMethodIsTokenized = false;
    }
    $this->creditCardExpirationDate = $expiry;
  }

  /**
   * @param String $authCode Response message from gateway
   * @param String $avs AVS response code
   * @param String $cvv CVV response code
   */
  public function setCreditCardAuthCodes($authCode, $avs, $cvv)
  {
    $this->authCode = $authCode;
    $this->avsCode = $avs;
    $this->cvnCode = $cvv;
  }

  /**
   * @param $customerId
   * @param $customerName
   */
  public function setCustomerInfo($customerId, $customerName)
  {
    $this->customerId = $customerId;
    $this->accountHolderName = $customerName;
  }

  /**
   * @param String $divisionNumber Division group within payment processor (also known as report group)
   * @param String $merchantTransactionId Unique transaction id (Invoice Id)
   * @param String $subscriptionId Unique subscription transaction id (Pack id)
   */
  public function setMerchantInfo($divisionNumber, $merchantTransactionId, $subscriptionId)
  {
    $this->divisionNumber = $divisionNumber;
    $this->merchantTransactionId = $merchantTransactionId;
    $this->subscriptionId = $subscriptionId;
  }

  /**
   * @param NameValuePair[] $nvp
   */
  public function setNameValuePairs(array $nvp)
  {
    $this->nameValues = $nvp;
  }

  /**
   * @param $amount
   * @param $currency
   * @param string $status
   * @param int|null $timestamp
   */
  public function setTransactionInfo($amount, $currency, $status = PaymentStatusEnum::FAILED, $timestamp = null)
  {
    $this->amount = $amount;
    $this->currency = $currency;
    $this->status = $status;
    $this->timestamp = $timestamp ? $timestamp : time();
  }
}

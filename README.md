# VindiciaPHP
Vindicia PHP Client for Select APIs  

## Table of Contents
- [Usage](#usage)
    - [With composer](#composer)
    - [Without composer](#nocomposer)
    - [Creating a client](#client)
- [Supported Calls](#calls)
    - [Bill Transactions](#billTransactions)
    - [Fetch Billing Results](#fetchBillingResults)
    - [Fetch By Merchant Transaction Id](#fetchByMerchantTransactionId)
    - [Fetch Chargebacks](#fetchChargebacks)
    - [Refund Transactions](#refundTransactions)
    - [Report Transactions](#reportTransactions)
- [Vindicia Documentation](#docs)
<a name="usage"></a>
## Usage
<a name="composer"></a>
### With composer:
`"samwaters/vindiciaphp": "dev-master"`
<a name="nocomposer"></a>
### Without composer:
`include_once("vendor/autoload.php");`
<a name="client"></a>
### Creating a client
Your username and password come from Vindicia  
Mode is either `live` or `test`  
`$client = new VindiciaClient($username, $password, $mode);`

<a name="calls"></a>
## Supported Calls
<a name="billTransactions"></a>
### Bill Transactions
Submit transactions for processing by Vindicia

<a name="fetchBillingResults"></a>
### Fetch Billing Results
Get a list of processed transactions

<a name="fetchByMerchantTransactionId"></a>
### Fetch By Merchant Transaction Id
Find a transaction by merchant id

<a name="fetchChargebacks"></a>
### Fetch Chargebacks
Get a list of chargebacks

<a name="refundTransactions"></a>
### Refund Transactions
Stop further processing of the specified transactions and refund them if they have been successfully charged

<a name="reportTransactions"></a>
### Report Transactions
Get a list of the results of the billing attempts for the specified transactions

<a name="docs"></a>
## Vindicia Documentation
- [Integration Guide](https://knowledge.vindicia.com/APIs/Implementation_Support/Deployment_Use_Cases/Reference/Integrating_with_Vindicia_Select)
- [Submitting failed transactions for recovery](https://knowledge.vindicia.com/APIs/Implementation_Support/Deployment_Use_Cases/Index/Submit_Failed_Transactions_for_recovery)
- [Select API Reference Guide](https://www.vindicia.com/documents/VindiciaSelect10/Default.htm)
- [Select API Documentation](http://developer.vindicia.com/docs/soap/Select.html?ver=1.1)

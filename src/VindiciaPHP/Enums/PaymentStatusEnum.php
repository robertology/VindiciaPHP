<?php
/**
 * @author Sam Waters <sam@samwaters.com>
 * @created 21/07/2016 19:28
 */
namespace VindiciaPHP\Enums;

class PaymentStatusEnum
{
  const BILLING_NOT_ATTEMPTED = "BillingNotAttempted";
  const CANCELLED = "Cancelled";
  const CAPTURED = "Captured";
  const FAILED = "Failed";
  const REFUNDED = "Refunded";
}

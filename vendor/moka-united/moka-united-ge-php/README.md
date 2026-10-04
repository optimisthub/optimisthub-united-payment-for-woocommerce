# United Payment Georgia API PHP Client

The United Payment Georgia API PHP Client provides convenient access to the [United Payment Georgia](https://unitedpayment.ge/) API from applications written in the PHP language.

## Requirements

- PHP 7.4 or higher

## Installation

You can install the bindings via [Composer](http://getcomposer.org/). Run the following command:

```bash
composer require moka-united/moka-united-ge-php
```

To use the bindings, use Composer's [autoload](https://getcomposer.org/doc/01-basic-usage.md#autoloading):

```php
require_once('vendor/autoload.php');
```

## Manual Installation

If you do not wish to use Composer, you can download the [latest release](https://github.com/optimisthub/united-payment-ge-php/releases). Then, to use the bindings, include the `autoload.php` file.

```php
require_once('autoload.php');
```

## Dependencies

The bindings require the following PHP extensions in order to work properly:

- [`curl`](https://secure.php.net/manual/en/book.curl.php)
- [`json`](https://secure.php.net/manual/en/book.json.php)

If you use Composer, these dependencies should be handled automatically. If you install manually, you'll want to make sure that these extensions are available.

## Getting Started

```php
use MokaUnitedGE\MokaUnitedClient;

$client = new MokaUnitedClient([
    'dealerCode' => '',
    'username' => '',
    'password' => '',
]);
```

## Response Handling

All service calls return a **Response** object. Common methods:

```php
$response->getStatusCode();
$response->getResultCode();
$response->getResultMessage();
$response->getData();
$response->getBody();
$response->getHeaders();
$response->getException();
$response->isSuccessful();
```

If `isSuccessful()` returns `true`, access the payload via `getData()`.

---

## Payment Service

### Create Payment

```php
$client->payments()->create([
    "Amount" => 0.01,
    "Currency" => "GEL",
    "BankCode" => 1,
    "CardToken" => "63F8C2BF-F76D-46C1-BB0E-C699692CB678",
    "InstallmentNumber" => 1,
    "ClientIP" => "203.0.113.21",
    "OtherTrxCode" => "ORDER-20250101-0001",
    "SubMerchantName" => "",
    "IsPoolPayment" => 0,
    "IsPreAuth" => 0,
    "IsTokenized" => 0,
    "IntegratorId" => 0,
    "Software" => "Postman",
    "Description" => "",
    "ReturnHash" => 1,
    "RedirectUrl" => "https://www.unitedpayment.ge/callback?trx=ORDER-20250101-0001",
    "RedirectType" => 0,
    "BuyerInformation" => [
        "BuyerFullName" => "Test User",
        "BuyerGsmNumber" => "5341234567",
        "BuyerEmail" => "email@email.com",
        "BuyerAddress" => "Levent Mah. Meltem Sok...",
    ],
    "CustomerInformation" => [
        "DealerCustomerId" => "",
        "CustomerCode" => "1234",
        "FirstName" => "Test",
        "LastName" => "User",
        "Email" => "test@unitedpayment.ge",
        "CardName" => "My Card"
    ]
]);
```

### Get Payments

```php
$client->payments()->all([
    "PaymentStartDate" => "2025-10-01 00:00",
    "PaymentEndDate" => "2025-11-01 00:00"
]);
```

---

## Refund Service

### Create Refund

```php
$client->refunds()->create([
    "VirtualPosOrderId" => "ORDER-20250101-0001",
    "OtherTrxCode" => "REFUND-20250101-0001",
    "Amount" => 14.25
]);
```

---

## Card Service

### Get Cards

```php
$client->cards()->all([
    "DealerCustomerId" => "",
    "CustomerCode" => "1234"
]);
```

### Create Card

```php
$client->cards()->create([
    "DealerCustomerId" => "",
    "CustomerCode" => "1234",
    "CardHolderFullName" => "Test User",
    "CardNumber" => "4111111111111111",
    "ExpMonth" => "12",
    "ExpYear" => "2026",
    "CardName" => "My Card"
]);
```

### Retrieve Card

```php
$client->cards()->retrieve([
    "CardToken" => "63F8C2BF-F76D-46C1-BB0E-C699692CB678"
]);
```

### Update Card

```php
$client->cards()->update([
    "CardToken" => "63F8C2BF-F76D-46C1-BB0E-C699692CB678",
    "CardName" => "Updated Card Name"
]);
```

### Delete Card

```php
$client->cards()->delete([
    "CardToken" => "63F8C2BF-F76D-46C1-BB0E-C699692CB678"
]);
```

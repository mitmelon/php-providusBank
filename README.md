/# php-providusBank
[![FOSSA Status](https://app.fossa.com/api/projects/git%2Bgithub.com%2Fmitmelon%2Fphp-providusBank.svg?type=shield)](https://app.fossa.com/projects/git%2Bgithub.com%2Fmitmelon%2Fphp-providusBank?ref=badge_shield) [![Total Downloads](http://poser.pugx.org/mitmelon/php-providusBank/downloads)](https://packagist.org/packages/mitmelon/php-providusBank) [![License](http://poser.pugx.org/mitmelon/php-providusBank/license)](https://packagist.org/packages/mitmelon/php-providusBank) [![PHP Version Require](http://poser.pugx.org/mitmelon/php-providusBank/require/php)](https://packagist.org/packages/mitmelon/php-providusBank)

API for Providus Bank virtual account generation, account transfer and payment collections.

## Install:
Use composer to install
```php
composer require mitmelon/php-providusBank
```

## Payment Collection :

```php
require_once __DIR__."/vendor/autoload.php";

// Initialize library class for Payment Collections

$clientID = '';
$clientSecret = '';
$signature = hash('sha512', $clientID.':'.$clientSecret);
$endpoint = '';
$providus = new Providus();
$payment = $providus->payment($clientID, $clientSecret, $endpoint);

/**
 * Create Dynamic Virtual Bank Account Number for receiving payments.
 * @return Array
 */
print_r($payment->createDynamicAccount($account_name));
```

# Other Payment Collection Methods

```php

/**
 * Update account number
 * @return Array
 */
$payment->updateAccountName($account_name, $account_number);

/**
 * Update static virtual account number that can be used all time for payment collections
 * @return Array
 */
$payment->createStaticAccount($account_name);

/**
 * Blacklist account number
 * @return Array
 */
$payment->blacklistAccount($account_number);

/**
 * Verify Transaction using session ID
 * @return Array
 */
$payment->verifyTransactionBySession($sessionID);

/**
 * Verify Transaction using settlement ID
 * @return Array
 */
$payment->verifyTransactionBySettlement($settleID);
```

## Account Payment Transfer :

```php
require_once __DIR__."/vendor/autoload.php";

// Initialize library class for Payment Transfer

$username = '';
$password = '';
$endpoint = '';

$providus = new Providus();
$transfer = $providus->transfer($username, $password, $endpoint);

/**
 * It validates the supplied single BVN and returns the full demography details associated with the BVN
 * @return Array
 */
print_r($transfer->GetBVNDetails($bvn));
```

# Other Payment Transfer Methods

```php

/**
 * It validates the supplied account number and 3-digit bank code and returns the account details.
 * @return Array
 */
$transfer->GetNIPAccount($account_number, $bankCode);

/**
 * Transfer fund from a specified Providus account number to another account in a different bank.
 * @return Array
 */
$transfer->NIPFundTransfer($ref, $b_account_name, $b_account_no, $b_bankCode, $amount, $currency, $narration, $source_account_name)

/**
 * It validates the supplied single transaction reference and returns the current status of the transaction.
 * @return Array
 */
$transfer->GetNIPTransactionStatus($ref);

/**
 * It returns the list of institutions currently enrolled on NIP and their respective NIP bank codes.
 * @return Array
 */
$transfer->GetNIPBanks();

/**
 * Transfer fund from a specified Providus account number to another ProvidusBank account
 * @return Array
 */
$transfer->ProvidusFundTransfer($ref, $c_account_no, $d_account_no, $amount, $currency, $narration);

/**
 * It validates the supplied single transaction reference and returns the current status of the transaction
 * @return Array
 */
$transfer->GetProvidusTransactionStatus($ref);

/**
 * Get details tied to your account including the balance
 * @return Array
 */
$transfer->GetProvidusAccount($account_no);
```

# Future Update

* Webhook Processing

# Support

If you love my project and want me to help you in building your project please send me a mail at manomitehq@gmail.com.

# License

Released under the MIT license.
# FcPhp Session

Package to manipulate Session

[![Build Status](https://travis-ci.org/00F100/fcphp-session.svg?branch=master)](https://travis-ci.org/00F100/fcphp-session) [![codecov](https://codecov.io/gh/00F100/fcphp-session/branch/master/graph/badge.svg)](https://codecov.io/gh/00F100/fcphp-session) [![Total Downloads](https://poser.pugx.org/00F100/fcphp-session/downloads)](https://packagist.org/packages/00F100/fcphp-session)

## How to install

Composer:
```sh
$ composer require 00f100/fcphp-session
```

or add in composer.json
```json
{
	"require": {
		"00f100/fcphp-session": "*"
	}
}
```

## How to use

```php

use FcPhp\Session\Facades\SessionFacade;

/**
 * Method to return instance of Session 
 *
 * @param array $cookies Cookies default
 * @param string $nonce Nonce to use 00f100/fcphp-crypto
 * @param string $pathKeys Path to save crypto-keys
 * @return void
 */
SessionFacade::getInstance(array $cookies, string $nonce = null, string $pathKeys = null);


// Start session and load cache

$nonce = '...';
$pathKeys = 'var/crypto/keys';

// Use Cache into file
$sessionFile = SessionFacade::getInstance($_COOKIE, $nonce, $pathKeys);

// Create new configuration
$sessionRedis->set('item.config', 'value');

// Print: value
echo $sessionRedis->get('item.config');

/*
Return: 
Array (
	'item' => Array(
		'config' => 'value'
	)
)
*/
print_r($sessionRedis->get());

// Save into Cookie
$sessionRedis->commit();
```
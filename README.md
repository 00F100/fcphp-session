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


// Start session and load cache

// Use Cache into file
$sessionFile = SessionFacade::getInstance('path/to/dir/cache');

// Use Cache into Redis
$redis = [
	'host' => '127.0.0.1',
	'port' => '6379',
	'password' => null,
	'timeout' => 100,
];
$sessionRedis = SessionFacade::getInstance($redis);

// Create new configuration
$sessionRedis->set('item.config', 'value');

// Save into Cache
$sessionRedis->commit();

// Print: value
echo $sessionRedis->get('item.config');
```
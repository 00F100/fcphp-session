<?php

use PHPUnit\Framework\TestCase;
use FcPhp\Session\Session;
use FcPhp\Crypto\Crypto;
use FcPhp\Cookie\Cookie;
use FcPhp\Session\Interfaces\ISession;
use FcPhp\Cache\Facades\CacheFacade;
use FcPhp\Session\Facades\SessionFacade;
use FcPhp\Cookie\Facades\CookieFacade;

class SessionIntegrationTest extends TestCase
{
	private $instance;

	public function setUp()
	{
		$cookies = [
			'key-cookie-2' => base64_encode(serialize([
				'session' => [
					'config' => 'value'
				]
			]))
		];

		$cookie = new Cookie('key-cookie-2', $cookies);

		$this->instance = new Session($cookie);
	}

	public function testInstance()
	{
		$this->assertTrue($this->instance instanceof ISession);
	}

	public function testSetSession()
	{
		$this->instance->set('item.config', 'value');
		$this->instance->commit();
		$this->assertEquals($this->instance->get('item.config'), 'value');
	}

	public function testFacade()
	{
		$this->assertTrue(SessionFacade::getInstance([]) instanceof ISession);
	}

	public function testFacadeRedis()
	{
		$redis = [
			'host' => 'aasd',
			'port' => '6379',
			'password' => null,
			'timeout' => 100,
		];
		$sessionRedis = SessionFacade::getInstance($redis);
		$this->assertTrue($sessionRedis instanceof ISession);
	}
}
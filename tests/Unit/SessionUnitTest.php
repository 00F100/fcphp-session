<?php

use PHPUnit\Framework\TestCase;
use FcPhp\Session\Session;
use FcPhp\Session\Interfaces\ISession;

class SessionUnitTest extends TestCase
{
	private $instance;

	public function setUp()
	{
		// $cookies = [
		// 	'key-cookie-2' => base64_encode(serialize([
		// 		'session' => [
		// 			'config' => 'value'
		// 		]
		// 	]))
		// ];

		$cookie = $this->createMock('FcPhp\Cookie\Interfaces\ICookie');
		$cookie
			->expects($this->any())
			->method('get')
			->will($this->returnValue(['item' => ['config' => 'value']]));

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
}
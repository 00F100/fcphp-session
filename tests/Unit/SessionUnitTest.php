<?php

use PHPUnit\Framework\TestCase;
use FcPhp\Session\Session;
use FcPhp\Session\Interfaces\ISession;

class SessionUnitTest extends TestCase
{
	private $instance;

	public function setUp()
	{
		$cache = $this->createMock('FcPhp\Cache\Interfaces\ICache');
		$cache
			->expects($this->any())
			->method('has')
			->will($this->returnValue(true));
		$cache
			->expects($this->any())
			->method('get')
			->will($this->returnValue([]));

		$this->instance = new Session(md5('session'), $cache);
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
		$this->instance->refresh();
	}
}
<?php

use PHPUnit\Framework\TestCase;
use FcPhp\Session\Session;
use FcPhp\Session\Interfaces\ISession;
use FcPhp\Cache\Facades\CacheFacade;
use FcPhp\Session\Facades\SessionFacade;

class SessionIntegrationTest extends TestCase
{
	private $instance;

	public function setUp()
	{
		$cache = CacheFacade::getInstance('tests/var/cache');
		$cache->set('session::' . md5('session'), [], 84000);
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

	public function testFacade()
	{
		$this->assertTrue(SessionFacade::getInstance(md5('session'), 'tests/var/cache') instanceof ISession);
	}
}
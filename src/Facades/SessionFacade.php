<?php

namespace FcPhp\Session\Facades
{
	use FcPhp\Cache\Facades\CacheFacade;
	use FcPhp\Session\Interfaces\ISession;
	use FcPhp\Session\Session;

	class SessionFacade
	{
		private static $instance;

		public static function getInstance(string $key, string $pathCache, string $nonce = null, string $pathKey = null)
		{
			if(!self::$instance instanceof ISession) {
				$cache = CacheFacade::getInstance($pathCache, $nonce, $pathKey);
				self::$instance = new Session($key, $cache);
			}
			return self::$instance;
		}
	}
}
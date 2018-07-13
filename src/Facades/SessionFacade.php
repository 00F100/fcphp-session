<?php

namespace FcPhp\Session\Facades
{
	use FcPhp\Cookie\Facades\CookieFacade;
	use FcPhp\Session\Interfaces\ISession;
	use FcPhp\Session\Session;

	class SessionFacade
	{
		const COOKIE_ID = 'fcphp-session';

		/**
		 * @var FcPhp\Session\Interfaces\ISession Instance of Session
		 */
		private static $instance;

		/**
		 * Method to return instance of Session 
		 *
		 * @param array $cookies Cookies default
		 * @param string $nonce Nonce to crypto
		 * @param string $pathKeys Path to save crypto-keys
		 * @return void
		 */
		public static function getInstance(array $cookies, string $nonce = null, string $pathKeys = null)
		{
			if(!self::$instance instanceof ISession) {
				$cookie = CookieFacade::getInstance(self::COOKIE_ID, $cookies, $nonce, $pathKeys);
				self::$instance = new Session($cookie);
			}
			return self::$instance;
		}
	}
}
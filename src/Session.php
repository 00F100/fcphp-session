<?php

namespace FcPhp\Session
{
	use FcPhp\Cache\Interfaces\ICache;
	use FcPhp\Session\Interfaces\ISession;

	class Session implements ISession
	{
		/**
		 * @const TTL session
		 */
		const SESSION_TTL = 84000;

		/**
		 * @const string of session into cache
		 */
		const SESSION_ALIAS = 'session::';
		
		/**
		 * @var string Key to save cache
		 */
		private $key;
		
		/**
		 * @var FcPhp\Cache\Interfaces\ICache
		 */
		private $cache;
		
		/**
		 * @var array Informations of session
		 */
		private $session = [];
		
		/**
		 * Method to construct instance of Session
		 *
		 * @param FcPhp\Cache\Interfaces\ICache $cache Instance of Cache
		 * @return void
		 */
		public function __construct(string $key, ICache $cache)
		{
			$this->key = $key;
			$this->cache = $cache;
			if($this->cache->has(self::SESSION_ALIAS . $this->key)) {
				$this->session = $this->cache->get(self::SESSION_ALIAS . $this->key);
			}
		}
		
		/**
		 * Method to set new information into Session
		 *
		 * @param string $key Key to information
		 * @param mixed $value Value to save into Key Session
		 * @return void
		 */
		public function set(string $key, $value) :void
		{
			array_dot($this->session, $key, $value);
		}
		
		/**
		 * Method to publish into cache
		 *
		 * @return void
		 */
		public function commit() :void
		{
			$this->cache->set(self::SESSION_ALIAS . $this->key, $this->session, self::SESSION_TTL);
		}
		
		/**
		 * Method to refresh information from Cache
		 *
		 * @return void
		 */
		public function refresh() :void
		{
			if($this->cache->has(self::SESSION_ALIAS . $this->key)) {
				$this->session = $this->cache->get(self::SESSION_ALIAS . $this->key);
			}
		}
		
		/**
		 * Method to get information from Session
		 *
		 * @param string $key Key to information
		 * @return mixed
		 */
		public function get(string $key = null)
		{
			return array_dot($this->session, $key);
		}
	}
}
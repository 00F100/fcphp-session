<?php

namespace FcPhp\Session\Interfaces
{
    use FcPhp\Cookie\Interfaces\ICookie;
    
	interface ISession
	{
		/**
         * Method to construct instance of Session
         *
         * @param FcPhp\Cookie\Interfaces\ICookie $cookie Instance of Cookie
         * @return void
         */
        public function __construct(ICookie $cookie);
        
        /**
         * Method to set new information into Session
         *
         * @param string $key Key to information
         * @param mixed $value Value to save into Key Session
         * @return void
         */
        public function set(string $key, $value) :void;
        
        /**
         * Method to publish into Cookie
         *
         * @return void
         */
        public function commit() :void;
        
        /**
         * Method to get information from Session
         *
         * @param string $key Key to information
         * @return mixed
         */
        public function get(string $key = null);
	}
}
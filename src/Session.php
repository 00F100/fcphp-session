<?php

namespace FcPhp\Session
{
    use FcPhp\Cookie\Interfaces\ICookie;
    use FcPhp\Session\Interfaces\ISession;

    class Session implements ISession
    {
        
        /**
         * @var string Key to Cookie
         */
        private $key = 'fcphp-session';
        
        /**
         * @var FcPhp\Cookie\Interfaces\ICookie
         */
        private $cookie;
        
        /**
         * @var array Informations of session
         */
        private $session = [];
        
        /**
         * Method to construct instance of Session
         *
         * @param FcPhp\Cookie\Interfaces\ICookie $cookie Instance of Cookie
         * @return void
         */
        public function __construct(ICookie $cookie)
        {
            $this->cookie = $cookie;
            if($session = $this->cookie->get('session')) {
                $this->session = $session;
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
         * Method to publish into Cookie
         *
         * @return void
         */
        public function commit() :void
        {
            $this->cookie->set('session', $this->session);
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

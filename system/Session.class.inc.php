<?php
class Session
{

    protected $life = 3600; // default lifetime
    protected $data = array();

    public function __construct($life = '')
    {
        if ($life != '') $this->life = $life;

        ini_set('session.use_cookies', 1);
        ini_set('session.use_only_cookies', 1);
        ini_set('session.gc_maxlifetime', $this->life);

        session_start();

        $this->data = $_SESSION;
    }

    public function getSession($key)
    {
        if (isset($this->data[$key])) {
            return $this->data[$key];
        } else {
            return false;
        }
    }

    public function setSession($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function unsetSession($key)
    {
        unset($_SESSION[$key]);
    }
}
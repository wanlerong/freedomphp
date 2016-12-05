<?php
namespace FreedomPHP\Core\Library;

class Session{

    public function __construct()
    {
        session_start();
    }

    public function userdata($key = NULL)
    {
        if (isset($key))
        {
            return isset($_SESSION[$key]) ? $_SESSION[$key] : NULL;
        }
        elseif (empty($_SESSION))
        {
            return array();
        }

        $userdata = array();

        foreach (array_keys($_SESSION) as $key)
        {
            $userdata[$key] = $_SESSION[$key];
        }

        return $userdata;
    }

    // ------------------------------------------------------------------------

    /**
     * Set userdata
     *
     * Legacy CI_Session compatibility method
     *
     * @param	mixed	$data	Session data key or an associative array
     * @param	mixed	$value	Value to store
     * @return	void
     */
    public function set_userdata($data, $value = NULL)
    {
        if (is_array($data))
        {
            foreach ($data as $key => &$value)
            {
                $_SESSION[$key] = $value;
            }

            return;
        }

        $_SESSION[$data] = $value;
    }

    // ------------------------------------------------------------------------

    /**
     * Unset userdata
     *
     * Legacy CI_Session compatibility method
     *
     * @param	mixed	$key	Session data key(s)
     * @return	void
     */
    public function unset_userdata($key)
    {
        if (is_array($key))
        {
            foreach ($key as $k)
            {
                unset($_SESSION[$k]);
            }

            return;
        }

        unset($_SESSION[$key]);
    }


}
<?php
/**
 *------------------------------------------------------
 * Photon microframework
 *
 * @class cookie
 * @author Soliman Adel (Mr-simple)
 * @email {soliman.adelzx@gmail.com}
 * @version v1.0
 *------------------------------------------------------
 */

class cookie
{

    function __construct(){}

    /**
     * set
     * Send a cookie.
     *
     * @param string
     * @param string
     * @param string
     * @return void
     */
    function set($name, $value, $time)
    {
        setcookie($name, $value, strtotime($time), "/", NULL, NULL, TRUE);
    }

    /**
     * get
     * Get a cookie.
     *
     * @param string
     * @return mixed
     */
    function get($key)
    {
        if( !empty($_COOKIE[$key]) ) {
            return htmlspecialchars($_COOKIE[$key]);
        }
        return null;
    }

    /**
     * delete
     * Delete a cookie.
     *
     * @param string
     * @return void
     */
    function delete($name)
    {
        setcookie($name, '', time()-1000);
        setcookie($name, '', time()-1000, '/');
    }


    /**
     * destroy
     * Delete all cookies.
     *
     * @param null
     * @return void
     */
    function destroy()
    {
        if (isset($_SERVER['HTTP_COOKIE'])) {
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            foreach ($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $name = trim($parts[0]);
                setcookie($name, '', time()-1000);
                setcookie($name, '', time()-1000, '/');
            }
        }
    }
}
?>

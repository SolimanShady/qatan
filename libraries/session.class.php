<?php
/**
 *------------------------------------------------------
 * Photon microframework
 *
 * @class session
 * @author Soliman Adel (Mr-simple)
 * @email {soliman.adelzx@gmail.com}
 * @version v1.0
 *------------------------------------------------------
 */

class session
{

    function __construct(){}

    /**
     * Start a session
     *
     * @param null
     * @return void
     */
    function start()
    {
        session_start();
    }

    /**
     * Regenerate session id
     *
     * @param null
     * @return void
     */
    function regenerate()
    {
        session_regenerate_id();
    }

    /**
     * id
     * return session id
     *
     * @param null
     * return mixed
     */

    function id()
    {
        return session_id();
    }

    /**
     * all
     * return session array
     *
     * @param Null
     * @return Array
     */
    function all()
    {
        return (
            !empty($_SESSION)
        ) ? $_SESSION : null;
    }

    /**
     * Set a session
     *
     * @param Mixed
     * @return void
     */
    function set()
    {
        $args = func_get_args();
        // IF we assign session array
        if (is_array($args) && 1 == count($args)) {
            foreach ($args[0] as $key => $value) {
                $_SESSION[$key] = $value;
            }
            // IF we assign key-value pairs
        } elseif(2 == count($args)) {
            $_SESSION[$args[0]] = $args[1];
        }
    }

    /**
     * Get session key
     *
     * @param String $key
     * @return String
     */
    function get($key = "")
    {
        return (!empty($_SESSION[$key])) ? $_SESSION[$key] : null;
    }

    /**
     * Remove session key
     *
     * @param String $key
     * @return void
     */
    function unset($key)
    {
        unset($_SESSION[$key]);
    }

    /**
     * Destroy all sessions
     *
     * @param null
     * @return void
     */
    function destroy()
    {
        session_destroy();
        unset($_SESSION);
    }
}
?>

<?php
/**
 *------------------------------------------------------
 * Photon microframework
 *
 * @class uri
 * @author Soliman Adel (Mr-simple)
 * @email {soliman.adelzx@gmail.com}
 * @version v1.0
 *------------------------------------------------------
 */

class uri
{
    /**
     * segment
     * Get specific part of the url.
     *
     * @param string
     * @param string
     * @return string
     */
    function segment($index, $value = NULL)
    {
        $uri = explode('/', $_SERVER['REQUEST_URI']);
        return (
            !empty($value)
        ) ? $value : urldecode($uri[$index]);
    }
}
?>

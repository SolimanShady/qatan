<?php
/**
 *------------------------------------------------------
 * Photon microframework
 *
 * @class request
 * @author Soliman Adel (Mr-simple)
 * @email {soliman.adelzx@gmail.com}
 * @version v1.0
 *------------------------------------------------------
 */

class request
{
    function __construct()
    {

    }

    function post($data = false)
    {
        if(empty($data)) return $_POST;

        foreach($_POST[$data] AS $key=>$val)
        {
            $_POST[$data][$key] = trim($val);
            $_POST[$data][$key] = strip_tags($val);
            $_POST[$data][$key] = htmlspecialchars($val);
        }

        return $_POST[$data];
    }

    function get($data = false)
    {
        if(empty($data)) return $_GET;
        foreach($_GET[$data] AS $key=>$val)
        {
            $_GET[$data][$key] = trim($val);
            $_GET[$data][$key] = strip_tags($val);
            $_GET[$data][$key] = htmlspecialchars($val);
        }
        return $_GET[$data];
    }


    function server($key = false)
    {
        return (
            !empty($key)
        ) ? $_SERVER[$key] : $_SERVER;
    }

    function file($key = false)
    {
        return (
            !empty($key)
            &&
            in_array($key, $_FILES)
        ) ? $_FILES[$key] : $_FILES;
    }

    function hasFile($key = false)
    {
        return (
            !empty($_FILES[$key]["tmp_name"])
            &&
            $_FILES[$key]["size"] > 0
        ) ? true : false;
    }


    /**
     * isMethod
     * Check if HTTP method match any of the passed methods.
     *
     * @param String
     * @return Boolean
     */
    function isMethod($method = false)
    {
        return (
            $method == $_SERVER["REQUEST_METHOD"]
        ) ? true : false;
    }

    /**
     * isPost
     * Checks whether HTTP method is POST.
     *
     * @param NULL
     * @return Boolean
     */
    function isPost()
    {
        return (
            'POST' == $_SERVER['REQUEST_METHOD']
        ) ? true : false;
    }

    /**
     * isGet
     * Checks whether HTTP method is GET.
     *
     * @param NULL
     * @return Boolean
     */
    function isGet()
    {
        return(
            'GET' == $_SERVER["REQUEST_METHOD"]
        ) ? true : false;
    }

    /**
     * isAjax
     * Checks whether request has been made using AJAX.
     *
     * @param NULL
     * @return Boolean
     */
    function isAjax()
    {
        return(
            'XMLHttpRequest' == $_SERVER['HTTP_X_REQUESTED_WITH']
        ) ? true : false;
    }
}
?>

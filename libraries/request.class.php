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
    function __construct(){}


    /**
     * post
     * return data from post global array.
     *
     * @param   String  $data
     * @return  String
     */
    function post($data = false)
    {
        if(empty($data)) return $_POST;
        $data = self::secure($data);
        return $_POST[$data];
    }

    /**
     * get
     * return data from get global array
     *
     * @param   String  $data
     * @return  String
     */
    function get($data = false)
    {
        if(empty($data)) return $_GET;
        $data = self::secure($data);
        return $_GET[$data];
    }

    /**
     * getHeader
     * Return the value of the give header name.
     *
     * @param   null  $key
     * @return  String
     */
    function getHost()
    {
        return $_SERVER['SERVER_NAME'];
    }

    /**
     * getHeader
     * Return the value of the give header name.
     *
     * @param   String  $key
     * @return  String
     */
    public function getHeader($key = false)
    {
        return (
            !empty($key)
            &&
            array_key_exists($key, $_SERVER)
        ) ? $_SERVER[$key] : "";
    }

    /**
     * hasHeader
     * Checks if the given header exists or not in $_SERVER array.
     *
     * @param   String  $key
     * @return  String
     */
    public function hasHeader($key = false)
    {
        return (
            !empty($key)
            &&
            array_key_exists($key, $_SERVER)
        );
    }

    /**
     * hasFile
     * Check if the current request has a file sent with it.
     *
     * @param String
     * @return Boolean
     *
     */
    function hasFile($key = false)
    {
        return (
            !empty($_FILES[$key]["tmp_name"])
            &&
            $_FILES[$key]["size"] > 0
        );
    }

    /**
     * isMethod
     * Check if HTTP method match any of the passed methods.
     *
     * @param String
     * @return Boolean
     *
     */
    function isMethod($method = false)
    {
        return ($method == $_SERVER["REQUEST_METHOD"]);
    }

    /**
     * isPost
     * Checks whether HTTP method is POST.
     *
     * @param NULL
     * @return Boolean
     *
     */
    function isPost()
    {
        return ('POST' == $_SERVER["REQUEST_METHOD"]);
    }

    /**
     * isGet
     * Checks whether HTTP method is GET.
     *
     * @param NULL
     * @return Boolean
     *
     */
    function isGet()
    {
        return ('GET' == $_SERVER["REQUEST_METHOD"]);
    }

    /**
     * isAjax
     * Checks whether request has been made using AJAX.
     *
     * @param NULL
     * @return Boolean
     *
     */
    function isAjax()
    {
        return(
            isset($_SERVER["HTTP_X_REQUESTED_WITH"])
            &&
            'XMLHttpRequest' == ($_SERVER['HTTP_X_REQUESTED_WITH'])
        );
    }

    /**
     * isXhr
     * Alias of isAjax method.
     * Checks whether request has been made using AJAX.
     *
     * @param NULL
     * @return Boolean
     *
     */
    function isXhr()
    {
        return(
            isset($_SERVER["HTTP_X_REQUESTED_WITH"])
            &&
            'XMLHttpRequest' == ($_SERVER['HTTP_X_REQUESTED_WITH'])
        );
    }

    private function secure($data)
    {
        $data = trim($data);
        $data = strtolower($data);
        $data = strip_tags($data);
        $data = htmlspecialchars($data);

        return $data;
    }
}
?>

<?php
class application
{
    const DEFAULT_CONTROLLER = "home";
    const ERROR_CONTROLLER = 'error';
    const DEFAULT_METHOD = "index";

    private function __clone(){}
    private function __construct(){}

    static function run()
    {
        if ( "POST" == $_SERVER["REQUEST_METHOD"] ) {

            $Y = explode('/', $_SERVER['HTTP_REFERER']);
            $X = explode('/', $_SERVER['HTTP_HOST']);

            if( !empty($_SERVER['HTTP_REFERER']) ) {
                if ($Y[2] != $X[0]) {
                    exit('No direct script access allowed');
                } elseif ($Y[2] != $_SERVER['HTTP_HOST']) {
                    exit('No direct script access allowed');
                }
            }

        }

        session_start();
        header_remove("X-Powered-By");
        header_remove("Server");
        header('x-frame-options: deny');

        // Autoload classes
        spl_autoload_register(function($class){
            if( file_exists("libraries/{$class}.class.php") ) {
                require("libraries/{$class}.class.php");
            }
            else if( file_exists("classes/{$class}.class.php") ) {
                require("classes/{$class}.class.php");
            }
            else {
                throw new \Exception("File {$class} not found !");
            }
        });

        spl_autoload_extensions('.php');

        # Required files
        foreach (["config", "constants", "functions"] AS $file) {
            require_once("includes/{$file}.php");
        }

        # Required files
        foreach (["controller", "model", "view"] AS $file) {
            require_once(__APP__."/{$file}.php");
        }

        $url = !empty($_GET['url']) ? $_GET['url'] : "";

        $uri = explode('/',
            filter_var(
                rtrim($url, '/'),
                FILTER_SANITIZE_URL
            )
        );

        $controller = !empty($uri[0])
                ? __CTRL__ . "/".$uri[0].'.php'
                : __CTRL__ . "/".self::DEFAULT_CONTROLLER.".php";

        $method = ( !empty($uri[1]) )
                ? preg_replace("/\?.*/", "", $uri[1])
                : self::DEFAULT_METHOD;

        $params = !empty($uri[2]) ? $uri[2] : "";

        if ( file_exists($controller) ) {

            $default_controller = self::DEFAULT_CONTROLLER;
            $target_controller = $uri[0];

            require_once($controller);

            $controller = !empty($uri[0])
                          ? new $target_controller
                          : new $default_controller;

        } else {
            require_once(__CTRL__."/error.php");
            $errorController = self::ERROR_CONTROLLER;
            $controller = new $errorController;
        }

        return call_user_func_array(array($controller, $method), array($params));
    }

    function __destruct()
    {
        $vars = array_keys(get_defined_vars());
        foreach($vars as $var) {
            if ( is_resource(${"$var"}) ) {
                ${"$var"} = NULL;
            }
            unset(${"$var"});
        }
    }

}
?>

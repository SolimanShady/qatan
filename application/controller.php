<?php
abstract class controller
{
    protected $load;

    function __construct()
    {
        
        $this->view = new view;

        if (file_exists("config/autoload.php")) {

            // Autoload file
            $autoloads = require_once("config/autoload.php");

            if (!empty($autoloads['libraries'])) {
                foreach ($autoloads['libraries'] as $instance) {
                    $this->load_library($instance);
                }
            }

            if (!empty($autoloads['helpers'])) {
                foreach ($autoloads['helpers'] as $helper) {
                    $this->load_helper($helper);
                }
            }
        }

    }

    abstract function index();

    /**
     * Load library file
     *
     * @param mixed {library name}
     * @return void
     */
    protected function load_library($lib = NULL)
    {
        if ( is_array($lib) )
        {
            foreach ($lib as $l) {
                self::load_library($l);
            }
        }
        else {
            if ( file_exists("libraries/".$lib.".class.php") )
            {
                require_once("libraries/".$lib.".class.php");
                eval("\$this->\$lib = new \$lib;");
            } else {
                throw new \Exception("Library ".$lib." not found");
            }
        }

    }

    /**
     * Load model file
     *
     * @param mixed {model name}
     * @return void
     */
    protected function load_model($model = NULL)
    {
        if ( is_array($model) )
        {
            foreach ($model as $m)
            {
                self::load_model($m);
            }
        }
        else {
            if ( file_exists(__APP__."/models/".$model.".php") )
            {
                require_once(__APP__."/models/".$model.".php");
                eval("\$this->\$model = new _$model;");
            } else {
                throw new \Exception("Model ".$model." not found");
            }
        }

    }

    /**
     * Load helper file
     *
     * @param mixed {helper name}
     * @return void
     */
    protected function load_helper($helper = NULL)
    {
        if ( is_array($helper) )
        {
            foreach ($helper as $h)
            {
                self::load_helper($h);
            }
        }
        else {
            if ( file_exists(__APP__."/helpers/".$helper.".helper.php") )
            {
                require_once(__APP__."/helpers/".$helper.".helper.php");

            } else {
                throw new \Exception("Helper ".$helper." not found");
            }
        }

    }


    /**
     * Garpage collector
     * Unset all object properties.
     *
     * @param null
     * @return void
     */
    function __destruct()
    {
        $properties = get_object_vars($this);
        foreach ($properties as $property) {
            unset($property);
        }
    }
}
?>

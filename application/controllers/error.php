<?php
class _error extends controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $data = array();
        $data["title"] = lang()->home;
        $this->view->display($data, array("error"));
    }
}
?>

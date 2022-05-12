<?php
class account extends controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $data = array();
        $this->view->display($data, array(""));
    }

    function login()
    {
        $data = array();
        $data["title"] = lang()->login;
        $data["settings"] = settings();
        $this->view->display($data, array("login"));
    }

    function forget()
    {
        $data = array();
        $data["title"] = lang()->forget;
        $this->view->display($data, array("forget"));
    }
}
?>

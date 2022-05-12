<?php
class home extends controller
{
    function __construct()
    {
        parent::__construct();
        $this->session->start();
    }

    function index()
    {
        if( isAdmin() ) {
            redirect("admin");
        }
        $data = array();
        $data["title"] = lang()->home;
        $this->view->display($data, array("login"));
    }
    
    function terms()
    {
        $data = array();
        $data["title"] = "terms";
        $this->view->display($data, array("terms"));
    }
}
?>

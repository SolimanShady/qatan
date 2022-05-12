<?php
abstract class model
{
    protected $db;

    function __construct()
    {
        $this->database = database::getInstance();
    }

    function __destruct()
    {
        if (is_resource($this->db)) {
            $this->db->close();
            unset($this->db);
        }
    }
}
?>

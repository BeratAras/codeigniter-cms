<?php
class General_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all($table)
    {
        return $this->db->get($table)->result();
    }
}

?>
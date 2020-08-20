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

    public function get_where($table, $where = array())
    {
        return $this->db->where($where)->get($table)->row();
    }

    public function add_all($table, $data = array())
    {
        return $this->db->insert($table, $data);
    }

    public function update($table, $where = array(), $data = array())
    {
        return $this->db->where($where)->update($table, $data);
    }
}

?>
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_settings()
    {
        $this->db->select('*');
        $this->db->from('setting');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function detail()
    {
        $this->db->select('*');
        $this->db->from('setting');
        $this->db->where('id', 1);
        $query = $this->db->get();
        return $query->row();
    }
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('setting', $data);
    }
}

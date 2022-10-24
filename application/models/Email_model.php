<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Email_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_sendemail()
    {
        $this->db->select('*');
        $this->db->from('email');
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }
    public function email_order()
    {
        $this->db->select('*');
        $this->db->from('email');
        $this->db->where('id', 2);
        $query = $this->db->get();
        return $query->row();
    }
    public function detail_email($id)
    {
        $this->db->select('*');
        $this->db->from('email');
        $this->db->where('id', $id);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->row();
    }
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('email', $data);
    }
    public function update_emailorder($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('email', $data);
    }
}

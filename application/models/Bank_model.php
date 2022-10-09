<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bank_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_allbank()
    {
        $this->db->select('*');
        $this->db->from('bank');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_bank($limit, $start)
    {
        $this->db->select('*');
        $this->db->from('bank');
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }
    public function total_row()
    {
        $this->db->select('*');
        $this->db->from('bank');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function bank_detail($id)
    {
        $this->db->select('*');
        $this->db->from('bank');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    public function create($data)
    {
        $this->db->insert('bank', $data);
    }
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('bank', $data);
    }
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('bank', $data);
    }
}

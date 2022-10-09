<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Service_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_service()
    {
        $this->db->select('*');
        $this->db->from('service');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function detail_service($id)
    {
        $this->db->select('*');
        $this->db->from('service');
        $this->db->where('id', $id);
        $this->db->order_by('id');
        $query = $this->db->get();
        return $query->row();
    }
    //Read Berita
    public function read($service_slug)
    {
        $this->db->select('*');
        $this->db->from('service');
        // Join

        //End Join
        $this->db->where(array(
            'service.service_slug'      =>  $service_slug
        ));
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->row();
    }

    public function create($data)
    {
        $this->db->insert('service', $data);
    }
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('service', $data);
    }
    //Delete Data
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('service', $data);
    }

    //Total Berita Main Layanan
    public function total_row()
    {
        $this->db->select('*');
        $this->db->from('service');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
}

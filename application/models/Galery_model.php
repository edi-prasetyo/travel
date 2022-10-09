<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Galery_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }
  public function get_allgalery()
  {
    $this->db->select('*');
    $this->db->from('galery');
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  public function get_galery($limit, $start)
  {
    $this->db->select('galery.*, user.user_name');
    $this->db->from('galery');
    $this->db->join('user', 'user.id = galery.user_id', 'LEFT');
    $this->db->order_by('id', 'DESC');
    $this->db->limit($limit, $start);
    $query = $this->db->get();
    return $query->result();
  }
  public function slider()
  {
    $this->db->select('*');
    $this->db->from('galery');
    $this->db->order_by('id', 'DESC');
    $this->db->where(['galery_type' => 'Slider']);
    $query = $this->db->get();
    return $query->result();
  }
  public function featured()
  {
    $this->db->select('*');
    $this->db->from('galery');
    $this->db->order_by('id', 'ASC');
    $this->db->where(['galery_type' => 'Featured']);
    $this->db->limit(1);
    $query = $this->db->get();
    return $query->result();
  }
  public function total_row()
  {
    $this->db->select('galery.*, user.user_name');
    $this->db->from('galery');
    $this->db->join('user', 'user.id = galery.user_id', 'LEFT');
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  public function galery_detail($id)
  {
    $this->db->select('*');
    $this->db->from('galery');
    $this->db->where('id', $id);
    $query = $this->db->get();
    return $query->row();
  }
  public function create($data)
  {
    $this->db->insert('galery', $data);
  }
  public function update($data)
  {
    $this->db->where('id', $data['id']);
    $this->db->update('galery', $data);
  }
  public function delete($data)
  {
    $this->db->where('id', $data['id']);
    $this->db->delete('galery', $data);
  }
  public function galery($limit, $start)
  {
    $this->db->select('galery.*, user.user_name');
    $this->db->from('galery');
    $this->db->join('user', 'user.id = galery.user_id', 'LEFT');
    $this->db->where(['galery_type' => 'Halaman']);
    $this->db->order_by('id', 'DESC');
    $this->db->limit($limit, $start);
    $query = $this->db->get();
    return $query->result();
  }
  public function total()
  {
    $this->db->select('galery.*, user.user_name');
    $this->db->from('galery');
    $this->db->join('user', 'user.id = galery.user_id', 'LEFT');
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  public function total_mypgalery()
  {
    $this->db->select('galery.*, user.user_name');
    $this->db->from('galery');
    $this->db->join('user', 'user.id = galery.user_id', 'LEFT');
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  public function read($product_slug)
  {
    $this->db->select('galery.*, user.user_name, user.user_phone, user.user_image');
    $this->db->from('galery');
    $this->db->join('user', 'user.id = galery.user_id', 'LEFT');
    $this->db->where(array(
      'galery.product_slug'      =>  $product_slug
    ));
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->row();
  }
}

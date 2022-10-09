<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tour_model extends CI_Model
{
  //load database
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }
  //List Semua Berita dengan Limit Pagination
  public function get_tour($limit, $start)
  {
    $this->db->select('tour.*,user.user_name');
    $this->db->from('tour');
    // Join
    $this->db->join('user', 'user.id = tour.user_id', 'LEFT');
    //End Join
    $this->db->order_by('id', 'DESC');
    $this->db->limit($limit, $start);
    $query = $this->db->get();
    return $query->result();
  }
  //Total Berita Main Page
  public function total_row()
  {
    $this->db->select('tour.*,user.user_name');
    $this->db->from('tour');
    // Join
    $this->db->join('user', 'user.id = tour.user_id', 'LEFT');
    //End Join
    $this->db->where(['tour_status'     =>  'Publish']);
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  //Total Detail tour
  public function tour_detail($id)
  {
    $this->db->select('*');
    $this->db->from('tour');
    $this->db->where('id', $id);
    $query = $this->db->get();
    return $query->row();
  }
  // Insert data tour ke database
  public function create($data)
  {
    $this->db->insert('tour', $data);
  }
  //Update Data tour ke database
  public function update($data)
  {
    $this->db->where('id', $data['id']);
    $this->db->update('tour', $data);
  }
  //Hapus Data Dari Database
  public function delete($data)
  {
    $this->db->where('id', $data['id']);
    $this->db->delete('tour', $data);
  }
  // Data Berita yang di tampilkan di Front End
  //listing Berita Main Page
  public function tour($limit, $start)
  {
    $this->db->select('tour.*, user.user_name');
    $this->db->from('tour');
    // Join
    $this->db->join('user', 'user.id = tour.user_id', 'LEFT');
    //End Join
    $this->db->where(['tour_status'     =>  'Publish']);
    $this->db->order_by('id', 'DESC');
    $this->db->limit($limit, $start);
    $query = $this->db->get();
    return $query->result();
  }
  public function tour_home()
  {
    $this->db->select('tour.*, user.user_name');
    $this->db->from('tour');
    // Join
    $this->db->join('user', 'user.id = tour.user_id', 'LEFT');
    //End Join
    $this->db->where(['tour_status'     =>  1]);
    $this->db->order_by('tour.id', 'DESC');
    $this->db->limit(4);
    $query = $this->db->get();
    return $query->result();
  }

  //Total Berita Main Page
  public function total()
  {
    $this->db->select('tour.*, user.user_name');
    $this->db->from('tour');
    // Join
    $this->db->join('user', 'user.id = tour.user_id', 'LEFT');
    //End Join
    $this->db->where(['tour_status'     =>  'Publish']);
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  //Read Berita
  public function read($tour_slug)
  {
    $this->db->select('tour.*,user.user_name');
    $this->db->from('tour');
    // Join
    $this->db->join('user', 'user.id = tour.user_id', 'LEFT');
    //End Join
    $this->db->where(array(
      'tour_status'           => 1,
      'tour.tour_slug'      =>  $tour_slug
    ));
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->row();
  }
  // Update Counter Views Berita
  function update_views($tour_slug)
  {
    // return current article views
    $this->db->where('tour_slug', urldecode($tour_slug));
    $this->db->select('tour_views');
    $count = $this->db->get('tour')->row();
    // then increase by one
    $this->db->where('tour_slug', urldecode($tour_slug));
    $this->db->set('tour_views', ($count->tour_views + 1));
    $this->db->update('tour');
  }


  public function get_popular()
  {
    $this->db->select('*');
    $this->db->from('tour');
    $this->db->where(['tour_status'     =>  1]);
    $this->db->order_by('tour.tour_views', 'ASC');
    $this->db->limit(3);
    $query = $this->db->get();
    return $query->result();
  }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Post_model extends CI_Model
{
  //load database
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }
  //List Semua Berita dengan Limit Pagination
  public function get_post($limit, $start)
  {
    $this->db->select('post.*,
    category.category_name, user.user_name');
    $this->db->from('post');
    // Join
    $this->db->join('category', 'category.id = post.category_id', 'LEFT');
    $this->db->join('user', 'user.id = post.user_id', 'LEFT');
    //End Join
    $this->db->order_by('id', 'DESC');
    $this->db->limit($limit, $start);
    $query = $this->db->get();
    return $query->result();
  }
  //Total Berita Main Page
  public function total_row()
  {
    $this->db->select('post.*,category.category_name, user.user_name');
    $this->db->from('post');
    // Join
    $this->db->join('category', 'category.id = post.category_id', 'LEFT');
    $this->db->join('user', 'user.id = post.user_id', 'LEFT');
    //End Join
    $this->db->where(['post_status'     =>  'Publish']);
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  //Total Detail post
  public function post_detail($id)
  {
    $this->db->select('*');
    $this->db->from('post');
    $this->db->where('id', $id);
    $query = $this->db->get();
    return $query->row();
  }
  // Insert data post ke database
  public function create($data)
  {
    $this->db->insert('post', $data);
  }
  //Update Data post ke database
  public function update($data)
  {
    $this->db->where('id', $data['id']);
    $this->db->update('post', $data);
  }
  //Hapus Data Dari Database
  public function delete($data)
  {
    $this->db->where('id', $data['id']);
    $this->db->delete('post', $data);
  }
  // Data Berita yang di tampilkan di Front End
  //listing Berita Main Page
  public function post($limit, $start)
  {
    $this->db->select('post.*,category.category_name, category.category_slug, user.user_name');
    $this->db->from('post');
    // Join
    $this->db->join('category', 'category.id = post.category_id', 'LEFT');
    $this->db->join('user', 'user.id = post.user_id', 'LEFT');
    //End Join
    $this->db->where(['post_status'     =>  'Publish']);
    $this->db->order_by('id', 'DESC');
    $this->db->limit($limit, $start);
    $query = $this->db->get();
    return $query->result();
  }
  public function post_home()
  {
    $this->db->select('post.*,category.category_name,category_slug, user.user_name');
    $this->db->from('post');
    // Join
    $this->db->join('category', 'category.id = post.category_id', 'LEFT');
    $this->db->join('user', 'user.id = post.user_id', 'LEFT');
    //End Join
    $this->db->where(['post_status'     =>  'Publish']);
    $this->db->order_by('post.id', 'DESC');
    $this->db->limit(3);
    $query = $this->db->get();
    return $query->result();
  }
  public function post_footer()
  {
    $this->db->select('post.*,category.category_name,category_slug, user.user_name');
    $this->db->from('post');
    // Join
    $this->db->join('category', 'category.id = post.category_id', 'LEFT');
    $this->db->join('user', 'user.id = post.user_id', 'LEFT');
    //End Join
    $this->db->where(['post_status'     =>  'Publish']);
    $this->db->order_by('post.id', 'ASC');
    $this->db->limit(2);
    $query = $this->db->get();
    return $query->result();
  }
  //Total Berita Main Page
  public function total()
  {
    $this->db->select('post.*,category.category_name, user.user_name');
    $this->db->from('post');
    // Join
    $this->db->join('category', 'category.id = post.category_id', 'LEFT');
    $this->db->join('user', 'user.id = post.user_id', 'LEFT');
    //End Join
    $this->db->where(['post_status'     =>  'Publish']);
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  //Read Berita
  public function read($post_slug)
  {
    $this->db->select('post.*,category.category_name, user.user_name');
    $this->db->from('post');
    // Join
    $this->db->join('category', 'category.id = post.category_id', 'LEFT');
    $this->db->join('user', 'user.id = post.user_id', 'LEFT');
    //End Join
    $this->db->where(array(
      'post_status'           =>  'Publish',
      'post.post_slug'      =>  $post_slug
    ));
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->row();
  }
  // Update Counter Views Berita
  function update_counter($post_slug)
  {
    $this->db->where('post_slug', urldecode($post_slug));
    $this->db->select('post_views');
    $count = $this->db->get('post')->row();
    $this->db->where('post_slug', urldecode($post_slug));
    $this->db->set('post_views', ($count->post_views + 1));
    $this->db->update('post');
  }

  // Category
  public function category($category_id, $limit, $start)
  {
    $this->db->select('post.*,category.category_name, category.category_slug, user.user_name');
    $this->db->from('post');
    // Join
    $this->db->join('category', 'category.id = post.category_id', 'LEFT');
    $this->db->join('user', 'user.id = post.user_id', 'LEFT');
    //End Join
    $this->db->where(['category_id'     =>  $category_id]);
    $this->db->limit($limit, $start);
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  public function total_row_category($category_id)
  {
    $this->db->select('post.*,category.category_name, user.user_name');
    $this->db->from('post');
    // Join
    $this->db->join('category', 'category.id = post.category_id', 'LEFT');
    $this->db->join('user', 'user.id = post.user_id', 'LEFT');
    //End Join
    $this->db->where(['category_id'     =>  $category_id]);
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  public function post_popular()
  {
    $this->db->select('post.*,category.category_name, user.user_name');
    $this->db->from('post');
    // Join
    $this->db->join('category', 'category.id = post.category_id', 'LEFT');
    $this->db->join('user', 'user.id = post.user_id', 'LEFT');
    //End Join
    $this->db->where(['post_status'     =>  'Publish']);
    $this->db->order_by('post.post_views', 'ASC');
    $this->db->limit(5);
    $query = $this->db->get();
    return $query->result();
  }
}

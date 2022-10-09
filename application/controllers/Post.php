<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Post extends CI_Controller
{
  /**
   * Development By Edi Prasetyo
   * edikomputer@gmail.com
   * 0812 3333 5523
   * https://edikomputer.com
   * https://grahastudio.com
   * 
   * index
   * detail
   * add count views
   * 
   */
  public function __construct()
  {
    parent::__construct();
    $this->output->enable_profiler(FALSE);
    $this->load->model('post_model');
    $this->load->model('category_model');
    $this->load->model('meta_model');
    $this->load->library('pagination');
  }
  // index
  public function index()
  {
    $meta                           = $this->meta_model->get_meta();
    $category                       = $this->category_model->get_category();

    $this->load->library('pagination');
    $config['base_url']             = base_url('post/index/');
    $config['total_rows']           = count($this->post_model->total());
    $config['per_page']             = 6;
    $config['uri_segment']          = 3;

    $config['first_link']       = 'First';
    $config['last_link']        = 'Last';
    $config['next_link']        = 'Next';
    $config['prev_link']        = 'Prev';
    $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
    $config['full_tag_close']   = '</ul></nav></div>';
    $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
    $config['num_tag_close']    = '</span></li>';
    $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
    $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
    $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
    $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config['prev_tagl_close']  = '</span>Next</li>';
    $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
    $config['first_tagl_close'] = '</span></li>';
    $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config['last_tagl_close']  = '</span></li>';
    $limit                          = $config['per_page'];
    $start                          = ($this->uri->segment(3)) ? ($this->uri->segment(3)) : 0;
    $this->pagination->initialize($config);
    $post = $this->post_model->post($limit, $start);

    $data = array(
      'title'                       => 'Berita - ' . $meta->title,
      'deskripsi'                   => 'Berita - ' . $meta->description,
      'keywords'                    => 'Berita - ' . $meta->keywords,
      'paginasi'                    => $this->pagination->create_links(),
      'post'                        => $post,
      'category'                    => $category,
      'content'                     => 'front/post/index'
    );
    $this->load->view('front/layout/wrapp', $data, FALSE);
  }
  // detail
  public function detail($post_slug = NULL)
  {
    if (!empty($post_slug)) {
      $post_slug;
    } else {
      redirect(base_url('post'));
    }
    $category                       = $this->category_model->get_category();
    $post                           = $this->post_model->read($post_slug);

    $data                           = array(
      'title'                       => 'Berita',
      'deskripsi'                   => 'Berita',
      'keywords'                    => $post->post_keywords,
      'post'                        => $post,
      'category'                    => $category,

    );
    $this->add_count($post_slug);
    $this->load->view('front/post/detail', $data, FALSE);
  }
  // add count views
  function add_count($post_slug)
  {
    $this->load->helper('cookie');
    $check_visitor = $this->input->cookie(urldecode($post_slug), FALSE);
    $ip = $this->input->ip_address();
    if ($check_visitor == false) {
      $cookie = array(
        "name"                      => urldecode($post_slug),
        "value"                     => "$ip",
        "expire"                    =>  time() + 7200,
        "secure"                    => false
      );
      $this->input->set_cookie($cookie);
      $this->post_model->update_counter(urldecode($post_slug));
    }
  }
}

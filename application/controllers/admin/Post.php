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
   * create
   * update
   * delete
   */

  public function __construct()
  {
    parent::__construct();
    $this->load->model('post_model');
    $this->load->model('category_model');
    $this->load->library('pagination');
  }
  // index
  public function index()
  {
    $config['base_url']         = base_url('admin/post/index/');
    $config['total_rows']       = count($this->post_model->total_row());
    $config['per_page']         = 5;
    $config['uri_segment']      = 4;

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

    $limit                      = $config['per_page'];
    $start                      = ($this->uri->segment(4)) ? ($this->uri->segment(4)) : 0;

    $this->pagination->initialize($config);
    $post = $this->post_model->get_post($limit, $start);
    $data = [
      'title'                 => 'Data Post',
      'post'                  => $post,
      'pagination'            => $this->pagination->create_links(),
      'content'               => 'admin/post/index'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }
  // create
  public function create()
  {
    $category = $this->category_model->get_category();
    $this->form_validation->set_rules(
      'post_title',
      'Judul Post',
      'required',
      [
        'required'              => 'Judul Post harus di isi',
      ]
    );
    $this->form_validation->set_rules(
      'post_description',
      'Deskripsi Post',
      'required',
      [
        'required'              => 'Deskripsi Post harus di isi',
      ]
    );
    if ($this->form_validation->run()) {

      $config['upload_path']      = './assets/img/post/';
      $config['allowed_types']    = 'gif|jpg|png|jpeg';
      $config['max_size']         = 5000000;
      $config['max_width']        = 5000000;
      $config['max_height']       = 5000000;
      $config['remove_spaces']    = TRUE;
      $config['encrypt_name']     = TRUE;
      $this->load->library('upload', $config);
      if (!$this->upload->do_upload('post_image')) {

        $data = [
          'title'                 => 'Tambah Post',
          'category'              => $category,
          'error_upload'          => $this->upload->display_errors(),
          'content'               => 'admin/post/create'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
      } else {
        $upload_data                = array('uploads'  => $this->upload->data());
        $config['image_library']    = 'gd2';
        $config['source_image']     = './assets/img/post/' . $upload_data['uploads']['file_name'];
        $config['new_image']        = './assets/img/post/thumbs/' . $upload_data['uploads']['file_name'];
        $config['create_thumb']     = TRUE;
        $config['maintain_ratio']   = TRUE;
        $config['width']            = 250;
        $config['height']           = 250;
        $config['thumb_marker']     = '';
        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
        $slugcode = random_string('numeric', 5);
        $post_slug  = url_title($this->input->post('post_title'), 'dash', TRUE);
        $data  = [
          'user_id'               => $this->session->userdata('id'),
          'category_id'           => $this->input->post('category_id'),
          'post_slug'             => $slugcode . '-' . $post_slug,
          'post_title'            => $this->input->post('post_title'),
          'post_title_en'         => $this->input->post('post_title_en'),
          'post_description'      => $this->input->post('post_description'),
          'post_description_en'   => $this->input->post('post_description_en'),
          'post_image'            => $upload_data['uploads']['file_name'],
          'post_status'           => $this->input->post('post_status'),
          'post_keywords'         => $this->input->post('post_keywords'),
          'created_at'            => date('Y-m-d H:i:s')
        ];
        $this->post_model->create($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success">Data Post telah ditambahkan</div>');
        redirect(base_url('admin/post'), 'refresh');
      }
    }

    $data = [
      'title'                       => 'Tambah Post',
      'category'                    => $category,
      'content'                     => 'admin/post/create'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }
  // update
  public function Update($id)
  {
    $post = $this->post_model->post_detail($id);
    $category = $this->category_model->get_category();

    $valid = $this->form_validation;
    $valid->set_rules(
      'post_title',
      'Judul Post',
      'required',
      ['required'                   => '%s harus diisi']
    );
    $valid->set_rules(
      'post_description',
      'Isi Post',
      'required',
      ['required'                   => '%s harus diisi']
    );
    if ($valid->run()) {

      if (!empty($_FILES['post_image']['name'])) {

        $config['upload_path']        = './assets/img/post/';
        $config['allowed_types']      = 'gif|jpg|png|jpeg';
        $config['max_size']           = 5000000;
        $config['max_width']          = 5000000;
        $config['max_height']         = 5000000;
        $config['remove_spaces']      = TRUE;
        $config['encrypt_name']       = TRUE;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('post_image')) {

          $data = [
            'title'                 => 'Edit Post',
            'category'              => $category,
            'post'                  => $post,
            'error_upload'          => $this->upload->display_errors(),
            'content'               => 'admin/post/update'
          ];
          $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {

          $upload_data                = array('uploads'  => $this->upload->data());
          $config['image_library']    = 'gd2';
          $config['source_image']     = './assets/img/post/' . $upload_data['uploads']['file_name'];
          $config['new_image']        = './assets/img/post/thumbs/' . $upload_data['uploads']['file_name'];
          $config['create_thumb']     = TRUE;
          $config['maintain_ratio']   = TRUE;
          $config['width']            = 250;
          $config['height']           = 250;
          $config['thumb_marker']     = '';
          $this->load->library('image_lib', $config);
          $this->image_lib->resize();

          if ($post->post_image != "") {
            unlink('./assets/img/post/' . $post->post_image);
          }

          $data  = [
            'id'                  => $id,
            'user_id'             => $this->session->userdata('id'),
            'category_id'         => $this->input->post('category_id'),
            'post_title'          => $this->input->post('post_title'),
            'post_title_en'       => $this->input->post('post_title_en'),
            'post_description'    => $this->input->post('post_description'),
            'post_description_en' => $this->input->post('post_description_en'),
            'post_image'          => $upload_data['uploads']['file_name'],
            'post_status'         => $this->input->post('post_status'),
            'post_keywords'       => $this->input->post('post_keywords'),
            'updated_at'        => date('Y-m-d H:i:s')
          ];
          $this->post_model->update($data);
          $this->session->set_flashdata('message', '<div class="alert alert-success">Data telah di Update</div>');
          redirect(base_url('admin/post'), 'refresh');
        }
      } else {

        if ($post->post_image != "")
          $data  = [
            'id'                  => $id,
            'user_id'             => $this->session->userdata('id'),
            'category_id'         => $this->input->post('category_id'),
            'post_title'          => $this->input->post('post_title'),
            'post_title_en'       => $this->input->post('post_title_en'),
            'post_description'    => $this->input->post('post_description'),
            'post_description_en' => $this->input->post('post_description_en'),
            'post_status'         => $this->input->post('post_status'),
            'post_keywords'       => $this->input->post('post_keywords'),
            'updated_at'        => date('Y-m-d H:i:s')
          ];
        $this->post_model->update($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success">Data telah di Update</div>');
        redirect(base_url('admin/post'), 'refresh');
      }
    }

    $data = [
      'title'               => 'Update Post',
      'category'            => $category,
      'post'                => $post,
      'content'             => 'admin/post/update'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }
  // delete
  public function delete($id)
  {
    is_login();
    $post = $this->post_model->post_detail($id);

    if ($post->post_image != "") {
      unlink('./assets/img/post/' . $post->post_image);
      unlink('./assets/img/post/thumbs/' . $post->post_image);
    }

    $data = ['id'                   => $post->id];
    $this->post_model->delete($data);
    $this->session->set_flashdata('message', '<div class="alert alert-danger">Data telah di Hapus</div>');
    redirect($_SERVER['HTTP_REFERER']);
  }
}

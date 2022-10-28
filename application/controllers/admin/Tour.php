<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tour extends CI_Controller
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
     * schedule
     * update schedule
     * delete schedule
     * 
     */
    //load data
    public function __construct()
    {
        parent::__construct();
        $this->load->model('tour_model');
        $this->load->model('schedule_model');
        $this->load->library('pagination');
    }
    // index
    public function index()
    {
        $config['base_url']         = base_url('admin/tour/index/');
        $config['total_rows']       = count($this->tour_model->total_row());
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
        $tour = $this->tour_model->get_tour($limit, $start);
        $data = [
            'title'         => 'Data Artikel',
            'tour'          => $tour,
            'pagination'    => $this->pagination->create_links(),
            'content'       => 'admin/tour/index'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    // create
    public function create()
    {
        $this->form_validation->set_rules(
            'tour_title',
            'Judul Tour',
            'required',
            [
                'required'              => 'Judul Tour harus di isi',
            ]
        );
        $this->form_validation->set_rules(
            'tour_description',
            'Deskripsi Tour',
            'required',
            [
                'required'              => 'Deskripsi Tour harus di isi',
            ]
        );
        if ($this->form_validation->run()) {

            $config['upload_path']      = './assets/img/tour/';
            $config['allowed_types']    = 'gif|jpg|png|jpeg';
            $config['max_size']         = 5000000;
            $config['max_width']        = 5000000;
            $config['max_height']       = 5000000;
            $config['remove_spaces']    = TRUE;
            $config['encrypt_name']     = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('tour_image')) {

                $data = [
                    'title'                 => 'Tambah Tour',
                    'errors_upload'         => $this->upload->display_errors(),
                    'content'               => 'admin/tour/create'
                ];
                $this->load->view('admin/layout/wrapp', $data, FALSE);
            } else {
                $upload_data                = array('uploads'  => $this->upload->data());
                $config['image_library']    = 'gd2';
                $config['source_image']     = './assets/img/tour/' . $upload_data['uploads']['file_name'];
                $config['new_image']        = './assets/img/tour/thumbs/' . $upload_data['uploads']['file_name'];
                $config['create_thumb']     = TRUE;
                $config['maintain_ratio']   = TRUE;
                $config['width']            = 250;
                $config['height']           = 250;
                $config['thumb_marker']     = '';
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                $slugcode = random_string('numeric', 5);
                $tour_slug  = url_title($this->input->post('tour_title'), 'dash', TRUE);
                $data  = [
                    'user_id'                   => $this->session->userdata('id'),
                    'tour_slug'                 => $slugcode . '-' . $tour_slug,
                    'tour_title'                => $this->input->post('tour_title'),
                    'tour_facility'             => $this->input->post('tour_facility'),
                    'tour_plan'                 => $this->input->post('tour_plan'),
                    'tour_price'                => $this->input->post('tour_price'),
                    'tour_duration'             => $this->input->post('tour_duration'),
                    'tour_facility'             => $this->input->post('tour_facility'),
                    'tour_description'          => $this->input->post('tour_description'),
                    'tour_image'                => $upload_data['uploads']['file_name'],
                    'tour_status'               => $this->input->post('tour_status'),
                    'tour_keywords'             => $this->input->post('tour_keywords'),
                    'meta_description'          => $this->input->post('meta_description'),
                    'tour_title_en'             => $this->input->post('tour_title_en'),
                    'tour_facility_en'          => $this->input->post('tour_facility_en'),
                    'tour_description_en'       => $this->input->post('tour_description_en'),
                    'created_at'                => date('Y-m-d H:i:s')
                ];
                $this->tour_model->create($data);
                $this->session->set_flashdata('message', '<div class="alert alert-success">Data Tour telah ditambahkan</div>');
                redirect(base_url('admin/tour'), 'refresh');
            }
        }

        $data = [
            'title'                       => 'Tambah Tour',
            'content'                     => 'admin/tour/create'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    // update
    public function update($id)
    {
        $tour = $this->tour_model->tour_detail($id);

        $valid = $this->form_validation;
        $valid->set_rules(
            'tour_title',
            'Judul Tour',
            'required',
            ['required'                   => '%s harus diisi']
        );
        $valid->set_rules(
            'tour_description',
            'Isi Tour',
            'required',
            ['required'                   => '%s harus diisi']
        );
        if ($valid->run()) {

            if (!empty($_FILES['tour_image']['name'])) {

                $config['upload_path']        = './assets/img/tour/';
                $config['allowed_types']      = 'gif|jpg|png|jpeg';
                $config['max_size']           = 5000000;
                $config['max_width']          = 5000000;
                $config['max_height']         = 5000000;
                $config['remove_spaces']      = TRUE;
                $config['encrypt_name']       = TRUE;
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('tour_image')) {

                    $data = [
                        'title'                   => 'Edit Tour',
                        'tour'                  => $tour,
                        'error_upload'            => $this->upload->display_errors(),
                        'content'                 => 'admin/tour/update'
                    ];
                    $this->load->view('admin/layout/wrapp', $data, FALSE);
                } else {

                    $upload_data                = array('uploads'  => $this->upload->data());
                    $config['image_library']    = 'gd2';
                    $config['source_image']     = './assets/img/tour/' . $upload_data['uploads']['file_name'];
                    $config['new_image']        = './assets/img/tour/thumbs/' . $upload_data['uploads']['file_name'];
                    $config['create_thumb']     = TRUE;
                    $config['maintain_ratio']   = TRUE;
                    $config['width']            = 250;
                    $config['height']           = 250;
                    $config['thumb_marker']     = '';
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

                    if ($tour->tour_image != "") {
                        unlink('./assets/img/tour/' . $tour->tour_image);
                        unlink('./assets/img/tour/thumbs/' . $tour->tour_image);
                    }

                    $data  = [
                        'id'                        => $id,
                        'user_id'                   => $this->session->userdata('id'),
                        'tour_title'                => $this->input->post('tour_title'),
                        'tour_price'                => $this->input->post('tour_price'),
                        'tour_duration'             => $this->input->post('tour_duration'),
                        'tour_facility'             => $this->input->post('tour_facility'),
                        'tour_plan'                 => $this->input->post('tour_plan'),
                        'tour_description'          => $this->input->post('tour_description'),
                        'tour_image'                => $upload_data['uploads']['file_name'],
                        'tour_status'               => $this->input->post('tour_status'),
                        'tour_keywords'             => $this->input->post('tour_keywords'),
                        'meta_description'          => $this->input->post('meta_description'),
                        'tour_title_en'             => $this->input->post('tour_title_en'),
                        'tour_facility_en'          => $this->input->post('tour_facility_en'),
                        'tour_description_en'       => $this->input->post('tour_description_en'),
                        'updated_at'                => date('Y-m-d H:i:s')
                    ];
                    $this->tour_model->update($data);
                    $this->session->set_flashdata('message', '<div class="alert alert-success">Data telah di Update</div>');
                    redirect(base_url('admin/tour'), 'refresh');
                }
            } else {

                if ($tour->tour_image != "")
                    $data  = [
                        'id'                        => $id,
                        'user_id'                   => $this->session->userdata('id'),
                        'tour_title'                => $this->input->post('tour_title'),
                        'tour_facility'             => $this->input->post('tour_facility'),
                        'tour_plan'                 => $this->input->post('tour_plan'),
                        'tour_price'                => $this->input->post('tour_price'),
                        'tour_duration'             => $this->input->post('tour_duration'),
                        'tour_description'          => $this->input->post('tour_description'),
                        'tour_status'               => $this->input->post('tour_status'),
                        'tour_keywords'             => $this->input->post('tour_keywords'),
                        'meta_description'          => $this->input->post('meta_description'),
                        'tour_title_en'             => $this->input->post('tour_title_en'),
                        'tour_facility_en'          => $this->input->post('tour_facility_en'),
                        'tour_description_en'       => $this->input->post('tour_description_en'),
                        'updated_at'                => date('Y-m-d H:i:s')
                    ];
                $this->tour_model->update($data);
                $this->session->set_flashdata('message', '<div class="alert alert-success">Data telah di Update</div>');
                redirect(base_url('admin/tour'), 'refresh');
            }
        }

        $data = [
            'title'                         => 'Update Tour',
            'tour'                          => $tour,
            'content'                       => 'admin/tour/update'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    // delete
    public function delete($id)
    {
        is_login();
        $tour = $this->tour_model->tour_detail($id);

        if ($tour->tour_image != "") {
            unlink('./assets/img/tour/' . $tour->tour_image);
            unlink('./assets/img/tour/thumbs/' . $tour->tour_image);
        }

        $data = ['id'                   => $tour->id];
        $this->tour_model->delete($data);
        $this->session->set_flashdata('message', '<div class="alert alert-danger">Data telah di Hapus</div>');
        redirect($_SERVER['HTTP_REFERER']);
    }
    // schedule
    public function schedule($tour_id)
    {
        $tour           = $this->tour_model->tour_detail($tour_id);
        $schedule       = $this->schedule_model->listschedule($tour_id);

        $valid = $this->form_validation;

        $valid->set_rules(
            'schedule_date',
            'Tanggal',
            'required',
            [
                'required'         => 'Tanggal Harus diisi',

            ]
        );
        $valid->set_rules(
            'schedule_price',
            'Harga schedule',
            'required',
            array('required'      => '%s harus dicontent')
        );

        if ($valid->run() === FALSE) {
            $data = array(
                'title'             => 'Tambah Jadwal',
                'tour'              => $tour,
                'schedule'          => $schedule,
                'tour_id'           => $tour_id,
                'content'           => 'admin/schedule/index'
            );
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {
            $i     = $this->input;
            $data  = array(
                'user_id'               => $this->session->userdata('id'),
                'tour_id'               => $tour_id,
                'schedule_date'         => $i->post('schedule_date'),
                'schedule_price'        => $i->post('schedule_price'),
                'schedule_stock'        => $i->post('schedule_stock'),
                'schedule_status'       => $i->post('schedule_status'),
                'created_at'            => date('Y-m-d')
            );
            $this->schedule_model->create($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Data telah ditambahkan</div>');
            redirect(base_url('admin/tour/schedule/' . $tour_id), 'refresh');
        }
        $data = array(
            'title'             => 'Tambah Jadwal',
            'tour'              => $tour,
            'schedule'          => $schedule,
            'content'           => 'admin/schedule/index'
        );
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    // update schedule
    public function update_schedule($id)
    {
        $schedule = $this->schedule_model->detail($id);
        $this->form_validation->set_rules(
            'schedule_price',
            'Harga',
            'required',
            array('required'                  => '%s Harus Diisi')
        );
        if ($this->form_validation->run() === FALSE) {

            $data = [
                'title'                         => 'Edit kategori Berita',
                'schedule'                      => $schedule,
                'content'                       => 'admin/schedule/update'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {
            $data  = [
                'id'                        => $id,
                'schedule_price'            => $this->input->post('schedule_price'),
                'schedule_stock'            => $this->input->post('schedule_stock'),
                'schedule_status'           => $this->input->post('schedule_status'),
                'updated_at'                => date('Y-m-d')
            ];
            $this->schedule_model->update($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Data telah di Update</div>');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    // delete schedule
    public function delete_schedule($id)
    {
        is_login();
        $schedule = $this->schedule_model->detail($id);
        $data = array('id'   => $schedule->id);
        $this->schedule_model->delete($data);
        $this->session->set_flashdata('message', '<div class="alert alert-danger">Data telah di Hapus</div>');
        redirect($_SERVER['HTTP_REFERER']);
    }
}

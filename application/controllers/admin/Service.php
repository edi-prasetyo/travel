<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Service extends CI_Controller
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
     * 
     */

    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('service_model');
    }
    // index
    public function index()
    {
        $config['base_url']         = base_url('admin/service/index/');
        $config['total_rows']       = count($this->service_model->total_row());
        $config['per_service']      = 10;
        $config['uri_segment']      = 4;

        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="service-item"><span class="service-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="service-item active"><span class="service-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="service-item"><span class="service-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="service-item"><span class="service-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="service-item"><span class="service-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="service-item"><span class="service-link">';
        $config['last_tagl_close']  = '</span></li>';

        $limit                      = $config['per_service'];
        $start                      = ($this->uri->segment(4)) ? ($this->uri->segment(4)) : 0;

        $this->pagination->initialize($config);
        $service = $this->service_model->get_service($limit, $start);
        $data = [
            'title'             => 'Service',
            'service'           => $service,
            'pagination'        => $this->pagination->create_links(),
            'content'           => 'admin/service/index'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    // create
    public function create()
    {
        $this->form_validation->set_rules(
            'service_name',
            'Nama Service',
            'required',
            array(
                'required'         => '%s Harus Diisi'
            )
        );
        $this->form_validation->set_rules(
            'service_desc',
            'Deskripsi Halaman',
            'required',
            array(
                'required'         => '%s Harus Diisi'
            )
        );
        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'             => 'Buat Service',
                'deskripsi'         => 'Deskripsi',
                'keywords'          => 'Keywords',
                'content'           => 'admin/service/create'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {
            $slugcode = random_string('numeric', 5);
            $service_slug  = url_title($this->input->post('service_name'), 'dash', TRUE);
            $data  = [
                'user_id'                   => $this->session->userdata('id'),
                'service_slug'              =>  $service_slug . '-' . $slugcode,
                'service_name_id'           => $this->input->post('service_name_id'),
                'service_name_en'           => $this->input->post('service_name_en'),
                'service_icon'              => $this->input->post('service_icon'),
                'service_color'             => $this->input->post('service_color'),
                'service_desc_id'           => $this->input->post('service_desc_id'),
                'service_desc_en'           => $this->input->post('service_desc_en'),
                'created_at'                => date('Y-m-d H:i:s')
            ];
            $this->service_model->create($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Data telah ditambahkan</div>');
            redirect(base_url('admin/service'), 'refresh');
        }
    }
    // update
    public function update($id)
    {
        $service = $this->service_model->detail_service($id);

        $this->form_validation->set_rules(
            'service_name_id',
            'Nama Service',
            'required',
            array('required'         => '%s Harus Diisi')
        );
        $this->form_validation->set_rules(
            'service_desc_id',
            'Deskripsi Halaman',
            'required',
            array('required'         => '%s Harus Diisi')
        );
        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'             => 'Edit Service',
                'service'              => $service,
                'content'           => 'admin/service/update'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {

            $data  = [
                'id'                        => $id,
                'user_id'                   => $this->session->userdata('id'),
                'service_name_id'           => $this->input->post('service_name_id'),
                'service_name_en'           => $this->input->post('service_name_en'),
                'service_icon'              => $this->input->post('service_icon'),
                'service_color'             => $this->input->post('service_color'),
                'service_desc_id'           => $this->input->post('service_desc_id'),
                'service_desc_en'           => $this->input->post('service_desc_en'),
                'updated_at'                => date('Y-m-d H:i:s')
            ];
            $this->service_model->update($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Data telah di Update</div>');
            redirect(base_url('admin/service'), 'refresh');
        }
    }
    // delete
    public function delete($id)
    {
        is_login();
        $service = $this->service_model->detail_service($id);
        $data = ['id'   => $service->id];
        $this->service_model->delete($data);
        $this->session->set_flashdata('message', '<div class="alert alert-danger">Data telah di Hapus</div>');
        redirect(base_url('admin/service'), 'refresh');
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bank extends CI_Controller
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
        $this->load->model('bank_model');
        $this->load->library('pagination');
        $this->load->library('upload');
    }
    // index
    public function index()
    {
        $config['base_url']         = base_url('admin/bank/index/');
        $config['total_rows']       = count($this->bank_model->total_row());
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
        $bank = $this->bank_model->get_bank($limit, $start);
        $data = [
            'title'                 => 'Data Bank',
            'bank'                  => $bank,
            'pagination'            => $this->pagination->create_links(),
            'content'               => 'admin/bank/index'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    // create
    public function create()
    {
        $this->form_validation->set_rules(
            'bank_name',
            'Nama Bank',
            'required',
            [
                'required'      => 'Nama Bank harus di isi',
            ]
        );
        $this->form_validation->set_rules(
            'bank_number',
            'Nomor rekening',
            'required',
            [
                'required'      => 'Nomor rekening harus di isi',
            ]
        );

        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'                 => 'Tambah Bank',
                'content'               => 'admin/bank/create'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {
            $data  = [
                'user_id'               => $this->session->userdata('id'),
                'bank_name'             => $this->input->post('bank_name'),
                'bank_number'           => $this->input->post('bank_number'),
                'bank_account'          => $this->input->post('bank_account'),
                'bank_branch'           => $this->input->post('bank_branch'),
                'date_created'          => time()
            ];
            $this->bank_model->create($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Data Bank telah ditambahkan</div>');
            redirect(base_url('admin/bank'), 'refresh');
        }
    }
    // update
    public function Update($id)
    {
        $bank = $this->bank_model->bank_detail($id);
        $valid = $this->form_validation;
        $valid->set_rules(
            'bank_name',
            'Nama Bank',
            'required',
            ['required'      => '%s harus diisi']
        );

        if ($valid->run() === FALSE) {

            $data = [
                'title'                 => 'Edit Bank',
                'bank'                  => $bank,
                'content'               => 'admin/bank/update'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {

            $data  = [
                'id'                    => $id,
                'user_id'               => $this->session->userdata('id'),
                'bank_name'             => $this->input->post('bank_name'),
                'bank_number'           => $this->input->post('bank_number'),
                'bank_account'          => $this->input->post('bank_account'),
                'bank_branch'           => $this->input->post('bank_branch'),
                'date_updated'          => time()
            ];
            $this->bank_model->update($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Data telah di Update</div>');
            redirect(base_url('admin/bank'), 'refresh');
        }
    }
    // delete
    public function delete($id)
    {
        is_login();
        $bank = $this->bank_model->bank_detail($id);

        if ($bank->bank_logo != "") {
            unlink('./assets/img/bank/' . $bank->bank_logo);
        }

        $data = ['id'   => $bank->id];
        $this->bank_model->delete($data);
        $this->session->set_flashdata('message', '<div class="alert alert-danger">Data telah di Hapus</div>');
        redirect($_SERVER['HTTP_REFERER']);
    }
}

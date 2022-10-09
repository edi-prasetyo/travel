<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting extends CI_Controller
{
    /**
     * Development By Edi Prasetyo
     * edikomputer@gmail.com
     * 0812 3333 5523
     * https://edikomputer.com
     * https://grahastudio.com
     * 
     * index
     * language Active
     * language Inactive
     * payment active
     * payment inactive
     * payment gateway
     * 
     */

    public function __construct()
    {
        parent::__construct();
        $this->load->model('setting_model');
    }
    // index
    public function index()
    {
        $setting = $this->setting_model->detail();

        $data    = [
            'title'                => 'Pengaturan',
            'setting'              => $setting,
            'content'              => 'admin/setting/index'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    // language Active
    public function language_active()
    {
        $data = [
            'id'                    => 1,
            'language'              => 1,
        ];
        $this->setting_model->update($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success">Data Telah di Update</div>');
        redirect($_SERVER['HTTP_REFERER']);
    }
    // language Inactive
    public function language_inactive()
    {
        $data = [
            'id'                    => 1,
            'language'              => 0,
        ];
        $this->setting_model->update($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success">Data Telah di Update</div>');
        redirect($_SERVER['HTTP_REFERER']);
    }
    // payment active
    public function payment_active()
    {
        $data = [
            'id'                    => 1,
            'payment_gateway'       => 1,
        ];
        $this->setting_model->update($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success">Data Telah di Update</div>');
        redirect($_SERVER['HTTP_REFERER']);
    }
    // payment inactive
    public function payment_inactive()
    {
        $data = [
            'id'                    => 1,
            'payment_gateway'       => 0,
        ];
        $this->setting_model->update($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success">Data Telah di Update</div>');
        redirect($_SERVER['HTTP_REFERER']);
    }
    // payment gateway
    public function payment_gateway()
    {
        $setting =  $this->setting_model->detail();
        $id = $setting->id;
        $data  = [
            'id'                        => $id,
            'midtrans_environment'      => $this->input->post('midtrans_environment'),
            'midtrans_server_key'       => $this->input->post('midtrans_server_key'),
            'midtrans_client_key'       => $this->input->post('midtrans_client_key'),
            'updated_at'                => date('Y-m-d H:i:s')
        ];
        $this->setting_model->update($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success">Data telah di Update</div>');
        redirect($_SERVER['HTTP_REFERER']);
    }
}

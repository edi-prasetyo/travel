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
        $this->load->model('email_model');
    }
    // index
    public function index()
    {
        $setting = $this->setting_model->detail();
        $email_order =  $this->email_model->email_order();

        $data    = [
            'title'                => 'Pengaturan',
            'setting'              => $setting,
            'email_order'           => $email_order,
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
    // Email Order
    public function email_order()
    {
        $email_order =  $this->email_model->email_order();
        $id = $email_order->id;

        $data  = [
            'id'                        => $id,
            'name'      => $this->input->post('name'),
            'protocol'       => $this->input->post('protocol'),
            'smtp_host'       => $this->input->post('smtp_host'),
            'smtp_port'       => $this->input->post('smtp_port'),
            'smtp_user'       => $this->input->post('smtp_user'),
            'smtp_pass'       => $this->input->post('smtp_pass'),
            'updated_at'                => date('Y-m-d H:i:s')
        ];
        $this->email_model->update_emailorder($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success">Data telah di Update</div>');
        redirect($_SERVER['HTTP_REFERER']);
    }
    // Email Order active
    public function emailorder_active()
    {
        $data = [
            'id'                => 1,
            'email_order'       => 1,
        ];
        $this->setting_model->update($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success">Email Order telah di Aktifkan</div>');
        redirect($_SERVER['HTTP_REFERER']);
    }
    // Email Order Inactive
    public function emailorder_inactive()
    {
        $data = [
            'id'                => 1,
            'email_order'       => 0,
        ];
        $this->setting_model->update($data);
        $this->session->set_flashdata('message', '<div class="alert alert-danger">Email Order telah di Nonaktifkan</div>');
        redirect($_SERVER['HTTP_REFERER']);
    }
}

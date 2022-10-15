<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaction extends CI_Controller
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
     * cancel
     * 
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('transaction_model');
        $this->load->model('bank_model');
        $this->load->model('schedule_model');
        $this->load->library('pagination');
    }
    // index
    public function index()
    {
        $config['base_url']         = base_url('admin/transaction/index/');
        $config['total_rows']       = count($this->transaction_model->total_row());
        $config['per_page']         = 10;
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
        $transaction = $this->transaction_model->get_transaction($limit, $start);
        $data = [
            'title'                         => 'Penjualan',
            'transaction'                   => $transaction,
            'pagination'                    => $this->pagination->create_links(),
            'content'                       => 'admin/transaction/index'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    // create
    public function create()
    {
        $this->form_validation->set_rules(
            'fullname',
            'Nama',
            'required',
            array(
                'required'                        => '%s Harus Diisi',
            )
        );
        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'                           => 'Order',
                'content'                         => 'admin/transaction/create'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {
            $invoice_number = strtoupper(random_string('numeric', 7));

            $price = $this->input->post('price');
            $quantity = $this->input->post('quantity');
            $total_price = (int)$price * (int)$quantity;

            $data  = [
                'fullname'              => $this->input->post('fullname'),
                'email'                 => $this->input->post('email'),
                'phone'                 => $this->input->post('phone'),
                'address'               => $this->input->post('address'),
                'tour_id'               => $this->input->post('tour_id'),
                'schedule_id'           => $this->input->post('schedule_id'),
                'tour_title'            => $this->input->post('tour_title'),
                'tour_date'             => $this->input->post('tour_date'),
                'address'               => $this->input->post('address'),
                'payment'               => $this->input->post('payment'),
                'quantity'              => $quantity,
                'price'                 => $price,
                'total_price'           => $total_price,
                'invoice_number'        => $invoice_number,
                'payment_status'        => 'pending',
                'created_at'            => date('Y-m-d')
            ];
            $this->transaction_model->create($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Data telah ditambahkan</div>');
            redirect(base_url('admin/transaction'), 'refresh');
        }
    }
    // detail
    public function detail($id)
    {
        $transaction = $this->transaction_model->detail($id);
        $data = [
            'title'                   => "Detail Penjualan",
            'transaction'             => $transaction,
            'content'                 => 'admin/transaction/detail'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    // cancel
    public function paid($id)
    {
        $transaction = $this->transaction_model->detail($id);
        $schedule_id = $transaction->schedule_id;
        is_login();
        $data = [
            'id'                        => $id,
            'status_code'            => 200,
        ];
        $this->transaction_model->update($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success">Transaksi Berhasil</div>');
        $this->update_stock($schedule_id);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function update_stock($schedule_id)
    {
        $schedule = $this->schedule_model->schedule_detail($schedule_id);
        $update_stock = $schedule->schedule_stock - 1;
        // var_dump($update_stock);
        // die;
        $data = [
            'id'             => $schedule_id,
            'schedule_stock'            => $update_stock,
        ];
        $this->schedule_model->update_stock($data);
    }

    // cancel
    public function cancel($id)
    {
        is_login();
        $data = [
            'id'                        => $id,
            'status_code'                    => 202,
        ];
        $this->transaction_model->update($data);
        $this->session->set_flashdata('message', '<div class="alert alert-danger">Transaksi telah di cancel</div>');
        redirect($_SERVER['HTTP_REFERER']);
    }
}

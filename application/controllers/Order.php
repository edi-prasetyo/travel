<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order extends CI_Controller
{
    /**
     * Development By Edi Prasetyo
     * edikomputer@gmail.com
     * 0812 3333 5523
     * https://edikomputer.com
     * https://grahastudio.com
     * 
     * index
     * trip
     * create
     * success
     * 
     */
    public function __construct()
    {
        parent::__construct();
        $this->output->enable_profiler(FALSE);
        $this->load->model('tour_model');
        $this->load->model('schedule_model');
        $this->load->model('meta_model');
        $this->load->model('transaction_model');
        $this->load->library('pagination');
    }
    // index
    public function index()
    {
        redirect(base_url(), 'refresh');
    }
    // trip
    public function trip($id)
    {
        $meta       = $this->meta_model->get_meta();
        $tour       = $this->schedule_model->detail_order($id);
        $data = array(
            'title'                       => 'Tour',
            'deskripsi'                   => 'Trip - ' . $meta->description,
            'keywords'                    => 'Trip - ' . $meta->keywords,
            'paginasi'                    => $this->pagination->create_links(),
            'tour'                        => $tour,
            'content'                     => 'front/order/trip'
        );
        $this->load->view('front/layout/wrapp', $data, FALSE);
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
                'content'                         => 'order/trip/index'
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
                'tour_title'            => $this->input->post('tour_title'),
                'tour_date'             => $this->input->post('tour_date'),
                'address'               => $this->input->post('address'),
                'quantity'              => $quantity,
                'price'                 => $price,
                'total_price'           => $total_price,
                'invoice_number'        => $invoice_number,
                'payment_status'        => 'pending',
                'created_at'            => date('Y-m-d')
            ];
            $insert_id = $this->transaction_model->create($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Data telah ditambahkan</div>');
            redirect(base_url('payment?id=' . md5($insert_id)), 'refresh');
        }
    }
    // success
    public function success($insert_id)
    {
    }
}

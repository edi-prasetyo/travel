<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Open_trip extends CI_Controller
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
     * 
     */
    public function __construct()
    {
        parent::__construct();
        $this->output->enable_profiler(FALSE);
        $this->load->model('tour_model');
        $this->load->model('schedule_model');
        $this->load->model('meta_model');
        $this->load->library('pagination');
    }
    // index
    public function index()
    {
        $meta       = $this->meta_model->get_meta();
        $start_date = $this->input->get('start_date');
        $end_date   = $this->input->get('end_date');
        $tour       = $this->schedule_model->get_schedule($start_date, $end_date);
        $data = array(
            'title'                       => 'Tour',
            'deskripsi'                   => 'Tour - ' . $meta->description,
            'keywords'                    => 'Tour - ' . $meta->keywords,
            'paginasi'                    => $this->pagination->create_links(),
            'tour'                        => $tour,
            'content'                     => 'front/trip/index'
        );
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }
}

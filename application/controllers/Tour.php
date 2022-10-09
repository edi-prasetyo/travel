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
     * detail
     * add views
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
        $meta                           = $this->meta_model->get_meta();

        $this->load->library('pagination');
        $config['base_url']             = base_url('tour/index/');
        $config['total_rows']           = count($this->tour_model->total());
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
        $tour = $this->tour_model->get_tour($limit, $start);
        $data = array(
            'title'                       => 'Tour',
            'deskripsi'                   => 'Tour - ' . $meta->description,
            'keywords'                    => 'Tour - ' . $meta->keywords,
            'paginasi'                    => $this->pagination->create_links(),
            'tour'                        => $tour,
            'content'                     => 'front/tour/index'
        );
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }
    // detail
    public function detail($tour_slug = NULL)
    {
        if (!empty($tour_slug)) {
            $tour_slug;
        } else {
            redirect(base_url('tour'));
        }
        $tour                         = $this->tour_model->read($tour_slug);
        $tour_id = $tour->id;
        $schedule = $this->schedule_model->listschedule($tour_id);
        $data = array(
            'title'                     => 'Tour',
            'deskripsi'                 => 'Tour',
            'keywords'                  => $tour->tour_keywords,
            'tour'                      => $tour,
            'schedule'                  => $schedule,
        );
        $this->add_views($tour_slug);
        $this->load->view('front/tour/detail', $data, FALSE);
    }
    // add views
    function add_views($tour_slug)
    {
        $this->load->helper('cookie');
        $check_visitor = $this->input->cookie(urldecode($tour_slug), FALSE);
        $ip = $this->input->ip_address();
        if ($check_visitor == false) {
            $cookie = array(
                "name"                   => urldecode($tour_slug),
                "value"                  => "$ip",
                "expire"                 =>  time() + 7200,
                "secure"                 => false
            );
            $this->input->set_cookie($cookie);
            $this->tour_model->update_views(urldecode($tour_slug));
        }
    }
}

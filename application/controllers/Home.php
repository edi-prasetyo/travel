<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    /**
     * Development By Edi Prasetyo
     * edikomputer@gmail.com
     * 0812 3333 5523
     * https://edikomputer.com
     * https://grahastudio.com
     * 
     * index
     * translate
     * 
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('meta_model');
        $this->load->model('post_model');
        $this->load->model('homepage_model');
        $this->load->model('service_model');
        $this->load->model('category_model');
        $this->load->model('tour_model');
    }
    // index
    public function index()
    {
        $meta                   = $this->meta_model->get_meta();
        $post                   = $this->post_model->post_home();
        $homepage               = $this->homepage_model->get_homepage();
        $service                = $this->service_model->get_service();
        $tour                   = $this->tour_model->tour_home();
        $popular_tour           = $this->tour_model->get_popular();

        $data = array(
            'title'                 => $meta->title . ' - ' . $meta->tagline,
            'keywords'              => $meta->title . ' - ' . $meta->tagline . ',' . $meta->keywords,
            'deskripsi'             => $meta->description,
            'post'                  => $post,
            'homepage'              => $homepage,
            'service'               => $service,
            'tour'                  => $tour,
            'popular_tour'          => $popular_tour,
            'content'               => 'front/home/index'
        );
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }
    // translate
    public function translate($language)
    {
        $newData = [
            'language' => $language
        ];
        $this->session->set_userdata($newData);
        if ($this->session->userdata('language')) {
            redirect($_SERVER['HTTP_REFERER']);
        };
    }
}

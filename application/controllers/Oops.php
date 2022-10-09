<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Oops extends CI_Controller
{
    /**
     * Development By Edi Prasetyo
     * edikomputer@gmail.com
     * 0812 3333 5523
     * https://edikomputer.com
     * https://grahastudio.com
     */
    public function index()
    {
        $data = array(
            'title'     => 'Oops! Halaman tidak di temukan',
            'deskripsi' => 'error 404',
            'keywords'  => 'keywords',
            'content'   => 'front/oops/index_oops'
        );
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }
}

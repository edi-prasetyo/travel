<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	/**
	 * Development By Edi Prasetyo
	 * edikomputer@gmail.com
	 * 0812 3333 5523
	 * https://edikomputer.com
	 * https://grahastudio.com
	 * 
	 * index
	 * login
	 * logout
	 * 
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}
	// index
	public function index()
	{
		if ($this->session->userdata('id')) {
			redirect('admin/dashboard');
		}
		$this->form_validation->set_rules(
			'email',
			'Email',
			'required|trim|valid_email',
			[
				'required' 		=> 'Email harus di isi',
				'valid_email' 	=> 'Format email Tidak sesuai'
			]
		);
		$this->form_validation->set_rules(
			'password',
			'Password',
			'required|trim',
			[
				'required' 		=> 'Password harus di isi',
			]
		);
		if ($this->form_validation->run() == false) {
			$data = [
				'title' 		=> 'User Login',
				'deskripsi'		=> 'deskripsi',
				'keywords'		=> 'keywords',
				'content'       => 'front/auth/login'
			];
			$this->load->view('front/layout/wrapp', $data, FALSE);
		} else {
			$this->_login();
		}
	}
	// login
	private function _login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$user = $this->db->get_where('user', ['email' => $email])->row_array();
		if ($user) {

			if ($user['is_active'] == 1) {

				if (password_verify($password, $user['password'])) {

					$data  = [
						'email'		=> $user['email'],
						'role_id'	=> $user['role_id'],
						'id'		=> $user['id'],
					];
					$this->session->set_userdata($data);
					if ($user['role_id'] == 1  || $user['role_id'] == 2) {
						redirect('admin/dashboard');
					} else {
						redirect('auth');
					}
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger">Password Salah</div> ');
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Email Belum di Aktivasi, Silahkan Cek email anda</div> ');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger">Email Tidak Terdaftar</div> ');
			redirect('auth');
		}
	}
	// logout
	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');
		$this->session->unset_userdata('id');
		$this->session->set_flashdata('message', '<div class="alert alert-success">Anda sudah Logout</div> ');
		redirect('auth');
	}
}

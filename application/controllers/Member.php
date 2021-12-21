<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('M_member');
        $this->load->model('M_member');
    }

    public function registrasi()
    {
        $this->form_validation->set_rules('nama', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'Email has already registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[5]|matches[password2]', [
            'matches' => 'Password doesn\'t match',
            'min_length' => 'Password too short'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|min_length[5]|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data = array(
                'title' => 'LAPERPOOL | Registrasi'
            );
            $this->load->view('login/header', $data);
            $this->load->view('v_registrasi');
            $this->load->view('login/footer');
        } else {
            $data = [
                'nama' => $this->input->post('nama', true),
                'password' => $this->input->post('password1'),
                'role_id' => 2,
                'email' => $this->input->post('email', true)
            ];
            $this->M_member->register($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Akun anda telah terdaftar. Silahkan Login! </div>');
            redirect('member/login');
        }
    }

    public function login()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == true) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $this->pelanggan_login->login($email, $password);
        }
        $data = array(
            'title' => 'LAPERPOOL | Registrasi'
        );
        $this->load->view('login/header', $data);
        $this->load->view('login_pelanggan');
        $this->load->view('login/footer');
    }
    public function logout()
    {
        $this->pelanggan_login->logout();
    }
}

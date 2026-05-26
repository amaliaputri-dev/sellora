<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->session->userdata('logged_in')) {
            redirect('dashboard');
        }

        $this->load->view('auth/login');
    }

    public function login()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('auth/login');
            return;
        }

        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->User_model->get_by_username($username);
        if (!$user) {
            $this->User_model->create_default_admin();
            $user = $this->User_model->get_by_username($username);
        }

        if ($user && password_verify($password, $user->password)) {
            $this->session->set_userdata([
                'logged_in' => true,
                'user_id' => $user->id,
                'username' => $user->username,
            ]);
            redirect('dashboard');
        }

        $data['error'] = 'Username atau password salah.';
        $this->load->view('auth/login', $data);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth');
    }
}

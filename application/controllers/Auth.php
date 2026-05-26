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
        if ($this->get_authenticated_user()) {
            redirect('dashboard');
        }

        $this->User_model->create_default_users();
        $data = [
            'title' => 'Login',
            'message' => $this->input->get('message', TRUE),
        ];
        $this->load->view('auth/login', $data);
    }

    public function login()
    {
        if ($this->get_authenticated_user()) {
            redirect('dashboard');
        }

        $this->User_model->create_default_users();
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title' => 'Login',
                'message' => null,
            ];
            $this->load->view('auth/login', $data);
            return;
        }

        $username = trim($this->input->post('username', TRUE));
        $password = (string) $this->input->post('password');
        $user = $this->User_model->get_by_username($username);

        if ($user && password_verify($password, $user->password)) {
            $this->set_auth_cookie($user);
            redirect('dashboard');
        }

        $data = [
            'title' => 'Login',
            'message' => 'Username atau password salah.',
        ];
        $this->load->view('auth/login', $data);
    }

    public function logout()
    {
        $this->clear_auth_cookie();
        delete_cookie('sellora_cart');
        redirect('auth?message=' . rawurlencode('Anda sudah logout.'));
    }

    protected function get_authenticated_user()
    {
        $user_id = (int) $this->input->cookie('sellora_auth_user', TRUE);
        $auth_hash = $this->input->cookie('sellora_auth_hash', TRUE);

        if ($user_id < 1 || empty($auth_hash)) {
            return null;
        }

        $user = $this->User_model->get_by_id($user_id);
        if (!$user) {
            return null;
        }

        if (!hash_equals(sha1($user->password), $auth_hash)) {
            return null;
        }

        return $user;
    }

    protected function set_auth_cookie($user)
    {
        set_cookie([
            'name' => 'sellora_auth_user',
            'value' => $user->id,
            'expire' => 86400,
            'path' => '/',
            'httponly' => TRUE,
        ]);

        set_cookie([
            'name' => 'sellora_auth_hash',
            'value' => sha1($user->password),
            'expire' => 86400,
            'path' => '/',
            'httponly' => TRUE,
        ]);
    }

    protected function clear_auth_cookie()
    {
        delete_cookie('sellora_auth_user');
        delete_cookie('sellora_auth_hash');
    }
}

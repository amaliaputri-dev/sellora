<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    protected $current_user = null;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->current_user = $this->get_authenticated_user();

        if (!$this->current_user) {
            redirect('auth');
        }
    }

    protected function render($view, $data = [])
    {
        $data['current_user'] = $this->current_user;
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view($view, $data);
        $this->load->view('layout/footer', $data);
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
}

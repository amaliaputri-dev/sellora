<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('logged_in') && $this->router->fetch_class() !== 'auth') {
            redirect('auth');
        }
    }

    protected function render($view, $data = [])
    {
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view($view, $data);
        $this->load->view('layout/footer', $data);
    }
}

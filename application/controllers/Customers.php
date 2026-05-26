<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Customer_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data = [
            'title' => 'Data Pelanggan',
            'customers' => $this->Customer_model->get_all(),
        ];
        $this->render('customers/index', $data);
    }

    public function create()
    {
        $this->form_validation->set_rules('name', 'Nama Pelanggan', 'trim|required');
        $this->form_validation->set_rules('phone', 'Nomor Telepon', 'trim');
        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email');

        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title' => 'Tambah Pelanggan',
                'customer' => null,
            ];
            $this->render('customers/form', $data);
            return;
        }

        $this->Customer_model->insert($this->input->post());
        redirect('customers');
    }

    public function edit($id = null)
    {
        $customer = $this->Customer_model->get_by_id($id);
        if (!$customer) {
            show_404();
        }

        $this->form_validation->set_rules('name', 'Nama Pelanggan', 'trim|required');
        $this->form_validation->set_rules('phone', 'Nomor Telepon', 'trim');
        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email');

        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title' => 'Edit Pelanggan',
                'customer' => $customer,
            ];
            $this->render('customers/form', $data);
            return;
        }

        $this->Customer_model->update($id, $this->input->post());
        redirect('customers');
    }

    public function delete($id = null)
    {
        if ($id) {
            $this->Customer_model->delete($id);
        }
        redirect('customers');
    }
}

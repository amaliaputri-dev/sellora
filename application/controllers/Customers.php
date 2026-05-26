<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/MY_CRUD_Controller.php';

class Customers extends MY_CRUD_Controller {
    public function __construct()
    {
        $this->model_name = 'Customer_model';
        $this->view_path = 'customers';
        $this->entity_name = 'customer';
        $this->collection_name = 'customers';
        $this->route_base = 'master-data/customers';
        $this->title_index = 'Master Data Pelanggan';
        $this->title_create = 'Tambah Pelanggan';
        $this->title_edit = 'Edit Pelanggan';
        parent::__construct();
        $this->require_role('admin');
    }

    protected function apply_validation_rules()
    {
        $this->form_validation->set_rules('name', 'Nama Pelanggan', 'trim|required');
        $this->form_validation->set_rules('phone', 'Nomor Telepon', 'trim');
        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email');
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/MY_CRUD_Controller.php';

class Categories extends MY_CRUD_Controller {
    public function __construct()
    {
        $this->model_name = 'Category_model';
        $this->view_path = 'categories';
        $this->entity_name = 'category';
        $this->collection_name = 'categories';
        $this->route_base = 'master-data/categories';
        $this->title_index = 'Master Data Kategori';
        $this->title_create = 'Tambah Kategori';
        $this->title_edit = 'Edit Kategori';
        parent::__construct();
    }

    protected function apply_validation_rules()
    {
        $this->form_validation->set_rules('name', 'Nama Kategori', 'trim|required');
    }
}

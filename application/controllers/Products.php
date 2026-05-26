<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/MY_CRUD_Controller.php';

class Products extends MY_CRUD_Controller {
    public function __construct()
    {
        $this->model_name = 'Product_model';
        $this->view_path = 'products';
        $this->entity_name = 'product';
        $this->collection_name = 'products';
        $this->route_base = 'master-data/products';
        $this->title_index = 'Master Data Produk';
        $this->title_create = 'Tambah Produk';
        $this->title_edit = 'Edit Produk';
        parent::__construct();
        $this->load->model('Category_model');
        $this->form_data['categories'] = $this->Category_model->get_all();
    }

    protected function apply_validation_rules()
    {
        $this->form_validation->set_rules('name', 'Nama Produk', 'trim|required');
        $this->form_validation->set_rules('category_id', 'Kategori', 'required');
        $this->form_validation->set_rules('price', 'Harga', 'required|numeric');
        $this->form_validation->set_rules('stock', 'Stok', 'required|integer');
    }
}

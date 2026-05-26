<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Product_model', 'Category_model']);
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data = [
            'title' => 'Data Produk',
            'products' => $this->Product_model->get_all(),
        ];
        $this->render('products/index', $data);
    }

    public function create()
    {
        $this->form_validation->set_rules('name', 'Nama Produk', 'trim|required');
        $this->form_validation->set_rules('category_id', 'Kategori', 'required');
        $this->form_validation->set_rules('price', 'Harga', 'required|numeric');
        $this->form_validation->set_rules('stock', 'Stok', 'required|integer');

        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title' => 'Tambah Produk',
                'categories' => $this->Category_model->get_all(),
                'product' => null,
            ];
            $this->render('products/form', $data);
            return;
        }

        $this->Product_model->insert($this->input->post());
        redirect('products');
    }

    public function edit($id = null)
    {
        $product = $this->Product_model->get_by_id($id);
        if (!$product) {
            show_404();
        }

        $this->form_validation->set_rules('name', 'Nama Produk', 'trim|required');
        $this->form_validation->set_rules('category_id', 'Kategori', 'required');
        $this->form_validation->set_rules('price', 'Harga', 'required|numeric');
        $this->form_validation->set_rules('stock', 'Stok', 'required|integer');

        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title' => 'Edit Produk',
                'categories' => $this->Category_model->get_all(),
                'product' => $product,
            ];
            $this->render('products/form', $data);
            return;
        }

        $this->Product_model->update($id, $this->input->post());
        redirect('products');
    }

    public function delete($id = null)
    {
        if ($id) {
            $this->Product_model->delete($id);
        }
        redirect('products');
    }
}

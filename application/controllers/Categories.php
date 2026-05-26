<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Category_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data = [
            'title' => 'Data Kategori',
            'categories' => $this->Category_model->get_all(),
        ];
        $this->render('categories/index', $data);
    }

    public function create()
    {
        $this->form_validation->set_rules('name', 'Nama Kategori', 'trim|required');

        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title' => 'Tambah Kategori',
                'category' => null,
            ];
            $this->render('categories/form', $data);
            return;
        }

        $this->Category_model->insert($this->input->post());
        redirect('categories');
    }

    public function edit($id = null)
    {
        $category = $this->Category_model->get_by_id($id);
        if (!$category) {
            show_404();
        }

        $this->form_validation->set_rules('name', 'Nama Kategori', 'trim|required');

        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title' => 'Edit Kategori',
                'category' => $category,
            ];
            $this->render('categories/form', $data);
            return;
        }

        $this->Category_model->update($id, $this->input->post());
        redirect('categories');
    }

    public function delete($id = null)
    {
        if ($id) {
            $this->Category_model->delete($id);
        }
        redirect('categories');
    }
}

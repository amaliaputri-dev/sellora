<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Product_model', 'Category_model', 'Customer_model', 'Transaction_model']);
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'product_count' => $this->Product_model->count_all(),
            'category_count' => $this->Category_model->count_all(),
            'customer_count' => $this->Customer_model->count_all(),
            'transaction_count' => $this->Transaction_model->count_all(),
            'recent_transactions' => $this->Transaction_model->get_recent(5),
        ];

        $this->render('dashboard/index', $data);
    }
}

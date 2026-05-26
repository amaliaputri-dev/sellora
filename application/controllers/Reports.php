<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->require_role('admin');
        $this->load->model('Transaction_model');
    }

    public function index()
    {
        $start = $this->input->get('start_date');
        $end = $this->input->get('end_date');

        $data = [
            'title' => 'Laporan Penjualan',
            'start_date' => $start,
            'end_date' => $end,
            'report' => $this->Transaction_model->get_report($start, $end),
        ];
        $this->render('reports/index', $data);
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transactions extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Product_model', 'Customer_model', 'Transaction_model']);
        $this->load->library('form_validation');
    }

    public function index()
    {
        $search = $this->input->get('search');
        $data = [
            'title' => 'Transaksi Kasir',
            'products' => $this->Product_model->search($search),
            'customers' => $this->Customer_model->get_all(),
            'cart' => $this->session->userdata('cart') ?: [],
            'search' => $search,
            'error' => $this->session->flashdata('error'),
        ];
        $this->render('transactions/index', $data);
    }

    public function add()
    {
        $product_id = $this->input->post('product_id');
        $quantity = max(1, (int) $this->input->post('quantity'));
        $product = $this->Product_model->get_by_id($product_id);

        if (!$product) {
            $this->session->set_flashdata('error', 'Produk tidak ditemukan.');
            redirect('transactions');
        }

        $cart = $this->session->userdata('cart') ?: [];
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
            ];
        }

        $this->session->set_userdata('cart', $cart);
        redirect('transactions');
    }

    public function remove($product_id)
    {
        $cart = $this->session->userdata('cart') ?: [];
        if (isset($cart[$product_id])) {
            unset($cart[$product_id]);
            $this->session->set_userdata('cart', $cart);
        }
        redirect('transactions');
    }

    public function clear()
    {
        $this->session->unset_userdata('cart');
        redirect('transactions');
    }

    public function checkout()
    {
        $cart = $this->session->userdata('cart') ?: [];
        if (empty($cart)) {
            $this->session->set_flashdata('error', 'Keranjang kosong.');
            redirect('transactions');
        }

        $this->form_validation->set_rules('customer_id', 'Pelanggan', 'required');
        $this->form_validation->set_rules('amount_paid', 'Bayar', 'required|numeric');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('transactions');
        }

        $customer_id = $this->input->post('customer_id');
        $amount_paid = (float) $this->input->post('amount_paid');
        $total = array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));

        if ($amount_paid < $total) {
            $this->session->set_flashdata('error', 'Jumlah bayar tidak mencukupi.');
            redirect('transactions');
        }

        $transaction_id = $this->Transaction_model->create_transaction([
            'customer_id' => $customer_id,
            'total' => $total,
            'paid' => $amount_paid,
            'change' => $amount_paid - $total,
            'user_id' => $this->session->userdata('user_id'),
        ], $cart);

        $this->session->unset_userdata('cart');
        redirect('transactions/receipt/' . $transaction_id);
    }

    public function receipt($id = null)
    {
        $transaction = $this->Transaction_model->get_by_id($id);
        if (!$transaction) {
            show_404();
        }

        $data = [
            'title' => 'Cetak Struk',
            'transaction' => $transaction,
            'items' => $this->Transaction_model->get_items($id),
        ];
        $this->render('transactions/receipt', $data);
    }

    public function history()
    {
        $data = [
            'title' => 'Riwayat Transaksi',
            'transactions' => $this->Transaction_model->get_all(),
        ];
        $this->render('transactions/history', $data);
    }
}

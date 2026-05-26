<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transactions extends MY_Controller {
    protected $cart_cookie = 'sellora_cart';

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Product_model', 'Customer_model', 'Transaction_model', 'User_model']);
        $this->load->library('form_validation');
    }

    public function index()
    {
        $search = $this->input->get('search');
        $data = [
            'title' => 'Transaksi Kasir',
            'products' => $this->Product_model->search($search),
            'customers' => $this->Customer_model->get_all(),
            'cart' => $this->get_cart(),
            'search' => $search,
            'error' => $this->input->get('error', TRUE),
        ];
        $this->render('transactions/index', $data);
    }

    public function add()
    {
        $product_id = $this->input->post('product_id');
        $quantity = max(1, (int) $this->input->post('quantity'));
        $product = $this->Product_model->get_by_id($product_id);

        if (!$product) {
            $this->redirect_with_error('Produk tidak ditemukan.');
        }

        $cart = $this->get_cart();
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

        $this->save_cart($cart);
        redirect('transaksi');
    }

    public function remove($product_id)
    {
        $cart = $this->get_cart();
        if (isset($cart[$product_id])) {
            unset($cart[$product_id]);
            $this->save_cart($cart);
        }
        redirect('transaksi');
    }

    public function clear()
    {
        delete_cookie($this->cart_cookie);
        redirect('transaksi');
    }

    public function checkout()
    {
        $cart = $this->get_cart();
        if (empty($cart)) {
            $this->redirect_with_error('Keranjang kosong.');
        }

        $this->form_validation->set_rules('customer_id', 'Pelanggan', 'required');
        $this->form_validation->set_rules('amount_paid', 'Bayar', 'required|numeric');

        if ($this->form_validation->run() === FALSE) {
            $this->redirect_with_error(trim(strip_tags(validation_errors(' ', ' '))));
        }

        $customer_id = $this->input->post('customer_id');
        $amount_paid = (float) $this->input->post('amount_paid');
        $total = array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));

        if ($amount_paid < $total) {
            $this->redirect_with_error('Jumlah bayar tidak mencukupi.');
        }

        $transaction_id = $this->Transaction_model->create_transaction([
            'customer_id' => $customer_id,
            'total' => $total,
            'paid' => $amount_paid,
            'change' => $amount_paid - $total,
            'user_id' => $this->get_default_user_id(),
        ], $cart);

        delete_cookie($this->cart_cookie);
        redirect('transaksi/struk/' . $transaction_id);
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

    protected function get_cart()
    {
        $raw_cart = $this->input->cookie($this->cart_cookie, TRUE);
        if (empty($raw_cart)) {
            return [];
        }

        $cart = json_decode($raw_cart, TRUE);
        return is_array($cart) ? $cart : [];
    }

    protected function save_cart(array $cart)
    {
        set_cookie([
            'name' => $this->cart_cookie,
            'value' => json_encode($cart),
            'expire' => 86400,
            'path' => '/',
            'httponly' => FALSE,
        ]);
    }

    protected function redirect_with_error($message)
    {
        redirect('transaksi?error=' . rawurlencode($message));
        exit;
    }

    protected function get_default_user_id()
    {
        if (!empty($this->current_user->id)) {
            return $this->current_user->id;
        }

        return $this->User_model->create_default_admin();
    }
}

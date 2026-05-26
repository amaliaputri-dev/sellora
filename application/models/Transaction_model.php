<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction_model extends CI_Model {
    protected $table = 'transactions';

    public function get_all()
    {
        $this->db->select('transactions.*, customers.name AS customer_name');
        $this->db->from($this->table);
        $this->db->join('customers', 'customers.id = transactions.customer_id', 'left');
        $this->db->order_by('transactions.id', 'DESC');
        return $this->db->get()->result();
    }

    public function count_all()
    {
        return $this->db->count_all($this->table);
    }

    public function get_recent($limit = 5)
    {
        $this->db->select('transactions.*, customers.name AS customer_name');
        $this->db->from($this->table);
        $this->db->join('customers', 'customers.id = transactions.customer_id', 'left');
        $this->db->order_by('transactions.id', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }

    public function get_by_id($id)
    {
        $this->db->select('transactions.*, customers.name AS customer_name');
        $this->db->from($this->table);
        $this->db->join('customers', 'customers.id = transactions.customer_id', 'left');
        $this->db->where('transactions.id', $id);
        return $this->db->get()->row();
    }

    public function get_items($transaction_id)
    {
        $this->db->select('transaction_items.*, products.name AS product_name');
        $this->db->from('transaction_items');
        $this->db->join('products', 'products.id = transaction_items.product_id', 'left');
        $this->db->where('transaction_items.transaction_id', $transaction_id);
        return $this->db->get()->result();
    }

    public function create_transaction($data, $cart)
    {
        $transaction = [
            'customer_id' => $data['customer_id'],
            'total' => $data['total'],
            'paid' => $data['paid'],
            'change' => $data['change'],
            'user_id' => $data['user_id'],
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $this->db->insert($this->table, $transaction);
        $transaction_id = $this->db->insert_id();

        foreach ($cart as $item) {
            $this->db->insert('transaction_items', [
                'transaction_id' => $transaction_id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'subtotal' => $item['price'] * $item['quantity'],
            ]);
        }

        return $transaction_id;
    }

    public function get_report($start = null, $end = null)
    {
        $this->db->select('transactions.*, customers.name AS customer_name');
        $this->db->from($this->table);
        $this->db->join('customers', 'customers.id = transactions.customer_id', 'left');

        if ($start) {
            $this->db->where('DATE(transactions.created_at) >=', $start);
        }
        if ($end) {
            $this->db->where('DATE(transactions.created_at) <=', $end);
        }

        $this->db->order_by('transactions.created_at', 'DESC');
        return $this->db->get()->result();
    }
}

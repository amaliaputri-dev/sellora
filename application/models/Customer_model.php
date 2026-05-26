<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_model extends CI_Model {
    protected $table = 'customers';

    public function get_all()
    {
        return $this->db->order_by('id', 'DESC')->get($this->table)->result();
    }

    public function count_all()
    {
        return $this->db->count_all($this->table);
    }

    public function get_by_id($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function get_or_create_general_customer_id()
    {
        $customer = $this->db->get_where($this->table, ['name' => 'Umum'])->row();
        if ($customer) {
            return $customer->id;
        }

        $this->db->insert($this->table, [
            'name' => 'Umum',
            'phone' => null,
            'email' => null,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return $this->db->insert_id();
    }

    public function insert($data)
    {
        $insert = [
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $this->db->insert($this->table, $insert);
    }

    public function update($id, $data)
    {
        $update = [
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
        ];
        $this->db->where('id', $id)->update($this->table, $update);
    }

    public function delete($id)
    {
        $this->db->delete($this->table, ['id' => $id]);
    }
}

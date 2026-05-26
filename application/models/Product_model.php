<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {
    protected $table = 'products';

    public function get_all()
    {
        $this->db->select('products.*, categories.name AS category_name');
        $this->db->from($this->table);
        $this->db->join('categories', 'categories.id = products.category_id', 'left');
        $this->db->order_by('products.id', 'DESC');
        return $this->db->get()->result();
    }

    public function count_all()
    {
        return $this->db->count_all($this->table);
    }

    public function get_by_id($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function insert($data)
    {
        $insert = [
            'name' => $data['name'],
            'category_id' => $data['category_id'],
            'price' => $data['price'],
            'stock' => $data['stock'],
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $this->db->insert($this->table, $insert);
    }

    public function update($id, $data)
    {
        $update = [
            'name' => $data['name'],
            'category_id' => $data['category_id'],
            'price' => $data['price'],
            'stock' => $data['stock'],
        ];
        $this->db->where('id', $id)->update($this->table, $update);
    }

    public function delete($id)
    {
        $this->db->delete($this->table, ['id' => $id]);
    }

    public function search($keyword = null)
    {
        $this->db->select('id, name, price, stock');
        $this->db->from($this->table);
        if ($keyword) {
            $this->db->group_start();
            $this->db->like('name', $keyword);
            $this->db->or_like('id', $keyword);
            $this->db->group_end();
        }
        $this->db->order_by('name', 'ASC');
        return $this->db->get()->result();
    }
}

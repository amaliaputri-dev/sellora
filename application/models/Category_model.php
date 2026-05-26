<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {
    protected $table = 'categories';

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

    public function insert($data)
    {
        $this->db->insert($this->table, [
            'name' => $data['name'],
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id)->update($this->table, ['name' => $data['name']]);
    }

    public function delete($id)
    {
        $this->db->delete($this->table, ['id' => $id]);
    }
}

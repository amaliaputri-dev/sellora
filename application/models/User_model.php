<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    protected $table = 'users';

    public function get_by_username($username)
    {
        return $this->db->get_where($this->table, ['username' => $username])->row();
    }

    public function create_default_admin()
    {
        $default = $this->db->get($this->table)->row();
        if ($default) {
            return $default->id;
        }

        $data = [
            'username' => 'admin',
            'password' => password_hash('admin123', PASSWORD_DEFAULT),
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
}

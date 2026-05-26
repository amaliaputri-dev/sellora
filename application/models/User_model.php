<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    protected $table = 'users';

    public function __construct()
    {
        parent::__construct();
        $this->ensure_role_column();
    }

    public function get_by_username($username)
    {
        return $this->db->get_where($this->table, ['username' => $username])->row();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function get_all()
    {
        return $this->db->order_by('id', 'DESC')->get($this->table)->result();
    }

    public function count_admins()
    {
        return (int) $this->db->where('role', 'admin')->count_all_results($this->table);
    }

    public function insert($data)
    {
        $this->db->insert($this->table, [
            'username' => $data['username'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'role' => $data['role'],
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public function update($id, $data)
    {
        $update = [
            'username' => $data['username'],
            'role' => $data['role'],
        ];

        if (!empty($data['password'])) {
            $update['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        $this->db->where('id', $id)->update($this->table, $update);
    }

    public function delete($id)
    {
        $this->db->delete($this->table, ['id' => $id]);
    }

    public function create_default_users()
    {
        $admin = $this->get_by_username('admin');
        if (!$admin) {
            $this->db->insert($this->table, [
                'username' => 'admin',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'role' => 'admin',
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            $admin = $this->get_by_username('admin');
        }

        $kasir = $this->get_by_username('kasir');
        if (!$kasir) {
            $this->db->insert($this->table, [
                'username' => 'kasir',
                'password' => password_hash('kasir123', PASSWORD_DEFAULT),
                'role' => 'kasir',
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

        return $admin ? $admin->id : 0;
    }

    public function create_default_admin()
    {
        return $this->create_default_users();
    }

    protected function ensure_role_column()
    {
        if ($this->db->field_exists('role', $this->table)) {
            return;
        }

        $this->db->query("ALTER TABLE `{$this->table}` ADD `role` VARCHAR(20) NOT NULL DEFAULT 'admin' AFTER `password`");
    }
}

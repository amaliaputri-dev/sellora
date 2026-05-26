<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->require_role('admin');
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data = [
            'title' => 'Manajemen User',
            'users' => $this->User_model->get_all(),
            'message' => $this->input->get('message', TRUE),
        ];

        $this->render('users/index', $data);
    }

    public function create()
    {
        $this->set_form_rules(TRUE);

        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title' => 'Tambah User',
                'user_item' => null,
            ];
            $this->render('users/form', $data);
            return;
        }

        $this->User_model->insert($this->input->post(NULL, TRUE));
        redirect('akun/users?message=' . rawurlencode('User berhasil ditambahkan.'));
    }

    public function edit($id = null)
    {
        $user = $this->User_model->get_by_id($id);
        if (!$user) {
            show_404();
        }

        $this->set_form_rules(FALSE, $id);

        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title' => 'Edit User',
                'user_item' => $user,
            ];
            $this->render('users/form', $data);
            return;
        }

        $posted = $this->input->post(NULL, TRUE);
        if ((int) $user->id === (int) $this->current_user->id && $posted['role'] !== 'admin') {
            $data = [
                'title' => 'Edit User',
                'user_item' => $user,
                'custom_error' => 'Akun yang sedang dipakai harus tetap berperan admin.',
            ];
            $this->render('users/form', $data);
            return;
        }

        if ($user->role === 'admin' && $posted['role'] !== 'admin' && $this->User_model->count_admins() <= 1) {
            $data = [
                'title' => 'Edit User',
                'user_item' => $user,
                'custom_error' => 'Minimal harus ada satu admin.',
            ];
            $this->render('users/form', $data);
            return;
        }

        $this->User_model->update($id, $posted);
        redirect('akun/users?message=' . rawurlencode('User berhasil diperbarui.'));
    }

    public function delete($id = null)
    {
        $user = $this->User_model->get_by_id($id);
        if (!$user) {
            show_404();
        }

        if ((int) $user->id === (int) $this->current_user->id) {
            redirect('akun/users?message=' . rawurlencode('User yang sedang login tidak bisa dihapus.'));
        }

        if ($user->role === 'admin' && $this->User_model->count_admins() <= 1) {
            redirect('akun/users?message=' . rawurlencode('Admin terakhir tidak bisa dihapus.'));
        }

        $this->User_model->delete($id);
        redirect('akun/users?message=' . rawurlencode('User berhasil dihapus.'));
    }

    protected function set_form_rules($is_create = TRUE, $id = null)
    {
        $username_rule = 'trim|required|min_length[3]|is_unique[users.username]';
        if (!$is_create && $id) {
            $username_rule = 'trim|required|min_length[3]|callback_unique_username['.$id.']';
        }

        $this->form_validation->set_rules('username', 'Username', $username_rule);
        $this->form_validation->set_rules('role', 'Role', 'required|in_list[admin,kasir]');

        if ($is_create) {
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
        } else {
            $this->form_validation->set_rules('password', 'Password', 'trim|min_length[6]');
        }
    }

    public function unique_username($username, $id)
    {
        $existing = $this->User_model->get_by_username($username);
        if ($existing && (int) $existing->id !== (int) $id) {
            $this->form_validation->set_message('unique_username', 'Username sudah dipakai.');
            return FALSE;
        }

        return TRUE;
    }
}

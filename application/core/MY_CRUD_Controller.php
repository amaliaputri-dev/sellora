<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_CRUD_Controller extends MY_Controller {
    protected $model_name = '';
    protected $view_path = '';
    protected $entity_name = '';
    protected $collection_name = '';
    protected $route_base = '';
    protected $title_index = '';
    protected $title_create = '';
    protected $title_edit = '';
    protected $form_data = [];

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model($this->model_name);
    }

    public function index()
    {
        $data = [
            'title' => $this->title_index,
            $this->get_collection_name() => $this->get_model()->get_all(),
        ];

        $this->render($this->view_path.'/index', $this->extend_form_data($data));
    }

    public function create()
    {
        $this->apply_validation_rules();

        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title' => $this->title_create,
                $this->entity_name => null,
            ];
            $this->render($this->view_path.'/form', $this->extend_form_data($data));
            return;
        }

        $this->get_model()->insert($this->sanitize_input($this->input->post(NULL, TRUE)));
        redirect($this->route_base);
    }

    public function edit($id = null)
    {
        $entity = $this->get_model()->get_by_id($id);
        if (!$entity) {
            show_404();
        }

        $this->apply_validation_rules();

        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title' => $this->title_edit,
                $this->entity_name => $entity,
            ];
            $this->render($this->view_path.'/form', $this->extend_form_data($data));
            return;
        }

        $this->get_model()->update($id, $this->sanitize_input($this->input->post(NULL, TRUE)));
        redirect($this->route_base);
    }

    public function delete($id = null)
    {
        if ($id) {
            $this->get_model()->delete($id);
        }

        redirect($this->route_base);
    }

    protected function get_model()
    {
        return $this->{$this->model_name};
    }

    protected function get_collection_name()
    {
        if ($this->collection_name !== '') {
            return $this->collection_name;
        }

        return $this->entity_name.'s';
    }

    protected function extend_form_data(array $data)
    {
        return array_merge($data, $this->form_data);
    }

    protected function sanitize_input($data)
    {
        return is_array($data) ? $data : [];
    }

    protected function apply_validation_rules()
    {
    }
}

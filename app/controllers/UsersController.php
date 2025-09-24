<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: UsersController
 * 
 * Automatically generated via CLI.
 */
class UsersController extends Controller {
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect(site_url('login'));
        }

        $this->call->model('UsersModel');
        $this->UsersModel->db->raw("CREATE TABLE IF NOT EXISTS students (id INTEGER PRIMARY KEY AUTOINCREMENT, first_name TEXT, last_name TEXT, email TEXT)");

        $search = $this->io->get('search') ?: '';
        $page = $this->io->get('page') ?: 1;
        $per_page = 5;

        $conditions = [];
        if (!empty($search)) {
            $conditions = [
                'first_name LIKE' => '%' . $search . '%',
                'OR last_name LIKE' => '%' . $search . '%',
                'OR email LIKE' => '%' . $search . '%'
            ];
        }

        $pagination = $this->UsersModel->paginate($per_page, $page, $conditions);

        $data['users'] = $pagination['data'];
        $data['pagination'] = $pagination;
        $data['search'] = $search;
        $data['page'] = $page;

        $this->call->view('users/index', $data);
    }

    function create(){
        if (!$this->session->userdata('logged_in')) {
            redirect(site_url('login'));
        }

        if($this->io->method() == 'post'){
            $first_name = $this->io->post('first_name');
            $last_name = $this->io->post('last_name');
            $email = $this->io->post('email');

            $data = [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email
            ];

            if($this->UsersModel->insert($data)){
                redirect(site_url(''));
            }else{
                echo "Error in creating user.";
            }

        }else{
            $this->call->view('users/create');
        }
    }

    function update($id){
        if (!$this->session->userdata('logged_in')) {
            redirect(site_url('login'));
        }

        $user = $this->UsersModel->find($id);
        if(!$user){
            echo "User not found.";
            return;
        }

        if($this->io->method() == 'post'){
            $first_name = $this->io->post('first_name');
            $last_name = $this->io->post('last_name');
            $email = $this->io->post('email');

            $data = [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email
            ];

            if($this->UsersModel->update($id, $data)){
                redirect();
            }else{
                echo "Error in updating user.";
            }
        }else{
            $data['user'] = $user;
            $this->call->view('users/update', $data);
        }
    }

    function delete($id){
        if (!$this->session->userdata('logged_in')) {
            redirect(site_url('login'));
        }

        if($this->UsersModel->delete($id)){
            redirect();
        }else{
            echo "Error in deleting user.";
        }
    }
}
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
        $this->call->model('UsersModel');
        $this->UsersModel->db->raw("CREATE TABLE IF NOT EXISTS users (id INTEGER PRIMARY KEY AUTOINCREMENT, first_name TEXT, last_name TEXT, email TEXT)");

        // Handle POST request for adding or updating user
        if($this->io->method() == 'post'){
            $user_id = $this->io->post('user_id'); // For updates
            $first_name = $this->io->post('first_name');
            $last_name = $this->io->post('last_name');
            $email = $this->io->post('email');

            $data = [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email
            ];

            if($user_id){
                // Update existing user
                if($this->UsersModel->update($user_id, $data)){
                    $current_page = $this->io->get('page') ?: 1;
                    redirect(site_url('?page=' . $current_page));
                }else{
                    echo "Error in updating user.";
                }
            }else{
                // Add new user
                if($this->UsersModel->insert($data)){
                    // Redirect to last page to show newly added user at the end
                    $totalUsers = $this->UsersModel->count();
                    $per_page = 10;
                    $lastPage = ceil($totalUsers / $per_page);
                    redirect(site_url('?page=' . $lastPage));
                }else{
                    echo "Error in creating user.";
                }
            }
            return;
        }

        // Seed dataset if empty
        $count = $this->UsersModel->count();
        if ($count < 26) {
            // Clear existing data to ensure clean IDs starting from 1
            $this->UsersModel->db->raw("DELETE FROM users");
            $this->UsersModel->db->raw("DELETE FROM sqlite_sequence WHERE name='users'"); // Reset autoincrement
            $seedData = [
                ['first_name' => 'Alice', 'last_name' => 'Wonder', 'email' => 'alice@example.com'],
                ['first_name' => 'Bob', 'last_name' => 'Builder', 'email' => 'bob@example.com'],
                ['first_name' => 'Charlie', 'last_name' => 'Chocolate', 'email' => 'charlie@example.com'],
                ['first_name' => 'Daisy', 'last_name' => 'Duck', 'email' => 'daisy@example.com'],
                ['first_name' => 'Eve', 'last_name' => 'Online', 'email' => 'eve@example.com'],
                ['first_name' => 'Frank', 'last_name' => 'Ocean', 'email' => 'frank@example.com'],
                ['first_name' => 'Grace', 'last_name' => 'Hopper', 'email' => 'grace@example.com'],
                ['first_name' => 'Hank', 'last_name' => 'Hill', 'email' => 'hank@example.com'],
                ['first_name' => 'Ivy', 'last_name' => 'League', 'email' => 'ivy@example.com'],
                ['first_name' => 'Jack', 'last_name' => 'Sparrow', 'email' => 'jack@example.com'],
                ['first_name' => 'Kara', 'last_name' => 'Zor-El', 'email' => 'kara@example.com'],
                ['first_name' => 'Liam', 'last_name' => 'Neeson', 'email' => 'liam@example.com'],
                ['first_name' => 'Mia', 'last_name' => 'Wallace', 'email' => 'mia@example.com'],
                ['first_name' => 'Nina', 'last_name' => 'Simone', 'email' => 'nina@example.com'],
                ['first_name' => 'Oscar', 'last_name' => 'Wilde', 'email' => 'oscar@example.com'],
                ['first_name' => 'Paul', 'last_name' => 'McCartney', 'email' => 'paul@example.com'],
                ['first_name' => 'Quinn', 'last_name' => 'Fabray', 'email' => 'quinn@example.com'],
                ['first_name' => 'Rachel', 'last_name' => 'Green', 'email' => 'rachel@example.com'],
                ['first_name' => 'Sam', 'last_name' => 'Wilson', 'email' => 'sam@example.com'],
                ['first_name' => 'Taylor', 'last_name' => 'Swift', 'email' => 'taylor@example.com'],
                ['first_name' => 'Uma', 'last_name' => 'Thurman', 'email' => 'uma@example.com'],
                ['first_name' => 'Victor', 'last_name' => 'Hugo', 'email' => 'victor@example.com'],
                ['first_name' => 'Wanda', 'last_name' => 'Maximoff', 'email' => 'wanda@example.com'],
                ['first_name' => 'Xavier', 'last_name' => 'Charles', 'email' => 'xavier@example.com'],
                ['first_name' => 'Yara', 'last_name' => 'Shahidi', 'email' => 'yara@example.com'],
                ['first_name' => 'Zoe', 'last_name' => 'Saldana', 'email' => 'zoe@example.com'],
            ];
            foreach ($seedData as $user) {
                $this->UsersModel->insert($user);
            }
        }

        $search = $this->io->get('search') ?: '';
        $page = $this->io->get('page') ?: 1; // 1-based for pagination
        $per_page = 10;

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

    function delete($id){
        if($this->UsersModel->delete($id)){
            redirect();
        }else{
            echo "Error in deleting user.";
        }
    }
}
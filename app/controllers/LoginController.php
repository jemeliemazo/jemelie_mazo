<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: LoginController
 */
class LoginController extends Controller {
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->session->userdata('logged_in')) {
            redirect(site_url(''));
        }
        $this->call->view('login');
    }

    public function authenticate()
    {
        if ($this->io->method() == 'post') {
            $username = $this->io->post('username');
            $password = $this->io->post('password');

            // Simple hardcoded auth
            if ($username == 'admin' && $password == 'admin123') {
                $this->session->set_userdata('logged_in', true);
                redirect(site_url(''));
            } else {
                $data['error'] = 'Invalid credentials';
                $this->call->view('login', $data);
            }
        } else {
            redirect(site_url('login'));
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(site_url('login'));
    }
}

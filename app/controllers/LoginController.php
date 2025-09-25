<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: LoginController
 *
 * Automatically generated via CLI.
 */
class LoginController extends Controller {
    public function __construct()
    {
        parent::__construct();
    }

    public function logout()
    {
        // Destroy session if any
        session_destroy();
        // Redirect to home
        redirect('/');
    }
}

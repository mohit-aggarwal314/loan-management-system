<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function register() {
        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
            
            if ($this->form_validation->run() == TRUE) {
                $data = [
                    'name' => $this->input->post('name'),
                    'email' => $this->input->post('email'),
                    'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                    'role' => 'customer'
                ];
                $this->User_model->register($data);
                $this->session->set_flashdata('success', 'Registered successfully. Please login.');
                redirect('auth/login');
            }
        }
        $this->load->view('auth/register');
    }

    public function login() {
        if ($this->input->post()) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $user = $this->User_model->getUserByEmail($email);

            if ($user && password_verify($password, $user->password)) {
                $this->session->set_userdata('user', $user);
                redirect($user->role == 'admin' ? 'admin/dashboard' : 'customer/dashboard');
            } else {
                $this->session->set_flashdata('error', 'Invalid credentials');
            }
        }
        $this->load->view('auth/login');
    }

    public function logout() {
        $this->session->unset_userdata('user');
        redirect('auth/login');
    }
}

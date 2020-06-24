<?php

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('User_model');
    }

    public function index()
    {
        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] == 1) {
                redirect(base_url('admin'));
            } elseif ($_SESSION['role'] == 2) {
                redirect(base_url('staff'));
            } else {
                echo 'problem';
            }
        } else {
            //variable
            $data['systemname'] = "SIMORG";
            //form validation
            $this->form_validation->set_rules('id', 'Id', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            //form validation
            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header', $data);
                $this->load->view('auth/index');
                $this->load->view('templates/footer');
            } else {
                //call private function login
                $this->_login();
            }
        }
    }

    //private function login
    private function _login()
    {


        //input
        $id = $this->input->post('id');
        $password = $this->input->post('password');


        $user = $this->User_model->getSignin($id);
        if ($user) {
            if ($password == $user['usr_password']) {
                $data = [
                    'id' => $user['usr_id'],
                    'role' => $user['role_id'],
                    'storeid' => $user['store_id']
                ];
                $this->session->set_userdata($data);

                if ($data['role'] == '2') {
                    redirect(base_url('staff'));
                } elseif ($data['role'] == '1') {
                    redirect(base_url('admin'));
                } else {
                    echo 'something problem';
                    echo $data['role'];
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong Password!</div>');
                redirect(base_url('user'));
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">This user is not registered!</div>');
            redirect(base_url('user'));
        }
    }

    //public function logout
    public function logout()
    {

        unset($_SESSION['id'],
        $_SESSION['role']);
        session_write_close();
        redirect(base_url());
    }
}

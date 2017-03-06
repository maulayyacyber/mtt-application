<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package  : Medical Top Team.
 * @author   : Fika Ridaul Maulayya <ridaulmaulayya@gmail.com>
 * @since    : 2017
 * @license  : https://maulayya.com/portofolio/medical-top-team/
 */
class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //load library
        $this->load->library('form_validation');
        //load model
        $this->load->model('apps');
    }

    public function index()
    {
        if($this->apps->apps_id())
        {
            //redirect dahsboard
            redirect('apps/dashboard/');

        }else {

            //check dengan form validation
            $this->form_validation->set_rules('username', 'Username', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            $this->form_validation->set_message('required', '<div class="alert alert-danger alert-dismissible">
                                                                {field} is required.
                                                              </div>');
            if ($this->form_validation->run() == TRUE) {
                $username = $this->input->post("username", TRUE);
                $password = SHA1(MD5(MD5(SHA1($this->input->post('password', TRUE)))));
                //checking data via model
                $checking = $this->apps->check_all('tbl_users', array('username' => $username), array('password' => $password));
                //jika ditemukan, maka create session
                if ($checking != FALSE) {
                    foreach ($checking as $apps) {

                        $session_data = array(
                            'apps_id' => $apps->id_user,
                            'apps_username' => $apps->username,
                            'apps_nama' => $apps->nama_user,
                            'apps_email' => $apps->email_user,
                            'apps_foto' => $apps->foto_user
                        );
                        //create session kcfinder
                        session_start();
                        $_SESSION['ses_kcfinder']=array();
                        $_SESSION['ses_kcfinder']['disabled'] = false;
                        $_SESSION['ses_kcfinder']['uploadURL'] = "../../content_upload";
                        //set session userdata
                        $this->session->set_userdata($session_data);
                        redirect('apps/dashboard/');
                    }
                } else {
                    //create data array
                    $data = array(
                        'error' => '<div class="alert alert-danger alert-dismissible">
                                      Username or Password is wrong
                                    </div>',
                        'title' => 'Login &rsaquo; Machine Development.'
                    );
                    $this->load->view('apps/layout/auth/login', $data);
                }
            } else {
                //create data array
                $data = array(
                    'title' => 'Login &rsaquo; Machine Development.'
                );
                $this->load->view('apps/layout/auth/login', $data);
            }

        }
    }

    public function forgot()
    {
        if($this->apps->apps_id())
        {
            redirect('apps/dashboard/');
        }else{
            //get form input
            $email_address = $check_video  = $this->apps->check_one('tbl_users', array('email_user' => $this->input->post("email")));
            //set form validation
            $this->form_validation->set_rules('email', 'Email Address', 'trim|required');
            $this->form_validation->set_message('required', '<div class="alert alert-danger alert-dismissible">
                                                                {field} is required.
                                                              </div>');
            if($this->form_validation->run() == TRUE)
            {
                if($email_address != FALSE)
                {

                }else{
                    $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-exclamation-circle"></i> Error! email tidak terdaftar.
			                                                </div>');
                    //redirect halaman
                    redirect('apps/login/forgot?source=send&utf8=✓');
                }
            }else{
                $this->load->view('apps/layout/auth/forgot');
            }
        }

    }

}

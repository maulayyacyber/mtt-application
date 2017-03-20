<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package  : Medical Top Team.
 * @author   : Fika Ridaul Maulayya <ridaulmaulayya@gmail.com>
 * @since    : 2017
 * @license  : https://maulayya.com/portofolio/medical-top-team/
 */
class Contact extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        //load model
        $this->load->model('web');
    }

    public function index()
    {
        //creat data array
        $data = array(
            'title'     => 'Contact Us',
            'contact' => TRUE,
        );
        $this->load->view('home/part/header', $data);
        $this->load->view('home/layout/contact/data');
        $this->load->view('home/part/footer');
    }
}
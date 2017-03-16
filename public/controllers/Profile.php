<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package  : Medical Top Team.
 * @author   : Fika Ridaul Maulayya <ridaulmaulayya@gmail.com>
 * @since    : 2017
 * @license  : https://maulayya.com/portofolio/medical-top-team/
 */
class Profile extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        //load model
        $this->load->model('web');
    }

    public function sejarah()
    {
        //creat data array
        $data = array(
            'profile' => TRUE,
            'sejarah' => TRUE,
        );
        $this->load->view('home/part/header', $data);
        $this->load->view('home/layout/profile/data');
        $this->load->view('home/part/footer');
    }

    public function arti_logo()
    {
        //creat data array
        $data = array(
            'profile'   => TRUE,
            'arti_logo' => TRUE,
        );
        $this->load->view('home/part/header', $data);
        $this->load->view('home/layout/profile/data');
        $this->load->view('home/part/footer');
    }

    public function visi_misi()
    {
        //creat data array
        $data = array(
            'profile'   => TRUE,
            'visi_misi' => TRUE,
        );
        $this->load->view('home/part/header', $data);
        $this->load->view('home/layout/profile/data');
        $this->load->view('home/part/footer');
    }

    public function struktur_organisasi()
    {
        //creat data array
        $data = array(
            'profile'             => TRUE,
            'struktur_organisasi' => TRUE,
        );
        $this->load->view('home/part/header', $data);
        $this->load->view('home/layout/profile/data');
        $this->load->view('home/part/footer');
    }

}
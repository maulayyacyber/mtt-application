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
        //get visitor
        $this->web->counter_visitor();
    }

    public function sejarah()
    {
        //creat data array
        $data = array(
            'title'     => 'Sejarah',
            'keywords'         => systems('keywords'),
            'descriptions'     => systems('descriptions'),
            'profile' => TRUE,
            'sejarah' => TRUE,
            'data_pages'=> $this->web->get_pages(2),
            'articles_terbaru' => $this->web->articles_terbaru(),
        );
        $this->load->view('home/part/header', $data);
        $this->load->view('home/layout/profile/data');
        $this->load->view('home/part/footer');
    }

    public function arti_logo()
    {
        //creat data array
        $data = array(
            'title'     => 'Arti Logo',
            'keywords'         => systems('keywords'),
            'descriptions'     => systems('descriptions'),
            'profile'   => TRUE,
            'arti_logo' => TRUE,
            'data_pages'=> $this->web->get_pages(3),
            'articles_terbaru' => $this->web->articles_terbaru(),
        );
        $this->load->view('home/part/header', $data);
        $this->load->view('home/layout/profile/data');
        $this->load->view('home/part/footer');
    }

    public function visi_misi()
    {
        //creat data array
        $data = array(
            'title'     => 'Visi dan Misi',
            'keywords'         => systems('keywords'),
            'descriptions'     => systems('descriptions'),
            'profile'   => TRUE,
            'visi_misi' => TRUE,
            'data_pages'=> $this->web->get_pages(1),
            'articles_terbaru' => $this->web->articles_terbaru(),
        );
        $this->load->view('home/part/header', $data);
        $this->load->view('home/layout/profile/data');
        $this->load->view('home/part/footer');
    }

    public function struktur_organisasi()
    {
        //creat data array
        $data = array(
            'title'     => 'Struktur Organisasi',
            'keywords'         => systems('keywords'),
            'descriptions'     => systems('descriptions'),
            'profile'             => TRUE,
            'struktur_organisasi' => TRUE,
            'data_pages'=> $this->web->get_pages(4),
            'articles_terbaru' => $this->web->articles_terbaru(),
        );
        $this->load->view('home/part/header', $data);
        $this->load->view('home/layout/profile/data');
        $this->load->view('home/part/footer');
    }

}
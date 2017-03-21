<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package  : Medical Top Team.
 * @author   : Fika Ridaul Maulayya <ridaulmaulayya@gmail.com>
 * @since    : 2017
 * @license  : https://maulayya.com/portofolio/medical-top-team/
 */
class Systems extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        //load model
        $this->load->model('apps');
    }

    public function index()
    {
        if ($this->apps->apps_id()) {

            $data = array(
                'title' => 'Setting Systems ',
                'systems' => TRUE
            );
            $this->load->view('apps/part/header', $data);
            $this->load->view('apps/part/sidebar');
            $this->load->view('apps/layout/systems/data');
            $this->load->view('apps/part/footer');

        } else {
            show_404();
            return FALSE;
        }
    }

    public function save()
    {
        if($this->apps->apps_id())
        {
            $id['id_system'] = $this->encryption->decode($this->input->post('id_system'));
            //create var update array
            $update = array(
                'admin_title'   => $this->input->post('admin_title'),
                'admin_footer'  => $this->input->post('admin_footer'),
                'site_title'    => $this->input->post('site_title'),
                'site_footer'   => $this->input->post('site_footer'),
                'about_me'      => $this->input->post('about_me'),
                'alamat'        => $this->input->post('alamat'),
                'no_telp'       => $this->input->post('no_telp'),
                'no_telp2'      => $this->input->post('no_telp2'),
                'keywords'      => $this->input->post('keywords'),
                'descriptions'  => $this->input->post('descriptions')
            );
            $this->db->update('tbl_systems', $update, $id);
            $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-check"></i> Sistem Berhasil Diupdate.
			                                                </div>');
            redirect('apps/systems?source=update&utf8=✓');
        }else{
            show_404();
            return FALSE;
        }
    }

}
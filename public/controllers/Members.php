<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package  : Medical Top Team.
 * @author   : Fika Ridaul Maulayya <ridaulmaulayya@gmail.com>
 * @since    : 2017
 * @license  : https://maulayya.com/portofolio/medical-top-team/
 */
class Members extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        //load model
        $this->load->model('web');
    }

    public function index()
    {
        //config pagination
        $config['base_url'] = base_url().'members/index/';
        $config['total_rows'] = $this->web->count_members()->num_rows();
        $config['per_page'] = 10;
        //instalasi paging
        $this->pagination->initialize($config);
        //deklare halaman
        $halaman            =  $this->uri->segment(3);
        $halaman            =  $halaman == '' ? 0 : $halaman;
        //create data array
        $data = array(
            'title'           => 'Members ',
            'members'         => TRUE,
            'data_members'    => $this->web->index_members($halaman,$config['per_page']),
            'paging'          => $this->pagination->create_links()
        );
        if($data['data_members'] != NULL)
        {
            $data['members'] = $data['data_members'];
        }else{
            $data['members'] = NULL;
        }
        //load views
        $this->load->view('home/part/header', $data);
        $this->load->view('home/layout/members/data');
        $this->load->view('home/part/footer');
    }

    public function search()
    {
        $limit = 10;
        $this->load->helper('security');
        $keyword = $this->security->xss_clean($_GET['q']);
        $data['keyword'] = strip_tags($keyword);
        $check = strlen(preg_replace('/[^a-zA-Z]/', '', $keyword));
        if(!empty($keyword) && $check > 2)
        {
            $offset = (isset($_GET['page'])) ? $this->security->xss_clean($_GET['page']) : 0 ;
            $total  = $this->web->total_search_members($keyword);
            //config pagination
            $config['base_url'] = base_url().'members/search?q='.$keyword;
            $config['total_rows'] = $total;
            $config['per_page'] = $limit;
            $config['page_query_string'] = TRUE;
            $config['use_page_numbers'] = TRUE;
            $config['display_pages']	= TRUE;
            $config['query_string_segment'] = 'page';
            $config['uri_segment']  = 3;
            //instalasi paging
            $this->pagination->initialize($config);

            $data = array(
                'title'         => 'Members',
                'members'      => TRUE,
                'data_members' => $this->web->search_index_members(strip_tags($keyword),$limit,$offset),
                'paging'        => $this->pagination->create_links()
            );
            if($data['data_members'] != NULL)
            {
                $data['members'] = $data['data_members'];
            }else{
                $data['members'] = '';
            }
            //load views
            $this->load->view('home/part/header', $data);
            $this->load->view('home/layout/members/data');
            $this->load->view('home/part/footer');
        }else{
            redirect('members/');
        }
    }

}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package  : Medical Top Team.
 * @author   : Fika Ridaul Maulayya <ridaulmaulayya@gmail.com>
 * @since    : 2017
 * @license  : https://maulayya.com/portofolio/medical-top-team/
 */
class Events extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        //load model
        $this->load->model(array('web','apps'));
        //get visitor
        $this->web->counter_visitor();
    }

    public function index()
    {
        //creat data array
        $data = array(
            'title'     => 'Events',
            'keywords'         => systems('keywords'),
            'descriptions'     => systems('descriptions'),
            'events' => TRUE
        );
        $this->load->view('home/part/header', $data);
        $this->load->view('home/layout/events/data');
        $this->load->view('home/part/footer');
    }

    public function search()
    {
        $limit = 12;
        $this->load->helper('security');
        $keyword = $this->security->xss_clean($_GET['q']);
        $data['keyword'] = strip_tags($keyword);
        $check = strlen(preg_replace('/[^a-zA-Z]/', '', $keyword));
        if(!empty($keyword) && $check > 2)
        {
            $offset = (isset($_GET['page'])) ? $this->security->xss_clean($_GET['page']) : 0 ;
            $total  = $this->web->total_search_events($keyword);
            //config pagination
            $config['base_url'] = base_url().'events/search?q='.$keyword;
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
                'title'         => 'Events',
                'keywords'         => systems('keywords'),
                'descriptions'     => systems('descriptions'),
                'events'        => TRUE,
                'data_events'   => $this->web->search_index_events(strip_tags($keyword),$limit,$offset),
                'paging'        => $this->pagination->create_links()
            );
            if($data['data_events'] != NULL)
            {
                $data['events'] = $data['data_events'];
            }else{
                $data['events'] = '';
            }
            //load view with data
            $this->load->view('home/part/header', $data);
            $this->load->view('home/layout/events/search');
            $this->load->view('home/part/footer');
        }else{
            redirect('events/');
        }
    }

    public function detail($url)
    {
       //echo  $this->uri->segment(3);die();
        //library disqus
        $this->load->library('disqus');

        $data = array(
            'events'           => TRUE,
            'detail_events'    => $this->web->detail_events($url),
            'title'            => $this->web->detail_events($url)->judul_event,
            'keywords'         => $this->web->detail_events($url)->meta_keywords,
            'descriptions'     => $this->web->detail_events($url)->meta_descriptions,
            'author'           => $this->web->detail_events($url)->nama_user,
            'disqus'           => $this->disqus->get_html()
        );
        //load view
        $this->load->view('home/part/header', $data);
        $this->load->view('home/layout/events/detail');
        $this->load->view('home/part/footer');
    }

    public function join($id)
    {
        if($this->session->userdata("member_id"))
        {
            $id = $this->encryption->decode($id);
            $query = $this->db->query("SELECT id_event,judul_event FROM tbl_events WHERE id_event = '$id'");
            $row   = $query->row();

            $data = array(
                'id_event'          => $id,
                'select_panitia'    => $this->web->select_panitia(),
                'nama_event'        => $row->judul_event
            );

            $this->load->view('home/layout/events/form', $data);

        }else{
            redirect('members/login/');
        }


    }

    public function save()
    {
        $check_user  = $this->apps->check_one('tbl_users_events', array('user_id' => $this->session->userdata('member_id')));
        $check_event = $this->apps->check_one('tbl_users_events', array('event_id' => $this->encryption->decode($this->input->post("event_id"))));

        if($check_user && $check_event != FALSE)
        {
            $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-exclamation-circle"></i> Error! Anda sudah terdaftar di event ini.
			                                                </div>');
            //redirect halaman
            redirect('events?source=error&utf8=✓');
        }else{
            $insert = array(
                'event_id'      => $this->encryption->decode($this->input->post("event_id")),
                'user_id'       => $this->session->userdata('member_id'),
                'panitia_id'    => $this->input->post("panitia_id"),
                'status'        => '0',
                'tgl_register'  => date("Y-m-d H:i:s")
            );
            //insert db
            $this->db->insert("tbl_users_events", $insert);

            echo $this->db->error();die();
             
            //create session flashdata
            $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-check"></i> Pendaftaran event berhasil, silahkan lakukan pembayaran ticket.
			                                                </div>');
            //redirect halaman
            redirect('events?source=join&utf8=✓');

        }
    }

    public function data()
    {
         
        $this->load->library('Datatables');
        $this->datatables->select('d.judul_event, a.event_id, b.nama, c.nama_panitia, a.status')
        ->unset_column('id_user_event')
        ->from('tbl_users_events a')
        ->join('tbl_members b', 'a.user_id = b.id_member')
        ->join('tbl_panitia c', 'a.panitia_id = c.id_panitia')
        ->join('tbl_events d', 'a.event_id = d.id_event');
        echo $this->datatables->generate(); 
    }

    public function datawithVariable()
    {
        $id = $this->input->post('id');  
        $this->load->library('Datatables');
        $this->datatables->select('d.judul_event, a.event_id, b.nama, c.nama_panitia, a.status')
        ->unset_column('id_user_event')
        ->from('tbl_users_events a')
        ->join('tbl_members b', 'a.user_id = b.id_member')
        ->join('tbl_panitia c', 'a.panitia_id = c.id_panitia')
        ->join('tbl_events d', 'a.event_id = d.id_event')
        ->where('a.event_id', $id);
        echo $this->datatables->generate();
        
    }

}
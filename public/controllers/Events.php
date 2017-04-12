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
        $id = $this->encryption->decode($id);
        $data = array(
                    'id_event' => $id,
        );
        $this->load->view('home/layout/events/form', $data);

    }

    public function save()
    {


        $check_email = $this->apps->check_one('tbl_users_events', array('email' => $this->input->post("email")));

        if($check_email != FALSE)
        {
            $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-exclamation-circle"></i> Error! Alamat Email sudah terdaftar.
			                                                </div>');
            //redirect halaman
            redirect('events?source=error&utf8=✓');
        }else {

            $insert = array(
                'nama'          => $this->input->post("nama"),
                'event_id'      => $this->encryption->decode($this->input->post("event_id")),
                'telephone'     => $this->input->post("telephone"),
                'no_ktp'        => $this->input->post("no_ktp"),
                'email'         => $this->input->post("email"),
                'alamat'        => $this->input->post("alamat"),
                'no_hp'         => $this->input->post("no_hp"),
                'institusi'     => $this->input->post("institusi"),
                'jenis_kelamin' => $this->input->post("jenis_kelamin"),
                'bbm'           => $this->input->post("bbm"),
                'status'        => '0'
            );
            //insert db
            $this->db->insert("tbl_users_events", $insert);
            //create session flashdata
            $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-check"></i> Pendaftaran event berhasil, silahkan lakukan pembayaran ticket.
			                                                </div>');
            //redirect halaman
            redirect('events?source=join&utf8=✓');

        }
    }

}
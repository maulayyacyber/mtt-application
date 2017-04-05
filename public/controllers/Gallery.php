<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package  : Medical Top Team.
 * @author   : Fika Ridaul Maulayya <ridaulmaulayya@gmail.com>
 * @since    : 2017
 * @license  : https://maulayya.com/portofolio/medical-top-team/
 */
class Gallery extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //load model
        $this->load->model('web');
        //get visitor
        $this->web->counter_visitor();
    }

    public function index()
    {
        //creat data array
        $data = array(
            'title'   => 'Gallery',
            'keywords'         => systems('keywords'),
            'descriptions'     => systems('descriptions'),
            'profile' => TRUE,
            'gallery' => TRUE
        );
        $this->load->view('home/part/header', $data);
        $this->load->view('home/layout/gallery/data');
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
            $total  = $this->web->total_search_gallery($keyword);
            //config pagination
            $config['base_url'] = base_url().'gallery/search?q='.$keyword;
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
                'title'         => 'Gallery',
                'keywords'         => systems('keywords'),
                'descriptions'     => systems('descriptions'),
                'gallery'        => TRUE,
                'data_gallery'   => $this->web->search_index_gallery(strip_tags($keyword),$limit,$offset),
                'paging'        => $this->pagination->create_links()
            );
            if($data['data_gallery'] != NULL)
            {
                $data['gallery'] = $data['data_gallery'];
            }else{
                $data['gallery'] = '';
            }
            //load view with data
            $this->load->view('home/part/header', $data);
            $this->load->view('home/layout/gallery/search');
            $this->load->view('home/part/footer');
        }else{
            redirect('gallery/');
        }
    }

    public function foto($id_album)
    {
        $id_album = $this->encryption->decode($id_album);

        $data = array(
                    'title'          => $this->web->detail_album_array($id_album)->nama_album,
                    'gallery'        => TRUE,
                    'keywords'         => systems('keywords'),
                    'descriptions'     => systems('descriptions'),
                    'data_foto'      => $this->web->detail_album($id_album),
        );
        //load view with data
        $this->load->view('home/part/header', $data);
        $this->load->view('home/layout/gallery/foto');
        $this->load->view('home/part/footer');

    }


}
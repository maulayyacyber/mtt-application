<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package  : Medical Top Team.
 * @author   : Fika Ridaul Maulayya <ridaulmaulayya@gmail.com>
 * @since    : 2017
 * @license  : https://maulayya.com/portofolio/medical-top-team/
 */
class Articles extends CI_Controller{

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
            'title'     => 'Articles',
            'keywords'         => systems('keywords'),
            'descriptions'     => systems('descriptions'),
            'articles' => TRUE
        );
        $this->load->view('home/part/header', $data);
        $this->load->view('home/layout/articles/data');
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
            $total  = $this->web->total_search_articles($keyword);
            //config pagination
            $config['base_url'] = base_url().'articles/search?q='.$keyword;
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
                'title'         => 'Articles',
                'keywords'         => systems('keywords'),
                'descriptions'     => systems('descriptions'),
                'articles'        => TRUE,
                'data_articles'   => $this->web->search_index_articles(strip_tags($keyword),$limit,$offset),
                'paging'        => $this->pagination->create_links()
            );
            if($data['data_articles'] != NULL)
            {
                $data['articles'] = $data['data_articles'];
            }else{
                $data['articles'] = '';
            }
            //load view with data
            $this->load->view('home/part/header', $data);
            $this->load->view('home/layout/articles/search');
            $this->load->view('home/part/footer');
        }else{
            redirect('articles/');
        }
    }

    public function detail($url)
    {
        //library disqus
        $this->load->library('disqus');

        $data = array(
            'detail_articles'  => $this->web->detail_articles($url),
            'title'            => $this->web->detail_articles($url)->judul_articles,
            'keywords'         => $this->web->detail_articles($url)->meta_keywords,
            'descriptions'     => $this->web->detail_articles($url)->meta_descriptions,
            'articles_terbaru' => $this->web->articles_terbaru(),
            'author'           => $this->web->detail_articles($url)->nama_user,
            'disqus'           => $this->disqus->get_html()
        );
        //get id
        $id = $this->web->detail_articles($url)->id_articles;
        //query
        $query = $this->db->query("SELECT id_articles, views FROM tbl_articles WHERE id_articles = '$id'");
        $row   = $query->row();

        //update views articles
        $key['id_articles']  = $id;
        $update['views'] = $this->web->detail_articles($url)->views+1;
        $insert = $this->db->update("tbl_articles",$update,$key);

        //load view
        $this->load->view('home/part/header', $data);
        $this->load->view('home/layout/articles/detail');
        $this->load->view('home/part/footer');
    }
}
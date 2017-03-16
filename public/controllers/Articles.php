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
    }

    public function detail($url)
    {
        //library disqus
        //$this->load->library('disqus');

        $data = array(
            'detail_articles'  => $this->web->detail_articles($url),
            'title'            => $this->web->detail_articles($url)->judul_articles,
            'keywords'         => $this->web->detail_articles($url)->meta_keywords,
            'descriptions'     => $this->web->detail_articles($url)->meta_descriptions,
            'author'           => $this->web->detail_articles($url)->nama_user,
            //'disqus'        => $this->disqus->get_html()
        );
        //get id
        $id = $this->web->detail_articles($url)->id_articles;
        //query
        $query = $this->db->query("SELECT id_articles, views FROM tbl_articles WHERE id_articles = '$id'");
        $row   = $query->row();

        //update views articles
        $key['id_articles']  = $id;
        $update['views'] = $this->web->detail_articles($url)->views+1;
        //$insert = $this->db->update("tbl_videos",$update,$key);

        //load view
        $this->load->view('home/part/header', $data);
        $this->load->view('home/layout/articles/detail');
        $this->load->view('home/part/footer');
    }
}
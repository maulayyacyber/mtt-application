<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package  : Medical Top Team.
 * @author   : Fika Ridaul Maulayya <ridaulmaulayya@gmail.com>
 * @since    : 2017
 * @license  : https://maulayya.com/portofolio/medical-top-team/
 */
class Home extends CI_Controller {

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
                'title'     => 'Home',
                'keywords'         => systems('keywords'),
                'descriptions'     => systems('descriptions'),
                'home'      => TRUE,
                'sliders'   => $this->web->get_slider()
        );
		$this->load->view('home/part/header', $data);
        $this->load->view('home/layout/home/home');
        $this->load->view('home/part/footer');
	}

	function get_articles()
    {
        //declare page
        $page   =  $_GET['page'];
        //var articles define
        $articles = $this->web->get_articles($page);
        //loop
        foreach($articles as $hasil){

            //check lenght title
            if(strlen($hasil->judul_articles)<40)
            {
                $judul = '<h3><a href="'.base_url('articles/read').'/'.$hasil->slug.'/" style="text-decoration:none">'.$hasil->judul_articles.'</a></h3>';
            }else{
                $judul = '<h3><a href="'.base_url('articles/read').'/'.$hasil->slug.'/" style="text-decoration:none" title="'.$hasil->judul_articles.'">'.substr($hasil->judul_articles, 0,40).'...</a></h3>';

            }

            if(strlen($hasil->meta_descriptions) < 50)
            {
                $descriptions = '<p>'.$hasil->meta_descriptions.'</p>';
            }else{
                $descriptions = '<p>'.substr($hasil->meta_descriptions, 0,50).'...</p>';
            }

            // echo '<div class="col-md-3" style="margin-bottom: 20px">
            //         <div class="news-v2-badge">
            //              <img class="img-responsive" src="'.base_url().'resources/images/articles/thumb/'.$hasil->thumbnail.'" alt="">
            //             <p>
            //                 <span>'.$this->web->tgl_tunggal($hasil->created_at).'</span>
            //                 <small>'.$this->web->bulan_inggris($hasil->created_at).'</small>
            //             </p>
            //         </div>
            //         <div class="news-v2-desc bg-color-light" style="-moz-box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);webkit-box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12);">
            //             '.$judul.'
            //             <small><i class="fa fa-user-circle"></i> '.$hasil->nama_user.' </small>
            //             '.$descriptions.'
            //         </div>
            //     </div>';

                /*request client fotonya di hilangkan*/
             echo '<div class="col-md-3" style="margin-bottom: 20px">
                    <div class="news-v2-badge">
                          
                        <p>
                            <span>'.$this->web->tgl_tunggal($hasil->created_at).'</span>
                            <small>'.$this->web->bulan_inggris($hasil->created_at).'</small>
                        </p>
                    </div>
                    <div class="news-v2-desc bg-color-light" style="-moz-box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);webkit-box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12);">
                        '.$judul.'
                        <small><i class="fa fa-user-circle"></i> '.$hasil->nama_user.' </small>
                        '.$descriptions.'
                    </div>
                </div>';
        }
        exit;
    }

    function get_events()
    {
        //declare page
        $page   =  $_GET['page'];
        //var articles define
        $events = $this->web->get_events($page);
        //loop
        foreach($events as $hasil){

            //check lenght title
            if(strlen($hasil->judul_event)<40)
            {
                $judul = '<h3><a href="'.base_url('events/read').'/'.$hasil->slug.'/" style="text-decoration:none">'.$hasil->judul_event.'</a></h3>';
            }else{
                $judul = '<h3><a href="'.base_url('events/read').'/'.$hasil->slug.'/" style="text-decoration:none" title="'.$hasil->judul_event.'">'.substr($hasil->judul_event, 0,40).'...</a></h3>';

            }

            if(strlen($hasil->meta_descriptions) < 50)
            {
                $descriptions = '<p>'.$hasil->meta_descriptions.'</p>';
            }else{
                $descriptions = '<p>'.substr($hasil->meta_descriptions, 0,50).'...</p>';
            }

            echo '<div class="col-md-3" style="margin-bottom: 20px">
                    <div class="news-v2-badge">
                        <img class="img-responsive" src="'.base_url().'resources/images/events/thumb/'.$hasil->thumbnail.'" alt="">
                
                    </div>
                    <div class="news-v2-desc bg-color-light" style="-moz-box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);webkit-box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12);">
                        '.$judul.'
                        <small><i class="fa fa-map-marker"></i> '.$hasil->lokasi_event.' </small>
                       <p><a href="'.base_url().'events/join/'.$this->encryption->encode($hasil->id_event).'" class="btn-u btn-u-sea rounded"><i class="fa fa-shopping-cart"></i> BELI</a></p>
                    </div>
                </div>';
        }
        exit;
    }

    function get_gallery()
    {
        //declare page
        $page   =  $_GET['page'];
        //var articles define
        $events = $this->web->get_gallery($page);
        //loop
        foreach($events as $hasil){

            //check lenght title
            if(strlen($hasil->nama_album)<40)
            {
                $judul = '<h3><a href="'.base_url('gallery/foto').'/'.$this->encryption->encode($hasil->id_album).'/" style="text-decoration:none">'.$hasil->nama_album.'</a></h3>';
            }else{
                $judul = '<h3><a href="'.base_url('gallery/foto').'/'.$this->encryption->encode($hasil->id_album).'/" style="text-decoration:none" title="'.$hasil->nama_album.'">'.substr($hasil->nama_album, 0,40).'...</a></h3>';

            }

            echo '<div class="col-md-3" style="margin-bottom: 20px">
                    <div class="news-v2-badge">
                        <img class="img-responsive" src="'.base_url().'resources/foto_gallery/album.png" alt="">
                
                    </div>
                    <div class="news-v2-desc bg-color-light" style="-moz-box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);webkit-box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12);">
                        '.$judul.'
                    </div>
                </div>';
        }
        exit;
    }
}

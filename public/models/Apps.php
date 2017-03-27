<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package  : Medical Top Team.
 * @author   : Fika Ridaul Maulayya <ridaulmaulayya@gmail.com>
 * @since    : 2017
 * @license  : https://maulayya.com/portofolio/medical-top-team/
 */
class Apps extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    //fungsi restrict halaman
    function apps_id()
    {
        return $this->session->userdata('apps_id');
    }

    //fungsi check username
    function check_one($table,$where)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    //fungsi check login all
    function check_all($table,$field1,$field2)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($field1);
        $this->db->where($field2);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    //fungsi check login member
    function check_members($table,$field1,$field2,$field3)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($field1);
        $this->db->where($field2);
        $this->db->where($field3);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    // funsi visitor
    function count_in_today()
    {
        $q = $this->db->query("SELECT COUNT(id_counter) as count_in_today FROM tbl_counter WHERE DATE(date_visit) = CURDATE()");
        return $q;
    }

    function count_in_week()
    {
        $q = $this->db->query("SELECT COUNT(id_counter) as count_in_week FROM tbl_counter WHERE DATE(date_visit) BETWEEN CURDATE() - INTERVAL 7 DAY AND CURDATE()");
        return $q;
    }

    function count_in_month()
    {
        $q = $this->db->query("SELECT COUNT(id_counter) as count_in_month FROM tbl_counter WHERE DATE(date_visit) BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()");
        return $q;
    }

    function count_in_year()
    {
        $q = $this->db->query("SELECT COUNT(id_counter) as count_in_year FROM tbl_counter WHERE YEAR(date_visit) = YEAR(CURDATE())");
        return $q;
    }

    // fungsi articles
    function count_articles()
    {
        return $this->db->get('tbl_articles');
    }

    function index_articles($halaman,$batas)
    {
        $query = "SELECT a.id_articles, a.judul_articles, a.user_id, b.id_user, a.views, a.created_at, a.slug, b.nama_user FROM tbl_articles as a JOIN tbl_users as b ON a.user_id = b.id_user ORDER BY a.id_articles DESC limit $halaman, $batas";
        return $this->db->query($query);
    }

    function total_search_articles($keyword)
    {
        $query = $this->db->like('judul_articles',$keyword)->get('tbl_articles');

        if($query->num_rows() > 0)
        {
            return $query->num_rows();
        }
        else
        {
            return NULL;
        }
    }

    public function search_index_articles($keyword,$limit,$offset)
    {
        $query = $this->db->select('a.id_articles, a.user_id, a.judul_articles, a.slug, a.views, b.id_user, b.nama_user')
            ->from('tbl_articles a')
            ->join('tbl_users b','a.user_id = b.id_user')
            ->limit($limit,$offset)
            ->like('a.judul_articles',$keyword)
            ->or_like('b.nama_user',$keyword)
            ->limit($limit,$offset)
            ->order_by('a.id_articles','DESC')
            ->get();

        if($query->num_rows() > 0)
        {
            return $query;
        }
        else
        {
            return NULL;
        }
    }

    function edit_articles($id_articles)
    {
        $id_articles  =  array('id_articles'=> $id_articles);
        return $this->db->get_where('tbl_articles',$id_articles);
    }

    // fungsi pages
    function count_pages()
    {
        return $this->db->get('tbl_pages');
    }

    function index_pages($halaman,$batas)
    {
        $query = "SELECT * FROM tbl_pages as a JOIN tbl_users as b ON a.user_id = b.id_user  ORDER BY judul_page ASC limit $halaman, $batas";
        return $this->db->query($query);
    }

    function edit_pages($id_page)
    {
        $id_page  =  array('id_page'=> $id_page);
        return $this->db->get_where('tbl_pages',$id_page);
    }

    function total_search_pages($keyword)
    {
        $query = $this->db->like('judul_page',$keyword)->get('tbl_pages');

        if($query->num_rows() > 0)
        {
            return $query->num_rows();
        }
        else
        {
            return NULL;
        }
    }

    public function search_index_pages($keyword,$limit,$offset)
    {
        $query = $this->db->select('*')
            ->from('tbl_pages a')
            ->join('tbl_users b','a.user_id = b.id_user')
            ->limit($limit,$offset)
            ->like('a.judul_page',$keyword)
            ->limit($limit,$offset)
            ->order_by('a.judul_page','ASC')
            ->get();

        if($query->num_rows() > 0)
        {
            return $query;
        }
        else
        {
            return NULL;
        }
    }

    // fungsi album
    function count_album()
    {
        return $this->db->get('tbl_album');
    }

    function index_album($halaman,$batas)
    {
        $query = "SELECT id_album, nama_album FROM tbl_album ORDER BY id_album DESC limit $halaman, $batas";
        return $this->db->query($query);
    }

    function total_search_album($keyword)
    {
        $query = $this->db->like('nama_album',$keyword)->get('tbl_album');

        if($query->num_rows() > 0)
        {
            return $query->num_rows();
        }
        else
        {
            return NULL;
        }
    }

    public function search_index_album($keyword,$limit,$offset)
    {
        $query = $this->db->select('*')
            ->from('tbl_album')
            ->like('nama_album',$keyword)
            ->limit($limit,$offset)
            ->order_by('id_album','DESC')
            ->get();

        if($query->num_rows() > 0)
        {
            return $query;
        }
        else
        {
            return NULL;
        }
    }

    function edit_album($id_album)
    {
        $id_album  =  array('id_album'=> $id_album);
        return $this->db->get_where('tbl_album',$id_album);
    }

    function count_album_picture($id_album)
    {
        $query = $this->db->select('*')
            ->from('tbl_foto_gallery a')
            ->join('tbl_album b','a.album_id = b.id_album')
            ->where('a.album_id',$id_album)
            ->order_by('a.album_id','DESC')
            ->get();

        if($query->num_rows() > 0)
        {
            return $query->num_rows();
        }
        else
        {
            return NULL;
        }
    }

    function index_album_picture($halaman,$batas,$id_album)
    {
        $query = "SELECT a.id_foto, a.album_id, a.caption_foto, a.foto_gallery, b.id_album, b.nama_album FROM tbl_foto_gallery a LEFT JOIN tbl_album b ON a.album_id = b.id_album WHERE a.album_id = '$id_album' limit $halaman, $batas";
        return $this->db->query($query);
    }

    /* fungsi user */
    function count_users()
    {
        return $this->db->get('tbl_users');
    }

    function index_users($halaman,$batas)
    {
        $query = "SELECT * FROM tbl_users  ORDER BY id_user DESC limit $halaman, $batas";
        return $this->db->query($query);
    }

    function search_users_json()
    {
        $query = $this->db->get('tbl_users');
        return $query->result();
    }

    function total_search_users($keyword)
    {
        $query = $this->db->like('nama_user',$keyword)->get('tbl_users');

        if($query->num_rows() > 0)
        {
            return $query->num_rows();
        }
        else
        {
            return NULL;
        }
    }

    public function search_index_users($keyword,$limit,$offset)
    {
        $query = $this->db->select('*')
            ->from('tbl_users')
            ->limit($limit,$offset)
            ->like('nama_user',$keyword)
            ->or_like('username', $keyword)
            ->limit($limit,$offset)
            ->order_by('id_user','DESC')
            ->get();

        if($query->num_rows() > 0)
        {
            return $query;
        }
        else
        {
            return NULL;
        }
    }

    function edit_users($id_user)
    {
        $id_user  =  array('id_user'=> $id_user);
        return $this->db->get_where('tbl_users', $id_user);
    }

    // fungsi events
    function count_events()
    {
        return $this->db->get('tbl_events');
    }

    function index_events($halaman,$batas)
    {
        $query = "SELECT a.id_event, a.judul_event, a.user_id, b.id_user, a.lokasi_event, a.updated_at, a.slug, b.nama_user FROM tbl_events as a JOIN tbl_users as b ON a.user_id = b.id_user ORDER BY a.id_event DESC limit $halaman, $batas";
        return $this->db->query($query);
    }

    function total_search_events($keyword)
    {
        $query = $this->db->like('judul_event',$keyword)->get('tbl_events');

        if($query->num_rows() > 0)
        {
            return $query->num_rows();
        }
        else
        {
            return NULL;
        }
    }

    public function search_index_events($keyword,$limit,$offset)
    {
        $query = $this->db->select('a.id_event, a.judul_event, a.user_id, b.id_user, a.lokasi_event, a.updated_at, a.slug, b.nama_user')
            ->from('tbl_events a')
            ->join('tbl_users b','a.user_id = b.id_user')
            ->limit($limit,$offset)
            ->like('a.judul_event',$keyword)
            ->or_like('b.nama_user',$keyword)
            ->limit($limit,$offset)
            ->order_by('a.id_event','DESC')
            ->get();

        if($query->num_rows() > 0)
        {
            return $query;
        }
        else
        {
            return NULL;
        }
    }

    function edit_events($id_events)
    {
        $id_events  =  array('id_event'=> $id_events);
        return $this->db->get_where('tbl_events',$id_events);
    }

    // fungsi Users events
    function count_users_events()
    {
        return $this->db->get('tbl_users_events');
    }

    function index_users_events($halaman,$batas)
    {
        $query = "SELECT a.id_user_event, a.event_id, a.nama, a.status, b.id_event, b.judul_event,  b.slug FROM tbl_users_events as a JOIN tbl_events as b ON a.event_id = b.id_event ORDER BY a.id_user_event DESC limit $halaman, $batas";
        return $this->db->query($query);
    }

    function total_search_users_events($keyword)
    {
        $query = $this->db->like('nama',$keyword)->get('tbl_users_events');

        if($query->num_rows() > 0)
        {
            return $query->num_rows();
        }
        else
        {
            return NULL;
        }
    }

    public function search_index_users_events($keyword,$limit,$offset)
    {
        $query = $this->db->select('a.id_user_event, a.event_id, a.nama, a.status, b.id_event, b.judul_event,  b.slug')
            ->from('tbl_users_events a')
            ->join('tbl_events b','a.event_id = b.id_event')
            ->limit($limit,$offset)
            ->like('b.judul_event',$keyword)
            ->or_like('a.nama',$keyword)
            ->limit($limit,$offset)
            ->order_by('a.id_user_event','DESC')
            ->get();

        if($query->num_rows() > 0)
        {
            return $query;
        }
        else
        {
            return NULL;
        }
    }

    function detail_users_events($id_user_event)
    {
        $query = $this->db->query("SELECT a.id_user_event, a.event_id, a.nama, a.status, b.id_event, b.judul_event, a.telephone, a.bbm, a.no_hp, a.no_ktp, a.email, a.institusi, a.jenis_kelamin, a.alamat,  b.slug FROM tbl_users_events as a JOIN tbl_events as b ON a.event_id = b.id_event WHERE a.id_user_event = '$id_user_event'");
        return $query;
    }

    /* fungsi members */
    function count_members()
    {
        return $this->db->get('tbl_members');
    }

    function index_members($halaman,$batas)
    {
        $query = "SELECT * FROM tbl_members as a JOIN tbl_institusi as b ON a.institusi_id = b.id_institusi  ORDER BY a.id_member DESC limit $halaman, $batas";
        return $this->db->query($query);
    }

    function total_search_members($keyword)
    {
        $query = $this->db->like('nama',$keyword)->get('tbl_members');

        if($query->num_rows() > 0)
        {
            return $query->num_rows();
        }
        else
        {
            return NULL;
        }
    }

    public function search_index_members($keyword,$limit,$offset)
    {
        $query = $this->db->select('*')
            ->from('tbl_members a')
            ->join('tbl_institusi b','a.institusi_id = b.id_institusi')
            ->limit($limit,$offset)
            ->like('b.nama_institusi',$keyword)
            ->or_like('a.nama',$keyword)
            ->limit($limit,$offset)
            ->order_by('a.id_member','DESC')
            ->get();

        if($query->num_rows() > 0)
        {
            return $query;
        }
        else
        {
            return NULL;
        }
    }

    function select_institusi()
    {
        $this->db->order_by('nama_institusi ASC');
        return $this->db->get('tbl_institusi');
    }

    function edit_members($id_member)
    {
        $id_member  =  array('id_member'=> $id_member);
        return $this->db->get_where('tbl_members',$id_member);
    }

    // fungsi slider
    function index_sliders()
    {
        $query = "SELECT * FROM tbl_slider ORDER BY id_slider DESC";
        return $this->db->query($query);
    }

    //fungsi date ago
    function time_elapsed_string($datetime, $full = false) {
        $today = time();
        $createdday= strtotime($datetime);
        $datediff = abs($today - $createdday);
        $difftext="";
        $years = floor($datediff / (365*60*60*24));
        $months = floor(($datediff - $years * 365*60*60*24) / (30*60*60*24));
        $days = floor(($datediff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
        $hours= floor($datediff/3600);
        $minutes= floor($datediff/60);
        $seconds= floor($datediff);
        //year checker
        if($difftext=="")
        {
            if($years>1)
                $difftext=$years." years ago";
            elseif($years==1)
                $difftext=$years." year ago";
        }
        //month checker
        if($difftext=="")
        {
            if($months>1)
                $difftext=$months." months ago";
            elseif($months==1)
                $difftext=$months." month ago";
        }
        //month checker
        if($difftext=="")
        {
            if($days>1)
                $difftext=$days." days ago";
            elseif($days==1)
                $difftext=$days." day ago";
        }
        //hour checker
        if($difftext=="")
        {
            if($hours>1)
                $difftext=$hours." hours ago";
            elseif($hours==1)
                $difftext=$hours." hour ago";
        }
        //minutes checker
        if($difftext=="")
        {
            if($minutes>1)
                $difftext=$minutes." minutes ago";
            elseif($minutes==1)
                $difftext=$minutes." minute ago";
        }
        //seconds checker
        if($difftext=="")
        {
            if($seconds>1)
                $difftext=$seconds." seconds ago";
            elseif($seconds==1)
                $difftext=$seconds." second ago";
        }
        return $difftext;
    }

}
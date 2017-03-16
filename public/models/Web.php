<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package  : Medical Top Team.
 * @author   : Fika Ridaul Maulayya <ridaulmaulayya@gmail.com>
 * @since    : 2017
 * @license  : https://maulayya.com/portofolio/medical-top-team/
 */
class Web extends CI_Model{

    //get slider
    function get_slider()
    {
        $query = "SELECT * FROM tbl_slider ORDER BY id_slider DESC";
        return $this->db->query($query);
    }

    //get articles
    function get_articles($page){
        //offset
        $offset = 4 * $page;
        //limit
        $limit  = 4;
        //query
        $query  = "SELECT a.id_articles, a.user_id, a.judul_articles, a.slug, a.thumbnail, a.meta_descriptions, a.created_at, b.id_user, b.nama_user FROM tbl_articles as a JOIN tbl_users as b ON a.user_id = b.id_user ORDER BY a.id_articles DESC limit $offset ,$limit";
        //get result
        $result = $this->db->query($query)->result();
        //callback return
        return $result;
    }

    //get articles
    function get_events($page){
        //offset
        $offset = 8 * $page;
        //limit
        $limit  = 8;
        //query
        $query  = "SELECT * FROM tbl_events ORDER BY id_event DESC limit $offset ,$limit";
        //get result
        $result = $this->db->query($query)->result();
        //callback return
        return $result;
    }

    //get detail articles
    function detail_articles($url)
    {
        $query = $this->db->query("SELECT a.id_articles, a.user_id, a.judul_articles, a.slug, a.isi_articles, a.thumbnail, a.views, a.meta_keywords, a.meta_descriptions, a.created_at, b.id_user, b.nama_user FROM tbl_articles as a JOIN tbl_users as b ON a.user_id = b.id_user WHERE a.slug = '$url'");

        if($query->num_rows() > 0)
        {
            return $query->row();
        }else
        {
            return NULL;
        }
    }

    //function date time
    //fungsi date
    // Fungsi GLobal //
    function tgl_time_indo($date=null){
        $tglindo = date("d-m-Y H:i:s", strtotime($date));
        $formatTanggal = $tglindo;
        return $formatTanggal;
    }

    function tgl_database($date=null)
    {
        $tgldatabase = date("Y-m-d", strtotime($date));
        $formatTanggal = $tgldatabase;
        return $formatTanggal;
    }

    function tgl_indo($date=null)
    {
        $tglindo = date("d-m-Y", strtotime($date));
        $formatTanggal = $tglindo;
        return $formatTanggal;
    }

    function tgl_tunggal($date=null)
    {
        $tglindo = date("j", strtotime($date));
        $formatTanggal = $tglindo;
        return $formatTanggal;
    }

    function tgl_mont_year($date=null)
    {
        $tglindo = date("n, Y");
        return $tglindo;
    }

    function year_tunggal($date=null)
    {
        $tglindo = date("Y");
        return $tglindo;
    }

    function jam_format($time=null)
    {
        $jamformat = date("H:i", strtotime($time));
        $formatJam = $jamformat;
        return $formatJam;
    }

    function bulan_inggris($date=null){
        //buat array nama hari dalam bahasa Indonesia dengan urutan 1-7
        $array_hari = array(1=>'Senin','Selasa','Rabu','Kamis','Jumat', 'Sabtu','Minggu');
        //buat array nama bulan dalam bahasa Indonesia dengan urutan 1-12
        $array_bulan = array(1=>'Jan','Feb','Mar', 'Apr', 'May', 'Jun','Jul','Aug',
            'Sep','Oct', 'Nov','Dec');
        if($date == null) {
            //jika $date kosong, makan tanggal yang diformat adalah tanggal hari ini
            $hari = $array_hari[date('N')];
            $tanggal = date ('j');
            $bulan = $array_bulan[date('n')];
            $tahun = date('Y');
        } else {
            //jika $date diisi, makan tanggal yang diformat adalah tanggal tersebut
            $date = strtotime($date);
            $hari = $array_hari[date('N',$date)];
            $tanggal = date ('j', $date);
            $bulan = $array_bulan[date('n',$date)];
            $tahun = date('Y',$date);
        }
        $formatTanggal = $bulan;
        return $formatTanggal;
    }

    function tgl_indo_no_hari($date=null){
        //buat array nama hari dalam bahasa Indonesia dengan urutan 1-7
        $array_hari = array(1=>'Senin','Selasa','Rabu','Kamis','Jumat', 'Sabtu','Minggu');
        //buat array nama bulan dalam bahasa Indonesia dengan urutan 1-12
        $array_bulan = array(1=>'Januari','Februari','Maret', 'April', 'Mei', 'Juni','Juli','Agustus',
            'September','Oktober', 'November','Desember');
        if($date == null) {
            //jika $date kosong, makan tanggal yang diformat adalah tanggal hari ini
            $hari = $array_hari[date('N')];
            $tanggal = date ('j');
            $bulan = $array_bulan[date('n')];
            $tahun = date('Y');
        } else {
            //jika $date diisi, makan tanggal yang diformat adalah tanggal tersebut
            $date = strtotime($date);
            $hari = $array_hari[date('N',$date)];
            $tanggal = date ('j', $date);
            $bulan = $array_bulan[date('n',$date)];
            $tahun = date('Y',$date);
        }
        $formatTanggal = $tanggal ." ". $bulan ." ". $tahun;
        return $formatTanggal;
    }

    function bulan_indo($date=null){
        //buat array nama hari dalam bahasa Indonesia dengan urutan 1-7
        $array_hari = array(1=>'Senin','Selasa','Rabu','Kamis','Jumat', 'Sabtu','Minggu');
        //buat array nama bulan dalam bahasa Indonesia dengan urutan 1-12
        $array_bulan = array(1=>'Januari','Februari','Maret', 'April', 'Mei', 'Juni','Juli','Agustus',
            'September','Oktober', 'November','Desember');
        if($date == null) {
            //jika $date kosong, makan tanggal yang diformat adalah tanggal hari ini
            $hari = $array_hari[date('N')];
            $tanggal = date ('j');
            $bulan = $array_bulan[date('n')];
            $tahun = date('Y');
        } else {
            //jika $date diisi, makan tanggal yang diformat adalah tanggal tersebut
            $date = strtotime($date);
            $hari = $array_hari[date('N',$date)];
            $tanggal = date ('j', $date);
            $bulan = $array_bulan[date('n',$date)];
            $tahun = date('Y',$date);
        }
        $formatTanggal = $bulan;
        return $formatTanggal;
    }

    function tgl_indo_lengkap($date=null){
        //buat array nama hari dalam bahasa Indonesia dengan urutan 1-7
        $array_hari = array(1=>'Senin','Selasa','Rabu','Kamis','Jumat', 'Sabtu','Minggu');
        //buat array nama bulan dalam bahasa Indonesia dengan urutan 1-12
        $array_bulan = array(1=>'Januari','Februari','Maret', 'April', 'Mei', 'Juni','Juli','Agustus',
            'September','Oktober', 'November','Desember');
        if($date == null) {
            //jika $date kosong, makan tanggal yang diformat adalah tanggal hari ini
            $hari = $array_hari[date('N')];
            $tanggal = date ('d');
            $bulan = $array_bulan[date('n')];
            $tahun = date('Y');
            $jam = date('H:i:s');
        } else {
            //jika $date diisi, makan tanggal yang diformat adalah tanggal tersebut
            $date = strtotime($date);
            $hari = $array_hari[date('N',$date)];
            $tanggal = date ('d', $date);
            $bulan = $array_bulan[date('n',$date)];
            $tahun = date('Y',$date);
            $jam = date('H:i:s',$date);
        }
        $formatTanggal = $hari . ", " . $tanggal ." ". $bulan ." ". $tahun ." Jam ". $jam;
        return $formatTanggal;
    }

    function tgl_jam_indo_no_hari($date=null){
        //buat array nama hari dalam bahasa Indonesia dengan urutan 1-7
        $array_hari = array(1=>'Senin','Selasa','Rabu','Kamis','Jumat', 'Sabtu','Minggu');
        //buat array nama bulan dalam bahasa Indonesia dengan urutan 1-12
        $array_bulan = array(1=>'Januari','Februari','Maret', 'April', 'Mei', 'Juni','Juli','Agustus',
            'September','Oktober', 'November','Desember');
        if($date == null) {
            //jika $date kosong, makan tanggal yang diformat adalah tanggal hari ini
            $hari = $array_hari[date('N')];
            $tanggal = date ('d');
            $bulan = $array_bulan[date('n')];
            $tahun = date('Y');
            $jam = date('H:i:s');
        } else {
            //jika $date diisi, makan tanggal yang diformat adalah tanggal tersebut
            $date = strtotime($date);
            $hari = $array_hari[date('N',$date)];
            $tanggal = date ('d', $date);
            $bulan = $array_bulan[date('n',$date)];
            $tahun = date('Y',$date);
            $jam = date('H:i:s',$date);
        }
        $formatTanggal = $tanggal ." ". $bulan ." ". $tahun ." Jam ". $jam;
        return $formatTanggal;
    }

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

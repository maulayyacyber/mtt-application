<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package  : Medical Top Team.
 * @author   : Fika Ridaul Maulayya <ridaulmaulayya@gmail.com>
 * @since    : 2017
 * @license  : https://maulayya.com/portofolio/medical-top-team/
 */
class Dashboard extends CI_Controller{

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
                'title' => 'Dashboard ',
                'dashboard' => TRUE,
                'js_ready'  => "GetToday('".date("Y-m-d")."')"
            );

            // Get Count Visitor
            $today_visit = $this->apps->count_in_today();
            $get_today_visit = $today_visit->row();
            $data['today_visit'] = $get_today_visit->count_in_today;

            $week_visit = $this->apps->count_in_week();
            $get_week_visit = $week_visit->row();
            $data['week_visit'] = $get_week_visit->count_in_week;

            $month_visit = $this->apps->count_in_month();
            $get_month_visit = $month_visit->row();
            $data['month_visit'] = $get_month_visit->count_in_month;

            $year_visit = $this->apps->count_in_year();
            $get_year_visit = $year_visit->row();
            $data['year_visit'] = $get_year_visit->count_in_year;

            $this->load->view('apps/part/header', $data);
            $this->load->view('apps/part/sidebar');
            $this->load->view('apps/layout/dashboard/dashboard');
            $this->load->view('apps/part/footer');
        } else {
            show_404();
            return FALSE;
        }
    }


    function get_chart_today()
    {
        $tgl = $this->input->post("tgl");
        $jm = array();
        $total = array();
        for($jam=00;$jam<=23;$jam++){
            if(strlen($jam)==1)
            {
                $query = $this->db->query("SELECT count(id_counter) as total_pengunjung FROM tbl_counter WHERE DATE(date_visit)='$tgl' AND DATE_FORMAT(date_visit, '%H')='0$jam'");
                $get = $query->row();
                $jm[] = "0$jam";
                $total[] = $get->total_pengunjung;
            }else{
                $query = $this->db->query("SELECT count(id_counter) as total_pengunjung FROM tbl_counter WHERE DATE(date_visit)='$tgl' AND DATE_FORMAT(date_visit, '%H')='$jam'");
                $get = $query->row();
                $jm[] = "$jam";
                $total[] = $get->total_pengunjung;
            }
        }
        echo json_encode(array("jam" => $jm, "total" => $total), JSON_NUMERIC_CHECK);
    }

    function get_chart_week()
    {
        $tgl2 = strtotime($this->input->post("tgl1"));
        $tgl1 = strtotime($this->input->post("tgl2"));
        $tgl = array();
        $total = array();
        $m= date("m");
        $de= date("d");
        $y= date("Y");
        for($i=0; $i<=6; $i++){
            $date = date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y));
            $query = $this->db->query("SELECT count(id_counter) as total_pengunjung FROM tbl_counter WHERE DATE(date_visit)='$date'");
            $get = $query->row();
            $tgl[] = date('d-m-Y',mktime(0,0,0,$m,($de-$i),$y));
            $total[] = $get->total_pengunjung;
        }
        echo json_encode(array("tgl" => $tgl, "total" => $total), JSON_NUMERIC_CHECK);
    }

    function get_chart_month()
    {
        $tgl = array();
        $total = array();
        $month = date("m");
        $currentdays = intval(date("t"));
        $i = 0;
        while ($i++ < $currentdays){
            $query = $this->db->query("SELECT count(id_counter) as total_pengunjung FROM tbl_counter WHERE DATE_FORMAT(date_visit, '%m')='$month' AND DATE_FORMAT(date_visit, '%e')='$i'");
            $get = $query->row();
            $tgl[] = $i."-".date("M");
            $total[] = $get->total_pengunjung;
        }
        echo json_encode(array("tgl" => $tgl, "total" => $total), JSON_NUMERIC_CHECK);
    }

    function get_chart_all()
    {
        $tgl = array();
        $total = array();
        for($i =0; $i <= 4 ;$i++)
        {
            $year = date('Y') - 4 + $i;
            $query = $this->db->query("SELECT count(id_counter) as total_pengunjung FROM tbl_counter WHERE DATE_FORMAT(date_visit, '%Y')='$year'");
            $get = $query->row();
            $tgl[] = $year;
            $total[] = $get->total_pengunjung;
        }
        echo json_encode(array("tgl" => $tgl, "total" => $total), JSON_NUMERIC_CHECK);
    }

    public function logout()
    {
        if($this->apps->apps_id())
        {
            $this->session->sess_destroy();
            redirect('apps/login?source=logout&utf8=✓');
        }else{
            show_404();
            return FALSE;
        }
    }

}
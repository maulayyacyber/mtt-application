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
        $this->load->model('apps');
    }

    public function index()
    {
        if($this->apps->apps_id())
        {

        }else{
            show_404();
            return FALSE;
        }
    }

    public function add()
    {
        if($this->apps->apps_id())
        {

        }else{
            show_404();
            return FALSE;
        }
    }

    public function edit()
    {
        if($this->apps->apps_id())
        {

        }else{
            show_404();
            return FALSE;
        }
    }

    public function save()
    {
        if($this->apps->apps_id())
        {

        }else{
            show_404();
            return FALSE;
        }
    }

    public function delete()
    {
        if($this->apps->apps_id())
        {

        }else{
            show_404();
            return FALSE;
        }
    }
}
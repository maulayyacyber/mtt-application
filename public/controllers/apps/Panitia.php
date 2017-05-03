<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package  : Medical Top Team.
 * @author   : Fika Ridaul Maulayya <ridaulmaulayya@gmail.com>
 * @since    : 2017
 * @license  : https://maulayya.com/portofolio/medical-top-team/
 */
class Panitia extends CI_Controller{

    public function __construct()
    {
         parent::__construct();
        //load model
        $this->load->model('apps');
        
    }

    public function index()
    {
    	if ($this->apps->apps_id()) {
            //config pagination
            $config['base_url'] = base_url() . 'apps/panitia/index/';
            $config['total_rows'] = $this->apps->count_panitia()->num_rows();
            $config['per_page'] = 10;
            //instalasi paging
            $this->pagination->initialize($config);
            //deklare halaman
            $halaman = $this->uri->segment(4);
            $halaman = $halaman == '' ? 0 : $halaman;
            //create data array
            //create data array
            $data = array(
                'title' => 'Panitia',
                'panitia' => TRUE,
                'data_panitia' => $this->apps->index_panitia($halaman, $config['per_page']),
                'paging' => $this->pagination->create_links()
            );


            if ($data['data_panitia'] != NULL) {
                $data['panitia'] = $data['data_panitia'];
            } else {
                $data['panitia'] = NULL;
            }

            //load view with data
            $this->load->view('apps/part/header', $data);
            $this->load->view('apps/part/sidebar');
            $this->load->view('apps/layout/panitia/data');
            $this->load->view('apps/part/footer');
        } else {
            show_404();
            return FALSE;
        }
    }

    public function search()
    {
        if($this->apps->apps_id())
        {
            $limit = 10;
            $this->load->helper('security');
            $keyword = $this->security->xss_clean($_GET['q']);
            $data['keyword'] = strip_tags($keyword);
            $check = strlen(preg_replace('/[^a-zA-Z]/', '', $keyword));
            if(!empty($keyword) && $check > 2)
            {
                $offset = (isset($_GET['page'])) ? $this->security->xss_clean($_GET['page']) : 0 ;
                $total  = $this->apps->total_search_panitia($keyword);
                //config pagination
                $config['base_url'] = base_url().'apps/panitia/search?q='.$keyword;
                $config['total_rows'] = $total;
                $config['per_page'] = $limit;
                $config['page_query_string'] = TRUE;
                $config['use_page_numbers'] = TRUE;
                $config['display_pages']	= TRUE;
                $config['query_string_segment'] = 'page';
                $config['uri_segment']  = 4;
                //instalasi paging
                $this->pagination->initialize($config);

                $data = array(
                    'title'         => 'Panitia',
                    'panitia'         => TRUE,
                    'data_panitia'    => $this->apps->search_index_panitia(strip_tags($keyword),$limit,$offset),
                    'paging'        => $this->pagination->create_links()
                );
                if($data['data_panitia'] != NULL)
                {
                    $data['panitia'] = $data['data_panitia'];
                }else{
                    $data['panitia'] = '';
                }
                //load view with data
                $this->load->view('apps/part/header', $data);
                $this->load->view('apps/part/sidebar');
                $this->load->view('apps/layout/panitia/data');
                $this->load->view('apps/part/footer');
            }else{
                redirect('apps/panitia/');
            }
        }else{
            show_404();
            return FALSE;
        }
    }

    public function add()
    {
        if ($this->apps->apps_id()) {
            $data = array(
                'title' => 'Add panitia ',
                'panitia' => TRUE,
                'type' => 'add'
            );
            //load view with data
            $this->load->view('apps/part/header', $data);
            $this->load->view('apps/part/sidebar');
            $this->load->view('apps/layout/panitia/add');
            $this->load->view('apps/part/footer');
        } else {
            show_404();
            return FALSE;
        }
    }

    public function save()
    {  
        $type = $this->input->post("type");

        $id['id_panitia'] = $this->encryption->decode($this->input->post("id_panitia"));

        if($type == "add")
        {
             
            $insert = array(
                        'nama_panitia' => $this->input->post("nama_panitia"),
            );
            $this->db->insert("tbl_panitia", $insert);

            //deklarasi session flashdata
            $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible" style="font-family:Roboto">
                                                                <i class="fa fa-check"></i> Data Berhasil Disimpan.
                                                            </div>');
            //redirect halaman
            redirect('apps/panitia?source=add&utf8=✓');

        }elseif($type == "edit"){
             
            $update = array(
                        'nama_panitia' => $this->input->post("nama_panitia"),
            );
            $this->db->update("tbl_panitia", $update, $id);

            //deklarasi session flashdata
            $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible" style="font-family:Roboto">
                                                                <i class="fa fa-check"></i> Data Berhasil Disimpan.
                                                            </div>');
            //redirect halaman
            redirect('apps/panitia?source=add&utf8=✓');
        }
    }

    public function edit($id_panitia)
    {
         $id_panitia = $this->encryption->decode($this->uri->segment(4));
          if ($this->apps->apps_id()) {

            $data = array(
                'title' => 'Edit Panitia ',
                'panitia' => TRUE,
                'type' => 'edit',
                'data_panitia' => $this->apps->edit_panitia($id_panitia)->row_array()
            );
            //load view with data
            $this->load->view('apps/part/header', $data);
            $this->load->view('apps/part/sidebar');
            $this->load->view('apps/layout/panitia/edit');
            $this->load->view('apps/part/footer');
        } else {
            show_404();
            return FALSE;
        }

    }


}
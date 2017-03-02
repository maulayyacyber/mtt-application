<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package  : Medical Top Team.
 * @author   : Fika Ridaul Maulayya <ridaulmaulayya@gmail.com>
 * @since    : 2017
 * @license  : https://maulayya.com/portofolio/medical-top-team/
 */
class Users_events extends CI_Controller{

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
            $config['base_url'] = base_url() . 'apps/users_events/index/';
            $config['total_rows'] = $this->apps->count_users_events()->num_rows();
            $config['per_page'] = 10;
            //instalasi paging
            $this->pagination->initialize($config);
            //deklare halaman
            $halaman = $this->uri->segment(4);
            $halaman = $halaman == '' ? 0 : $halaman;
            //create data array
            $data = array(
                'title'         => 'Users Events',
                'users_events'  => TRUE,
                'data_users_events'   => $this->apps->index_users_events($halaman, $config['per_page']),
                'paging'        => $this->pagination->create_links()
            );
            if ($data['data_users_events'] != NULL) {
                $data['users_events'] = $data['data_users_events'];
            } else {
                $data['users_events'] = NULL;
            }
            //load view with data
            $this->load->view('apps/part/header', $data);
            $this->load->view('apps/part/sidebar');
            $this->load->view('apps/layout/users_events/data');
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
                $total  = $this->apps->total_search_users_events($keyword);
                //config pagination
                $config['base_url'] = base_url().'apps/users_events/search?q='.$keyword;
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
                    'title'         => 'Events',
                    'users_events'        => TRUE,
                    'data_users_events'   => $this->apps->search_index_users_events(strip_tags($keyword),$limit,$offset),
                    'paging'        => $this->pagination->create_links()
                );
                if($data['data_users_events'] != NULL)
                {
                    $data['users_events'] = $data['data_users_events'];
                }else{
                    $data['users_events'] = '';
                }
                //load view with data
                $this->load->view('apps/part/header', $data);
                $this->load->view('apps/part/sidebar');
                $this->load->view('apps/layout/users_events/data');
                $this->load->view('apps/part/footer');
            }else{
                redirect('apps/users_events/');
            }
        }else{
            show_404();
            return FALSE;
        }
    }

    public function detail($id_user_event)
    {
        $id_user_event = $this->encryption->decode($this->uri->segment(4));

        if($this->apps->apps_id())
        {
            $data = array(
                'title'    => 'Detail Users Events ',
                'users_events' => TRUE,
                'type'     => 'edit',
                'data_users_events'   => $this->apps->detail_users_events($id_user_event)->row_array()
            );
            //load view with data
            $this->load->view('apps/part/header', $data);
            $this->load->view('apps/part/sidebar');
            $this->load->view('apps/layout/users_events/detail');
            $this->load->view('apps/part/footer');
        }else{
            show_404();
            return FALSE;
        }
    }

    public function send()
    {
        if($this->apps->apps_id())
        {
            $id_user_event  = $this->encryption->decode($this->uri->segment(4));

            $email_me  = mails('smtp_user');
            $nama_me   = systems('admin_title');
            $query     = $this->db->query("SELECT * FROM tbl_users_events WHERE id_user_event='$id_user_event'")->row();
            $email_to  = $query->email;
            //create data array
            $data = array(
                            'mana' => $query->nama,
            );

            //config sending mails
            $config = array(
                'protocol'  => mails('protocol'),
                'smtp_host' => mails('smtp_host'),
                'smtp_user' => mails('smtp_user'),
                'smtp_pass' => mails('smtp_password'),
                'smtp_port' => mails('smtp_port'),
                'mailtype'  => 'html',
                'starttls'  => true,
                'newline'   => "\r\n",
                'charset'   => "utf-8"
            );

            $this->load->library('email', $config);
            $this->email->from($email_me, $nama_me);
            $this->email->to($email_to); // ganti dengan email tujuan
            $this->email->subject('Ticket Events Medical Top Team');

            $email = $this->load->view('apps/layout/users_events/send_email', $data, TRUE);

            $this->email->message( $email );

            if ($this->email->send()) {
                $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-exclamation-circle"></i> Success ! Email Undangan Berhasil Terkirim.
			                                                </div>');
                //redirect halaman
                redirect('apps/users_events?source=send&utf8=✓');
            }
            else {
                //error message
                show_error($this->email->print_debugger(), true);
            }

        }else{
            show_404();
            return FALSE;
        }
    }

    public function delete()
    {
        if($this->apps->apps_id())
        {
            $id     = $this->encryption->decode($this->uri->segment(4));
            $key['id_user_event'] = $id;
            $this->db->delete("tbl_users_events", $key);
            $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-check"></i> Data Berhasil Dihapus.
			                                                </div>');
            //redirect halaman
            redirect('apps/users_events?source=delete&utf8=✓');
        }else{
            show_404();
            return FALSE;
        }
    }

}
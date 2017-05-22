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
            //config pagination
            $config['base_url'] = base_url().'apps/members/index/';
            $config['total_rows'] = $this->apps->count_members()->num_rows();
            $config['per_page'] = 10;
            //instalasi paging
            $this->pagination->initialize($config);
            //deklare halaman
            $halaman            =  $this->uri->segment(4);
            $halaman            =  $halaman == '' ? 0 : $halaman;
            //create data array
            $data = array(
                'title'           => 'Members ',
                'members'         => TRUE,
                'data_members'   => $this->apps->index_members($halaman,$config['per_page']),
                'paging'          => $this->pagination->create_links()
            );
            if($data['data_members'] != NULL)
            {
                $data['members'] = $data['data_members'];
            }else{
                $data['members'] = NULL;
            }
            //load view with data
            $this->load->view('apps/part/header', $data);
            $this->load->view('apps/part/sidebar');
            $this->load->view('apps/layout/members/data');
            $this->load->view('apps/part/footer');
        }else{
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
                $total  = $this->apps->total_search_members($keyword);
                //config pagination
                $config['base_url'] = base_url().'apps/members/search?q='.$keyword;
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
                    'title'         => 'Members',
                    'members'      => TRUE,
                    'data_members' => $this->apps->search_index_members(strip_tags($keyword),$limit,$offset),
                    'paging'        => $this->pagination->create_links()
                );
                if($data['data_members'] != NULL)
                {
                    $data['members'] = $data['data_members'];
                }else{
                    $data['members'] = '';
                }
                //load view with data
                $this->load->view('apps/part/header', $data);
                $this->load->view('apps/part/sidebar');
                $this->load->view('apps/layout/members/data');
                $this->load->view('apps/part/footer');
            }else{
                redirect('apps/members/');
            }
        }else{
            show_404();
            return FALSE;
        }
    }

    public function confirm($id, $value)
    {
        if($this->apps->apps_id())
        {
            $id_member  = $this->encryption->decode($id);
            $value  = $this->encryption->decode($this->uri->segment(5));
            //where id
            $key['id_member'] = $id_member;
            //update
            $update = array(
                'status' => $value
            );
            //update query
            $this->db->update("tbl_members",$update, $key);
            //send mail

            $query     = $this->db->query("SELECT id_member,email,nama, status FROM tbl_members WHERE id_member='$id_member'")->row();

            if($query->status == "0")
            {
                $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-exclamation-circle"></i> Status Berhasil Diupdate.
			                                                </div>');
                //redirect halaman
                redirect('apps/members?source=send&utf8=✓');

            }else{

                $email_me  = mails('smtp_user');
                $nama_me   = systems('admin_title');

                $email_to  = $query->email;
                //create data array
                $data = array(
                    'nama'              => $query->nama,
                    'email'             => $query->email,
                );

                $config = array(
                    'protocol'  => mails('protocol'),
                    'smtp_host' => mails('smtp_host'),
                    'smtp_user' => mails('smtp_user'),
                    'smtp_pass' => mails('smtp_password'),
                    'smtp_port' => mails('smtp_port'),
                    'mailtype'  => 'html',
                    'charset'   => 'iso-8859-1',
                    'starttls'  => true,
                );
                $this->load->library('email', $config);
                $this->email->set_newline("\r\n");

                $this->email->from($email_me, $nama_me);
                $this->email->to($email_to); // ganti dengan email tujuan
                $this->email->subject('Registrasi Berhasil');

                $email = $this->load->view('apps/layout/members/send_email', $data, TRUE);

                $this->email->message( $email );

                if ($this->email->send()) {
                    $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-exclamation-circle"></i> Status Berhasil Diupdate.
			                                                </div>');
                    //redirect halaman
                    redirect('apps/members?source=send&utf8=✓');
                }
                else {
                    //error message
                    show_error($this->email->print_debugger(), true);
                }

            }
        }else{

        }
    }

    public function add()
    {
        if($this->apps->apps_id())
        {
            $data = array(
                'title'    => 'Add Members ',
                'members' => TRUE,
                'type'     => 'add',
                'select_institusi' => $this->apps->select_institusi()
            );
            //load view with data
            $this->load->view('apps/part/header', $data);
            $this->load->view('apps/part/sidebar');
            $this->load->view('apps/layout/members/add');
            $this->load->view('apps/part/footer');
        }else{
            show_404();
            return FALSE;
        }
    }

    public function edit($id_member)
    {
        if($this->apps->apps_id())
        {
            $id_member = $this->encryption->decode($this->uri->segment(4));

            $data = array(
                'title'    => 'Edit Members ',
                'members' => TRUE,
                'type'     => 'edit',
                'select_institusi' => $this->apps->select_institusi(),
                'data_members'     => $this->apps->edit_members($id_member)->row_array()
            );
            //load view with data
            $this->load->view('apps/part/header', $data);
            $this->load->view('apps/part/sidebar');
            $this->load->view('apps/layout/members/edit');
            $this->load->view('apps/part/footer');
        }else{
            show_404();
            return FALSE;
        }
    }

    public function save()
    {
        if($this->apps->apps_id())
        {
            $id['id_member'] = $this->encryption->decode($this->input->post("id_member"));
            $type = $this->input->post("type");

            if($type == "add"){

                $insert = array(
                    'nama'                          => $this->input->post("nama"),
                    'ttl'                           => $this->input->post("ttl"),
                    'jenis_kelamin'                 => $this->input->post("jenis_kelamin"),
                    'alamat'                        => $this->input->post("alamat"),
                    'institusi_id'                  => $this->input->post("institusi_id"),
                    'email'                         => $this->input->post("email"),
                    'no_telp'                       => $this->input->post("no_telp"),
                    'blog'                          => $this->input->post("blog"),
                    'line'                          => $this->input->post("line"),
                    'bbm'                           => $this->input->post("bbm"),
                    'instagram'                     => $this->input->post("instagram"),
                    'facebook'                      => $this->input->post("facebook"),
                    'riwayat_pendidikan'            => $this->input->post("riwayat_pendidikan"),
                    'riwayat_pengalaman_organisasi' => $this->input->post("riwayat_pengalaman_organisasi"),
                    'agama'                         => $this->input->post("agama"),
                    'telephone_rumah'               => $this->input->post("telephone_rumah"),
                );
                $this->db->insert("tbl_members", $insert);
                //deklarasi session flashdata
                $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-check"></i> Data Berhasil Disimpan.
			                                                </div>');
                //redirect halaman
                redirect('apps/members?source=add&utf8=✓');

            }elseif($type == "edit"){

                $update = array(
                    'nama'                          => $this->input->post("nama"),
                    'ttl'                           => $this->input->post("ttl"),
                    'jenis_kelamin'                 => $this->input->post("jenis_kelamin"),
                    'alamat'                        => $this->input->post("alamat"),
                    'institusi_id'                  => $this->input->post("institusi_id"),
                    'email'                         => $this->input->post("email"),
                    'no_telp'                       => $this->input->post("no_telp"),
                    'blog'                          => $this->input->post("blog"),
                    'line'                          => $this->input->post("line"),
                    'bbm'                           => $this->input->post("bbm"),
                    'instagram'                     => $this->input->post("instagram"),
                    'facebook'                      => $this->input->post("facebook"),
                    'riwayat_pendidikan'            => $this->input->post("riwayat_pendidikan"),
                    'riwayat_pengalaman_organisasi' => $this->input->post("riwayat_pengalaman_organisasi"),
                    'agama'                         => $this->input->post("agama"),
                    'telephone_rumah'               => $this->input->post("telephone_rumah"),
                );
                $this->db->update("tbl_members", $update, $id);
                //deklarasi session flashdata
                $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-check"></i> Data Berhasil Disimpan.
			                                                </div>');
                //redirect halaman
                redirect('apps/members?source=add&utf8=✓');
            }else{
                echo 'variable type not set';
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
            $key['id_member'] = $id;
            $this->db->delete("tbl_members", $key);
            $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-check"></i> Data Berhasil Dihapus.
			                                                </div>');
            //redirect halaman
            redirect('apps/members?source=delete&utf8=✓');
        }else{
            show_404();
            return FALSE;
        }
    }
}
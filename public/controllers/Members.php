<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package  : Medical Top Team.
 * @author   : Fika Ridaul Maulayya <ridaulmaulayya@gmail.com>
 * @since    : 2017
 * @license  : https://maulayya.com/portofolio/medical-top-team/
 */
class Members extends CI_Controller{

    var $CI = NULL;
    public function __construct()
    {
        parent::__construct();
        // get CI's object
        $this->CI =& get_instance();
        //load library
        $this->load->library('form_validation');
        //load model
        $this->load->model(array('apps','web'));
        //get visitor
        $this->web->counter_visitor();
    }

    public function login()
    {
        if($this->session->userdata("member_id"))
        {
            redirect("members");
        }else{
            //check dengan form validation
            $this->form_validation->set_rules('email', 'Alamat Email', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            $this->form_validation->set_message('required', '<div class="alert alert-danger alert-dismissible">
                                                               <i class="fa fa-exclamation-circle"></i> {field} is required.
                                                              </div>');

            if ($this->form_validation->run() == TRUE) {
                $username = $this->input->post("email", TRUE);
                $password = SHA1(MD5(MD5(SHA1($this->input->post('password', TRUE)))));
                //checking data via model
                $checking = $this->apps->check_members('tbl_members', array('email' => $username), array('password' => $password), array('status' => '1'));
                //jika ditemukan, maka create session
                if ($checking != FALSE) {
                    foreach ($checking as $member) {

                        $session_data = array(
                            'member_id'     => $member->id_member,
                            'member_email'  => $member->email,
                            'member_nama'   => $member->nama,
                            'member_foto'   => $member->foto
                        );
                        $this->CI->session->set_userdata($session_data);

                        //calback sesion
                        //return TRUE;

                        redirect('members/');
                    }
                } else {
                    //create data array
                    $data = array(
                        'error' => '<div class="alert alert-danger alert-dismissible">
                                      <i class="fa fa-exclamation-circle"></i> Alamat email atau password salah.
                                      
                                    </div>
                                    <div class="alert alert-danger alert-dismissible">
                                      <i class="fa fa-exclamation-circle"></i> atau akun anda belum diaktifkan.
                                      
                                    </div>',
                        'keywords'         => systems('keywords'),
                        'descriptions'     => systems('descriptions'),
                        'title' => 'Login '
                    );
                    $this->load->view('home/part/header', $data);
                    $this->load->view('home/layout/members/login');
                    $this->load->view('home/part/footer');
                }
            } else {
                //create data array
                $data = array(
                    'title' => 'Login ',
                    'keywords'         => systems('keywords'),
                    'descriptions'     => systems('descriptions'),
                );
                $this->load->view('home/part/header', $data);
                $this->load->view('home/layout/members/login');
                $this->load->view('home/part/footer');
            }
        }
    }

    public function daftar()
    {
        if($this->session->userdata("member_id"))
        {
            redirect("members");
        }else{
            $data = array(
                'title'           => 'Daftar Members ',
                'keywords'         => systems('keywords'),
                'descriptions'     => systems('descriptions'),
                'members'         => TRUE,
                'select_institusi' => $this->apps->select_institusi()
            );
            $this->load->view('home/layout/members/daftar', $data);
        }
    }

    public function index()
    {
        //config pagination
        $config['base_url'] = base_url().'members/index/';
        $config['total_rows'] = $this->web->count_members()->num_rows();
        $config['per_page'] = 2;
        $config['uri_segment'] = 3;
        $config['full_tag_open'] = '<div class="text-center"><ul class="pagination pagination-lg">';
        $config['full_tag_close'] = '</ul></div>';
        $config['cur_tag_open'] = '<li class="active"><a style="background-color: #1abc9c;border-color: #1abc9c">';
        $config['cur_tag_close'] = "</a></li>";
        //instalasi paging
        $this->pagination->initialize($config);
        //deklare halaman
        $halaman            =  $this->uri->segment(3);
        $halaman            =  $halaman == '' ? 0 : $halaman;
        //create data array
        $data = array(
            'title'           => 'Members ',
            'keywords'         => systems('keywords'),
            'descriptions'     => systems('descriptions'),
            'members'         => TRUE,
            'data_members'    => $this->web->index_members($halaman,$config['per_page']),
            'paging'          => $this->pagination->create_links()
        );
        if($data['data_members'] != NULL)
        {
            $data['members'] = $data['data_members'];
        }else{
            $data['members'] = NULL;
        }
        //load views
        $this->load->view('home/part/header', $data);
        $this->load->view('home/layout/members/data');
        $this->load->view('home/part/footer');
    }

    public function search()
    {
        $limit = 10;
        $this->load->helper('security');
        $keyword = $this->security->xss_clean($_GET['q']);
        $data['keyword'] = strip_tags($keyword);
        $check = strlen(preg_replace('/[^a-zA-Z]/', '', $keyword));
        if(!empty($keyword) && $check > 2)
        {
            $offset = (isset($_GET['page'])) ? $this->security->xss_clean($_GET['page']) : 0 ;
            $total  = $this->web->total_search_members($keyword);
            //config pagination
            $config['base_url'] = base_url().'members/search?q='.$keyword;
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
                'title'         => 'Members',
                'keywords'         => systems('keywords'),
                'descriptions'     => systems('descriptions'),
                'members'      => TRUE,
                'data_members' => $this->web->search_index_members(strip_tags($keyword),$limit,$offset),
                'paging'        => $this->pagination->create_links()
            );
            if($data['data_members'] != NULL)
            {
                $data['members'] = $data['data_members'];
            }else{
                $data['members'] = '';
            }
            //load views
            $this->load->view('home/part/header', $data);
            $this->load->view('home/layout/members/data');
            $this->load->view('home/part/footer');
        }else{
            redirect('members/');
        }
    }

    public function detail($id_member)
    {
        if($this->session->userdata("member_id"))
        {
            $id_member = $this->encryption->decode($id_member);
            $data = array(
                'members'          => TRUE,
                'keywords'         => systems('keywords'),
                'descriptions'     => systems('descriptions'),
                'detail_members'   => $this->web->detail_members($id_member),
                'title'            => $this->web->detail_members($id_member)->nama,
                'articles_terbaru' => $this->web->articles_terbaru(),
            );

            $this->load->view('home/part/header', $data);
            $this->load->view('home/layout/members/detail');
            $this->load->view('home/part/footer');
        }else{
            show_404();
            return FALSE;
        }

    }

    public function save()
    {
        //config upload
        $config = array(
            'upload_path' => realpath('resources/images/members/'),
            'allowed_types' => 'jpg|png|jpeg',
            'encrypt_name' => TRUE,
            'remove_spaces' => TRUE,
            'overwrite' => TRUE,
            'max_size' => '5000',
            'max_width' => '5000',
            'max_height' => '5000'
        );
        //load library upload
        $this->load->library("upload", $config);
        //load library lib image
        $this->load->library("image_lib");

        $this->upload->initialize($config);
        if ($this->upload->do_upload("userfile")) {
            $data_upload = $this->upload->data();

            /* PATH */
            $source = realpath('resources/images/members/' . $data_upload['file_name']);
            $destination_thumb = realpath('resources/images/members/thumb/');

            // Permission Configuration
            chmod($source, 0777);

            /* Resizing Processing */
            // Configuration Of Image Manipulation :: Static
            $img['image_library'] = 'GD2';
            $img['create_thumb'] = TRUE;
            $img['maintain_ratio'] = TRUE;

            /// Limit Width Resize
            $limit_thumb = 600;

            // Size Image Limit was using (LIMIT TOP)
            $limit_use = $data_upload['image_width'] > $data_upload['image_height'] ? $data_upload['image_width'] : $data_upload['image_height'];

            // Percentase Resize
            if ($limit_use > $limit_thumb) {
                $percent_thumb = $limit_thumb / $limit_use;
            }

            //// Making THUMBNAIL ///////
            $img['width'] = $limit_use > $limit_thumb ? $data_upload['image_width'] * $percent_thumb : $data_upload['image_width'];
            $img['height'] = $limit_use > $limit_thumb ? $data_upload['image_height'] * $percent_thumb : $data_upload['image_height'];

            // Configuration Of Image Manipulation :: Dynamic
            $img['thumb_marker'] = '';
            $img['quality'] = '100%';
            $img['source_image'] = $source;
            $img['new_image'] = $destination_thumb;

            // Do Resizing
            $this->image_lib->initialize($img);
            $this->image_lib->resize();
            $this->image_lib->clear();

            $insert = array(
                'nama'                          => $this->input->post("nama"),
                'ttl'                           => $this->input->post("ttl"),
                'jenis_kelamin'                 => $this->input->post("jenis_kelamin"),
                'alamat'                        => $this->input->post("alamat"),
                'institusi_id'                  => $this->input->post("institusi_id"),
                'email'                         => $this->input->post("email"),
                'password'                      => SHA1(MD5(MD5(SHA1($this->input->post("password"))))),
                'no_telp'                       => $this->input->post("no_hp"),
                'line'                          => $this->input->post("line"),
                'bbm'                           => $this->input->post("bbm"),
                'instagram'                     => $this->input->post("instagram"),
                'facebook'                      => $this->input->post("facebook"),
                'riwayat_pendidikan'            => $this->input->post("riwayat_pendidikan"),
                'riwayat_pengalaman_organisasi' => $this->input->post("riwayat_pengalaman_organisasi"),
                'agama'                         => $this->input->post("agama"),
                'telephone_rumah'               => $this->input->post("telephone"),
                'foto'                          =>$data_upload['file_name'],
                'status'                        => '0'
            );
            $this->db->insert("tbl_members", $insert);
            //deklarasi session flashdata
            $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible" style="font-family:Roboto">
	                                                    <i class="fa fa-check"></i>
                                                        <h5 class="text-center">
                                                            Terima kasih anda telah melakukan pendaftaran anggota  Perhimpunan Mahasiswa Kesehatan Medical Top Team ( PERMAKES MTT ).
                                                        </h5>
                                                        <h5 class="text-center">
                                                        Selanjutnya, lakukan pembayaran Administrasi sebesar Rp.10.000 - / Tiap bulannya  Melalui BANK BNI ke  Nomor Rekening: 4112016039 (A.n. Medical Top Team SUMUT) 
                                                        Kirim bukti transfer anda melalui BMM / Line 
                                                        </h5>
                                                        <h5 class="text-center">
                                                             NB :Demi Kenyamanan Diharapkan membayar iruan per tahun
                                                        </h5>
                                                        



                                                       


	                                                </div>
                                                    <br>

                                                    ');
            //redirect halaman
            redirect('members?source=register&utf8=✓');
        } else {
            $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-exclamation-circle"></i> Pendaftaran member gagal! ' . $this->upload->display_errors() . '
			                                                </div>');
            redirect('members?source=register&error&utf8=✓');
        }
    }

    public function logout()
    {
        if($this->session->userdata("member_id"))
        {
            $this->session->sess_destroy();
            redirect('members/login?source=logout&utf8=✓');
        }else{
            show_404();
            return FALSE;
        }
    }

}
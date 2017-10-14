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
            //$this->form_validation->set_rules('konfirm_password', 'Confirm Password', 'required|matches[password]');

            
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

    public function forgot()
    {
        if($this->session->userdata("member_id"))
        {
            redirect("members");
        }else{
            
              //get form input
                $email_address  = $this->apps->check_one('tbl_members', array('email' => $this->input->post("email")));
                //set form validation
                $this->form_validation->set_rules('email', 'Alamat Email', 'trim|required');
               //$this->form_validation->set_rules('g-recaptcha-response', '<b>Captcha</b>', 'callback_getResponseCaptcha');
                $this->form_validation->set_message('required', '<div class="alert alert-danger" style="margin-top: 3px">
                    <div class="header"><b><i class="fa fa-exclamation-circle"></i> {field}</b> harus diisi</div> </div>');
                if($this->form_validation->run() == TRUE)
                {
                    if($email_address != FALSE)
                    {
                        $email_me  = mails('smtp_user');
                        $nama_me   = 'Administrator - Medicat Top Team';
                        $email_to  = $this->input->post("email");
                        $query     = $this->db->query("SELECT id_member FROM tbl_members WHERE email='$email_to'")->row();
                        $this->load->helper('string');
                        $password= random_string('alnum', 6);
                        $this->db->where('id_member', $query->id_member);
                        $this->db->update('tbl_members',array('password'=>SHA1(MD5(MD5(SHA1($password))))));
                        $config = array(
                            'protocol'  => mails('protocol'),
                            'smtp_host' => mails('smtp_host'),
                            'smtp_user' => mails('smtp_user'),
                            'smtp_pass' => mails('smtp_password'),
                            'smtp_port' => mails('smtp_port'),
                            'mailtype'  => 'html',
                            'starttls'  => true,
                            'newline'   => "\r\n"
                        );

                        $this->load->library('email', $config);
                        $this->email->from($email_me, $nama_me);
                        $this->email->to($email_to); // ganti dengan email tujuan
                        $this->email->subject('Kata Sandi Akun Medical Top Team Anda Telah Diubah');
                        $data = array( 'message' => "Permintaan password baru Anda adalah : <b>".$password."</b>");
                        $email = $this->load->view('home/layout/members/reset_password', $data, TRUE);

                        $this->email->message( $email );

                        if ($this->email->send()) {
                            $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible" style="font-family:Roboto">
                               <i class="fa fa-check-circle"></i> Berhasil! Silakan periksa email Anda atau di folder spam
                                                            </div>');
                            //redirect halaman
                            redirect('members/login/forgot?source=send&utf8=✓');
                        }
                        else {
                            show_error($this->email->print_debugger(), true);
                        }
                    }else{
                        $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible" style="font-family:Roboto">
                           <i class="fa fa-exclamation-circle"></i> Gagal! Alamat email tidak terdaftar.
                                                            </div>');
                        //redirect halaman
                        redirect('members/forgot?source=send&utf8=✓');
                    }
                }else{

                    //create data array
                    $data = array(
                        'title' => 'Forgot Password ',
                        'keywords'         => systems('keywords'),
                        'descriptions'     => systems('descriptions'),
                    );
                    $this->load->view('home/part/header', $data);
                    $this->load->view('home/layout/members/forgot');
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
        $config['per_page'] = 10;
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

        $check_email = $this->apps->check_one('tbl_members', array('email' => $this->input->post("email")));

        if($check_email != FALSE)
        {
            $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-exclamation-circle"></i> Error! Alamat Email sudah terdaftar.
			                                                </div>');
            //redirect halaman
            redirect('members?source=error&utf8=✓');
        }else {

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
                    'blog'                          => $this->input->post("blog"),
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
                                                        <h5 class="text-left">
                                                            Terima Kasih anda telah terdaftar menjadi anggota Perhimpunan Mahasiswa Kesehatan Medical Top Team (PERMAKES MTT).
                                                        </h5>
                                                        <h5 class="text-left">
                                                        Selanjutnya, Akun anda akan bisa diakses Maximal 3x24 Jam setelah kami konfirmasi. Silahkan Scan Barcode dibawah ini dan berbagung dalam grup What"s UP "PERMAKES MTT INDONESIA"
                                                        </h5>

                                                        <img src="resources/images/scan-disini/scan.jpeg" width="500px" class="img-responsive center-block">


                                                        

                                                        <ul>
                                                            <li>
                                                                <h5 class="text-left">
                                                                 Dapatkan 
                                                                </h5>
                                                            </li>
                                                            <li>
                                                                <h5 class="text-left">Kartu Anggota</h5>
                                                            </li>
                                                            <li>
                                                                <h5 class="text-left">Baju PERMAKES MTT</h5>
                                                            </li>
                                                            <li>
                                                                <h5 class="text-left">Membership Discount Seminar, Workshop, Pelatihan dll
                                                                Berlaku Seumur Hidup.</h5>
                                                            </li>
                                                        </ul>

                                                        <h5 class="text-left">
                                                       Lakukan Transfer Senilai Rp.200.000 
                                                            Melalui Nomor Rekening Bank BNI  4112016039 (A.N Medical Top Team SUMUT)  kirim bukti transaksi anda pada grup What"s UP "PERMAKES MTT INDONESIA" 
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

    public function profile()
    {
        $id_member = $this->session->userdata("member_id");
        if($id_member != '')
        {
            $data = array(
                'title'           => 'Daftar Members ',
                'keywords'         => systems('keywords'),
                'descriptions'     => systems('descriptions'),
                'members'         => TRUE,
                'select_institusi' => $this->apps->select_institusi(),
                'detail_members'   => $this->web->detail_members($id_member),
            );
             
            $this->load->view('home/layout/members/edit', $data);
        }       
    }
    public function updateprofile()
    {
       if (empty($_FILES['userfile']['name'])) //tanpa
       {    
          $id_member = $this->session->userdata("member_id");

          $password = $this->input->post('password');

          if ($password !== '') //jika password tidak kosong maka update
          {
                 $data = array(
                    'nama'                          => $this->input->post("nama"),
                    'ttl'                           => $this->input->post("ttl"),
                    'jenis_kelamin'                 => $this->input->post("jenis_kelamin"),
                    'alamat'                        => $this->input->post("alamat"),
                    'institusi_id'                  => $this->input->post("institusi_id"),
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
                 );
          }
          else
          {
            $data = array(
                    'nama'                          => $this->input->post("nama"),
                    'ttl'                           => $this->input->post("ttl"),
                    'jenis_kelamin'                 => $this->input->post("jenis_kelamin"),
                    'alamat'                        => $this->input->post("alamat"),
                    'institusi_id'                  => $this->input->post("institusi_id"),
                    'no_telp'                       => $this->input->post("no_hp"),
                    'line'                          => $this->input->post("line"),
                    'bbm'                           => $this->input->post("bbm"),
                    'instagram'                     => $this->input->post("instagram"),
                    'facebook'                      => $this->input->post("facebook"),
                    'riwayat_pendidikan'            => $this->input->post("riwayat_pendidikan"),
                    'riwayat_pengalaman_organisasi' => $this->input->post("riwayat_pengalaman_organisasi"),
                    'agama'                         => $this->input->post("agama"),
                    'telephone_rumah'               => $this->input->post("telephone"),
                );
          }

            $this->db->where('id_member', $id_member);
            $this->db->update('tbl_members',$data);
            //deklarasi session flashdata
            $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible" style="font-family:Roboto">
                                                    <i class="fa fa-check"></i>
                                                    <h5 class="text-center">
                                                       Data Anda telah berhasil di update
                                                    </h5>
                                                    
                                              </div>');
            //redirect halaman
            redirect('members?source=register&utf8=✓');
       }
       else
       {  
            $id_member = $this->session->userdata("member_id");

            $password = $this->input->post('password');

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



              $password = $this->input->post('password');

              if ($password !== '') //jika password tidak kosong maka update
              { 
                    $data = array(
                    'nama'                          => $this->input->post("nama"),
                    'ttl'                           => $this->input->post("ttl"),
                    'jenis_kelamin'                 => $this->input->post("jenis_kelamin"),
                    'alamat'                        => $this->input->post("alamat"),
                    'institusi_id'                  => $this->input->post("institusi_id"),
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
                 );
                    
              }
              else
              {
                    $data = array(
                    'nama'                          => $this->input->post("nama"),
                    'ttl'                           => $this->input->post("ttl"),
                    'jenis_kelamin'                 => $this->input->post("jenis_kelamin"),
                    'alamat'                        => $this->input->post("alamat"),
                    'institusi_id'                  => $this->input->post("institusi_id"),
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
                 );

                    

              }
 


             $this->db->where('id_member', $id_member);
            $this->db->update('tbl_members',$data);
            //deklarasi session flashdata
            $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible" style="font-family:Roboto">
                                                    <i class="fa fa-check"></i>
                                                    <h5 class="text-center">
                                                       Data Anda telah berhasil di update
                                                    </h5>
                                                    
                                              </div>');
            //redirect halaman
            redirect('members?source=register&utf8=✓');

            } else {
                $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible" style="font-family:Roboto">
                                                                <i class="fa fa-exclamation-circle"></i> Pendaftaran member gagal! ' . $this->upload->display_errors() . '
                                                            </div>');
                redirect('members/profile');
            }
          
       }
    }

}

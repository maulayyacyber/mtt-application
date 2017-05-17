<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package  : Medical Top Team.
 * @author   : Fika Ridaul Maulayya <ridaulmaulayya@gmail.com>
 * @since    : 2017
 * @license  : https://maulayya.com/portofolio/medical-top-team/
 */
class Gallery extends CI_Controller{

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
            $config['base_url'] = base_url().'apps/gallery/index/';
            $config['total_rows'] = $this->apps->count_album()->num_rows();
            $config['per_page'] = 10;
            //instalasi paging
            $this->pagination->initialize($config);
            //deklare halaman
            $halaman            =  $this->uri->segment(4);
            $halaman            =  $halaman == '' ? 0 : $halaman;
            //create data array
            $data = array(
                'title'           => 'Album Gallery',
                'gallery'         => TRUE,
                'data_album'   => $this->apps->index_album($halaman,$config['per_page']),
                'paging'          => $this->pagination->create_links()
            );
            if($data['data_album'] != NULL)
            {
                $data['album'] = $data['data_album'];
            }else{
                $data['album'] = NULL;
            }
            $this->load->view('apps/part/header', $data);
            $this->load->view('apps/part/sidebar');
            $this->load->view('apps/layout/gallery/data_album');
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
                $total  = $this->apps->total_search_album($keyword);
                //config pagination
                $config['base_url'] = base_url().'apps/gallery/search?q='.$keyword;
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
                    'title'         => 'Album Gallery',
                    'gallery'       => TRUE,
                    'data_album'    => $this->apps->search_index_album(strip_tags($keyword),$limit,$offset),
                    'paging'        => $this->pagination->create_links()
                );
                if($data['data_album'] != NULL)
                {
                    $data['album'] = $data['data_album'];
                }else{
                    $data['album'] = '';
                }
                //load view with data
                $this->load->view('apps/part/header', $data);
                $this->load->view('apps/part/sidebar');
                $this->load->view('apps/layout/gallery/data_album');
                $this->load->view('apps/part/footer');
            }else{
                redirect('apps/gallery/');
            }
        }else{
            show_404();
            return FALSE;
        }
    }

    public function add()
    {
        if($this->apps->apps_id())
        {
            $data = array(
                'title'    => 'Add Album Gallery ',
                'gallery'  => TRUE,
                'type'     => 'add'
            );
            //load view with data
            $this->load->view('apps/part/header', $data);
            $this->load->view('apps/part/sidebar');
            $this->load->view('apps/layout/gallery/add_album');
            $this->load->view('apps/part/footer');
        }else{
            show_404();
            return FALSE;
        }
    }

    public function edit($id_album)
    {
        $id_album = $this->encryption->decode($this->uri->segment(4));

        if($this->apps->apps_id())
        {
            $data = array(
                'title'    => 'Edit Album Gallery ',
                'gallery'  => TRUE,
                'type'     => 'edit',
                'data_album'   => $this->apps->edit_album($id_album)->row_array()
            );
            //load view with data
            $this->load->view('apps/part/header', $data);
            $this->load->view('apps/part/sidebar');
            $this->load->view('apps/layout/gallery/edit_album');
            $this->load->view('apps/part/footer');
        }else{
            show_404();
            return FALSE;
        }
    }

    public function save()
    {
        if($this->apps->apps_id()) {
            $type = $this->input->post("type");
            $id['id_album'] = $this->encryption->decode($this->input->post("id_album"));

            if($type == "add"){

                $insert = array(
                            'nama_album' => $this->input->post("nama_album"),
                            'updated_at' => date("Y-m-d H:i:s")
                );
                $this->db->insert("tbl_album", $insert);
                //deklarasi session flashdata
                $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-check"></i> Data Berhasil Disimpan.
			                                                </div>');
                //redirect halaman
                redirect('apps/gallery?source=add&utf8=✓');

            }elseif($type == "edit"){

                $update = array(
                    'nama_album' => $this->input->post("nama_album"),
                    'updated_at' => date("Y-m-d H:i:s")
                );
                $this->db->update("tbl_album", $update, $id);
                //deklarasi session flashdata
                $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-check"></i> Data Berhasil Diupdate.
			                                                </div>');
                //redirect halaman
                redirect('apps/gallery?source=edit&utf8=✓');

            }else{

                echo 'variable type not valid';

            }

        }else{
            show_404();
            return FALSE;
        }
    }

    public function delete_dir($src) {
        $dir = opendir($src);
        while(false !== ( $file = readdir($dir)) ) {
            if (( $file != '.' ) && ( $file != '..' )) {
                if ( is_dir($src . '/' . $file) ) {
                    rmdir($src . '/' . $file);
                }
                else {
                    unlink($src . '/' . $file);
                }
            }
        }
        rmdir($src);
        closedir($dir);
    }

    public function delete()
    {
        if($this->apps->apps_id())
        {
            $id_album     = $this->encryption->decode($this->uri->segment(4));
            $query = $this->db->query("SELECT nama_album FROM tbl_album WHERE id_album='$id_album'")->row();
            // Delete FOlder
            $path = "./resources/foto_gallery/";
            $folder = url_title(strtolower($query->nama_album));
            if(is_dir($path.$folder)){

                $this->delete_dir($path.$folder);
            }
            $id['id_album'] = $id_album;
            $this->db->delete("tbl_album",$id);
            $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-check"></i> Data Berhasil Dihapus.
			                                                </div>');
            //redirect halaman
            redirect('apps/gallery?source=delete&utf8=✓');
        }else{
            show_404();
            return FALSE;
        }
    }

    //fungsi foto gallery

    public function add_picture($id_album)
    {
        if($this->apps->apps_id())
        {
            $id_album = $this->encryption->decode($this->uri->segment(4));

            $query = $this->db->query("SELECT nama_album FROM tbl_album WHERE id_album='$id_album'")->row();

            $path = "./resources/foto_gallery/";
            $folder = url_title(strtolower($query->nama_album));
            $dir_exist = true;
            if(!is_dir($path.$folder)) //create the folder if it's not already exists
            {
                mkdir($path.$folder,0777,TRUE);
                $dir_exist = false;
            }

            //config pagination
            $config['base_url'] = base_url().'apps/gallery/adda_picture/'.$this->encryption->encode($id_album).'/index/';
            $config['total_rows'] = $this->apps->count_album_picture($id_album);
            $config['per_page'] = 50;
            //instalasi paging
            $this->pagination->initialize($config);
            //deklare halaman
            $halaman            =  $this->uri->segment(6);
            $halaman            =  $halaman == '' ? 0 : $halaman;
            //create data array
            $data = array(
                'title'           => 'Tambah Gambar Album',
                'gallery'         => TRUE,
                'id_album'        => $id_album,
                'data_album'      => $this->apps->index_album_picture($halaman,$config['per_page'],$id_album),
                'paging'          => $this->pagination->create_links()
            );
            if($data['data_album'] != NULL)
            {
                $data['album'] = $data['data_album'];
            }else{
                $data['album'] = NULL;
            }
            $this->load->view('apps/part/header', $data);
            $this->load->view('apps/part/sidebar');
            $this->load->view('apps/layout/gallery/data_album_foto');
            $this->load->view('apps/part/footer');

        }else{
            show_404();
            return FALSE;
        }
    }

    public function upload()
    {
        if($this->apps->apps_id())
        {
            $id_album = $this->encryption->decode($this->input->post('id_album'));
            $query = $this->db->query("SELECT nama_album FROM tbl_album WHERE id_album='$id_album'")->row();
            $folder = url_title(strtolower($query->nama_album));
            $upload_conf = array(
                'upload_path'   => realpath('resources/foto_gallery/'.$folder),
                'allowed_types' => 'gif|jpg|png|jpeg',
                'max_size'      => '50000',
                'encrypt_name'  => TRUE
            );

            $this->upload->initialize( $upload_conf );

            // Change $_FILES to new vars and loop them
            foreach($_FILES['files'] as $key=>$val)
            {
                $i = 1;
                foreach($val as $v)
                {
                    $field_name = "file_".$i;
                    $_FILES[$field_name][$key] = $v;
                    $i++;
                }
            }
            // Unset the useless one ;)
            unset($_FILES['files']);

            // Put each errors and upload data to an array
            $error = array();
            $success = array();

            // main action to upload each file
            foreach($_FILES as $field_name => $file)
            {
                if ( ! $this->upload->do_upload($field_name))
                {
                    // if upload fail, grab error
                    $error['upload'][] = $this->upload->display_errors();
                }
                else
                {

                    // otherwise, put the upload datas here.
                    // if you want to use database, put insert query in this loop
                    $upload_data = $this->upload->data();
                    // set the resize config
                    $resize_conf = array(
                        // it's something like "/full/path/to/the/image.jpg" maybe
                        'image_library' => 'gd2',
                        'source_image'  => $upload_data['full_path'],
                        // and it's "/full/path/to/the/" + "thumb_" + "image.jpg
                        // or you can use 'create_thumbs' => true option instead
                        'new_image'     => $upload_data['file_path'].'images_'.$upload_data['file_name'],
                        //'wm_overlay_path' => realpath('assets/admin/img/watermark.png'),
                        'wm_vrt_alignment' => 'bottom',
                        'wm_hor_alignment' => 'right',
                        'wm_opacity' => 1,
                        'wm_type' => 'overlay',
                    );
                    // initializing
                    $this->image_lib->initialize($resize_conf);
                    $pic = 'images_'.$upload_data['file_name'];
                    $query = $this->db->query("SELECT foto_gallery FROM tbl_foto_gallery WHERE foto_gallery='$pic' AND album_id='$id_album'");
                    if(!$query->num_rows()>0){

                        $insert['album_id'] = $id_album;
                        $insert['foto_gallery'] = $pic;
                        $insert['caption_foto'] = $this->input->post("caption_foto");
                        $insert['updated_at'] = date("Y-m-d H:i:s");

                        $this->db->insert("tbl_foto_gallery",$insert);
                    }
                    // do it!
                    if (!$this->image_lib->resize())
                    {
                        // if got fail.
                        $error['resize'][] = $this->image_lib->display_errors();
                    }
                    else
                    {
                        // otherwise, put each upload data to an array.
                        $this->image_lib->watermark();
                        $this->image_lib->clear();
                        $success[] = $upload_data;
                        $sukses .= $pic.'<br/>';
                    }
                    unlink(realpath('resources/foto_gallery/'.$folder.'/'.$upload_data['file_name']));
                }
            }

            // see what we get
            if(count($error) > 0)
            {
                $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-exclamation-circle"></i> Data Gagal Diupload ' . $this->upload->display_errors('') . '
			                                                </div>');
            }
            else
            {
                $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-check"></i> Data Berhasil Diupload.
			                                                </div>');
            }

            redirect('apps/gallery/add_picture/'.$this->encryption->encode($id_album).'');

        }else{
            show_404();
            return FALSE;
        }
    }

}
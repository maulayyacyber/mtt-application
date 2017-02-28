<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package  : Medical Top Team.
 * @author   : Fika Ridaul Maulayya <ridaulmaulayya@gmail.com>
 * @since    : 2017
 * @license  : https://maulayya.com/portofolio/medical-top-team/
 */
class Articles extends CI_Controller{

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
            $config['base_url'] = base_url().'apps/articles/index/';
            $config['total_rows'] = $this->apps->count_articles()->num_rows();
            $config['per_page'] = 10;
            //instalasi paging
            $this->pagination->initialize($config);
            //deklare halaman
            $halaman            =  $this->uri->segment(4);
            $halaman            =  $halaman == '' ? 0 : $halaman;
            //create data array
            $data = array(
                'title'           => 'Articles',
                'articles'        => TRUE,
                'data_articles'   => $this->apps->index_articles($halaman,$config['per_page']),
                'paging'          => $this->pagination->create_links()
            );
            if($data['data_articles'] != NULL)
            {
                $data['articles'] = $data['data_articles'];
            }else{
                $data['articles'] = NULL;
            }
            //load view with data
            $this->load->view('apps/part/header', $data);
            $this->load->view('apps/part/sidebar');
            $this->load->view('apps/layout/articles/data');
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
                $total  = $this->apps->total_search_articles($keyword);
                //config pagination
                $config['base_url'] = base_url().'apps/articles/search?q='.$keyword;
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
                    'title'         => 'Articles',
                    'articles'      => TRUE,
                    'data_articles' => $this->apps->search_index_articles(strip_tags($keyword),$limit,$offset),
                    'paging'        => $this->pagination->create_links()
                );
                if($data['data_articles'] != NULL)
                {
                    $data['articles'] = $data['data_articles'];
                }else{
                    $data['articles'] = '';
                }
                //load view with data
                $this->load->view('apps/part/header', $data);
                $this->load->view('apps/part/sidebar');
                $this->load->view('apps/layout/articles/data');
                $this->load->view('apps/part/footer');
            }else{
                redirect('apps/articles/');
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
                'title'    => 'Add Articles ',
                'articles' => TRUE,
                'type'     => 'add'
            );
            //load view with data
            $this->load->view('apps/part/header', $data);
            $this->load->view('apps/part/sidebar');
            $this->load->view('apps/layout/articles/add');
            $this->load->view('apps/part/footer');
        }else{
            show_404();
            return FALSE;
        }
    }

    public function edit($id_articles)
    {
        $id_articles = $this->encryption->decode($this->uri->segment(4));

        if($this->apps->apps_id())
        {
            $data = array(
                'title'    => 'Edit Articles ',
                'articles' => TRUE,
                'type'     => 'edit',
                'data_articles'   => $this->apps->edit_articles($id_articles)->row_array()
            );
            //load view with data
            $this->load->view('apps/part/header', $data);
            $this->load->view('apps/part/sidebar');
            $this->load->view('apps/layout/articles/edit');
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
            $type = $this->input->post("type");
            $id['id_articles'] = $this->encryption->decode($this->input->post("id_articles"));

            if($type == "add")
            {

                //config upload
                $config = array(
                    'upload_path' => realpath('resources/images/articles/'),
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
                    $source = realpath('resources/images/articles/' . $data_upload['file_name']);
                    $destination_thumb = realpath('resources/images/articles/thumb/');

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
                        'judul_articles'    => $this->input->post("judul"),
                        'slug'              => url_title(strtolower($this->input->post("judul"))),
                        'user_id'           => $this->session->userdata("apps_id"),
                        'isi_articles'      => $this->input->post("isi"),
                        'meta_keywords'     => $this->input->post("meta_keywords"),
                        'meta_descriptions' => $this->input->post("meta_descriptions"),
                        'thumbnail'         => $data_upload['file_name'],
                        'created_at'        => date("Y-m-d H:i:s")
                    );
                    $this->db->insert("tbl_articles", $insert);
                    //deklarasi session flashdata
                    $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-check"></i> Data Berhasil Disimpan.
			                                                </div>');
                    //redirect halaman
                    redirect('apps/articles?source=add&utf8=✓');
                } else {
                    $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-exclamation-circle"></i> Data Gagal Disimpan ' . $this->upload->display_errors() . '
			                                                </div>');
                    redirect('apps/articles?source=add&error&utf8=✓');
                }

            }elseif($type == "edit"){

                if (empty($_FILES['userfile']['name'])) {

                    $update = array(
                        'judul_articles'    => $this->input->post("judul"),
                        'slug'              => url_title(strtolower($this->input->post("judul"))),
                        'user_id'           => $this->session->userdata("apps_id"),
                        'isi_articles'      => $this->input->post("isi"),
                        'meta_keywords'     => $this->input->post("meta_keywords"),
                        'meta_descriptions' => $this->input->post("meta_descriptions"),
                        'updated_at'        => date("Y-m-d H:i:s")
                    );
                    $this->db->update("tbl_articles", $update, $id);
                    //deklarasi session flashdata
                    $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-check"></i> Data Berhasil Disimpan.
			                                                </div>');
                    //redirect halaman
                    redirect('apps/articles?source=add&utf8=✓');

                }else{

                    //config upload
                    $config = array(
                        'upload_path' => realpath('resources/images/articles/'),
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
                        $source = realpath('resources/images/articles/' . $data_upload['file_name']);
                        $destination_thumb = realpath('resources/images/articles/thumb/');
                        $source_old = realpath('resources/images/articles/thumb/' . $foto_thumbnail . '');

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

                        $update = array(
                            'judul_articles'    => $this->input->post("judul"),
                            'slug'              => url_title(strtolower($this->input->post("judul"))),
                            'user_id'           => $this->session->userdata("apps_id"),
                            'isi_articles'      => $this->input->post("isi"),
                            'meta_keywords'     => $this->input->post("meta_keywords"),
                            'meta_descriptions' => $this->input->post("meta_descriptions"),
                            'thumbnail'         => $data_upload['file_name'],
                            'updated_at'        => date("Y-m-d H:i:s")
                        );
                        $this->db->update("tbl_articles", $update, $id);
                        //deklarasi session flashdata
                        $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-check"></i> Data Berhasil Diupdate.
			                                                </div>');
                        //redirect halaman
                        redirect('apps/articles?source=edit&utf8=✓');
                    } else {
                        $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-exclamation-circle"></i> Data Gagal Diupdate ' . $this->upload->display_errors('') . '
			                                                </div>');
                        redirect('apps/articles?source=edit&utf8=✓');
                    }
                }

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
            $query  = $this->db->query("SELECT id_articles, thumbnail FROM tbl_articles WHERE id_articles ='$id'")->row();
            unlink(realpath('resources/images/articles/'.$query->thumbnail));
            unlink(realpath('resources/images/articles/thumb/'.$query->thumbnail));
            $key['id_articles'] = $id;
            $this->db->delete("tbl_articles", $key);
            $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-check"></i> Data Berhasil Dihapus.
			                                                </div>');
            //redirect halaman
            redirect('apps/articles?source=delete&utf8=✓');
        }else{
            show_404();
            return FALSE;
        }
    }
}
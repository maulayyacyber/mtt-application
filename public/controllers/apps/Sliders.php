<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sliders extends CI_Controller {

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
            //create data array
            $data = array(
                'title' 		=> 'Sliders',
                'sliders'		=> TRUE,
                'data_sliders'	=> $this->apps->index_sliders()
            );
            $this->load->view('apps/part/header', $data);
            $this->load->view('apps/part/sidebar');
            $this->load->view('apps/layout/sliders/data');
            $this->load->view('apps/part/footer');
        }else{
            //show 404
            show_404();
            return FALSE;
        }
    }

    function save()
    {
        if($this->apps->apps_id())
        {
            //config upload
            $config = array(
                'upload_path'   => realpath('resources/images/sliders/'),
                'allowed_types' =>'jpg|png|jpeg',
                'encrypt_name'  =>TRUE,
                'remove_spaces' =>TRUE,
                'overwrite'     =>TRUE,
                'max_size'      =>'5000',
                'max_width'     =>'5000',
                'max_height'    =>'5000'
            );
            //load library upload
            $this->load->library("upload",$config);
            //load library lib image
            $this->load->library("image_lib");

            $this->upload->initialize($config);
            if($this->upload->do_upload("userfile"))
            {
                $data_upload    = $this->upload->data();

                /* PATH */
                $source             = realpath('resources/images/sliders/'.$data_upload['file_name']);
                $destination_thumb  = realpath('resources/images/sliders/thumb/');

                // Permission Configuration
                chmod($source, 0777) ;

                /* Resizing Processing */
                // Configuration Of Image Manipulation :: Static
                $img['image_library'] = 'GD2';
                $img['create_thumb']  = TRUE;
                $img['maintain_ratio']= TRUE;

                /// Limit Width Resize
                $limit_thumb    = 600 ;

                // Size Image Limit was using (LIMIT TOP)
                $limit_use  = $data_upload['image_width'] > $data_upload['image_height'] ? $data_upload['image_width'] : $data_upload['image_height'] ;

                // Percentase Resize
                if ($limit_use > $limit_thumb) {
                    $percent_thumb  = $limit_thumb/$limit_use ;
                }

                //// Making THUMBNAIL ///////
                $img['width']  = $limit_use > $limit_thumb ?  $data_upload['image_width'] * $percent_thumb : $data_upload['image_width'] ;
                $img['height'] = $limit_use > $limit_thumb ?  $data_upload['image_height'] * $percent_thumb : $data_upload['image_height'] ;

                // Configuration Of Image Manipulation :: Dynamic
                $img['thumb_marker'] = '';
                $img['quality']      = '100%' ;
                $img['source_image'] = $source ;
                $img['new_image']    = $destination_thumb ;

                // Do Resizing
                $this->image_lib->initialize($img);
                $this->image_lib->resize();
                $this->image_lib->clear() ;

                $insert = array(
                    'link_slider'        => $this->input->post("link"),
                    'image_slider'       => $data_upload['file_name']
                );
                $this->db->insert("tbl_slider",$insert);
                //deklarasi session flashdata
                $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible" style="font-family:Roboto">
					                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			                                                    <i class="fa fa-check"></i> Data Berhasil Disimpan.
			                                                </div>');
                //redirect halaman
                redirect('apps/sliders/');
            }else{
                $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible" style="font-family:Roboto">
					                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			                                                    <i class="fa fa-check"></i> Data Gagal Disimpan '.$this->upload->display_errors('').'
			                                                </div>');
                redirect('apps/sliders/');
            }

        }else{
            //show 404
            show_404();
            return FALSE;
        }
    }

    public function delete()
    {
        if($this->apps->apps_id())
        {
            $id     = $this->encryption->decode($this->uri->segment(4));
            $query  = $this->db->query("SELECT id_slider, image_slider FROM tbl_slider WHERE id_slider ='$id'")->row();
            unlink(realpath('resources/images/sliders/'.$query->image_slider));
            unlink(realpath('resources/images/sliders/'.$query->image_slider));
            $key['id_slider'] = $id;
            $this->db->delete("tbl_slider", $key);
            $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-check"></i> Data Berhasil Dihapus.
			                                                </div>');
            //redirect halaman
            redirect('apps/sliders?source=delete&utf8=✓');
        }else{
            //show 404
            show_404();
            return FALSE;
        }
    }


}
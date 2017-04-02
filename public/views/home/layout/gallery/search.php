<!--=== News Block ===-->
<div class="bg-color-light">
    <div class="container content-sm">
        <div class="text-center margin-bottom-50">
            <h2 class="title-v2 title-center">ALBUM GALLERY</h2>
        </div>

        <div class="row news-v2">
            <div class="col-md-12" style="margin-bottom: 20px">
                <?php echo $this->session->flashdata('notif') ?>
                <div class="search-events" style="text-align: center">
                    <form method="GET" action="<?php echo base_url('gallery/search');?>" style="margin-top: 10px">
                        <div class = "input-group">
                            <input type = "text" name = "q" class = "form-control input-lg" placeholder="Masukkan Nama Album dan Enter" autocomplete="off" id="articles">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <span class = "input-group-btn">
                                  <button class = "btn btn-default btn-lg" type = "submit">
                                     <i class="fa fa-search"></i> Search
                                  </button>
                               </span>
                        </div>
                    </form>
                </div>
            </div>
            <?php
                if($gallery != NULL):
                foreach($gallery->result() as $hasil):

                    if(strlen($hasil->nama_album)<40)
                    {
                        $judul = '<h3><a href="'.base_url('gallery/foto').'/'.$this->encryption->encode($hasil->id_album).'/" style="text-decoration:none">'.$hasil->nama_album.'</a></h3>';
                    }else{
                        $judul = '<h3><a href="'.base_url('gallery/foto').'/'.$this->encryption->encode($hasil->id_album).'/" style="text-decoration:none" title="'.$hasil->nama_album.'">'.substr($hasil->nama_album, 0,40).'...</a></h3>';

                    }
            ?>
                    <div class="col-md-3" style="margin-bottom: 20px">
                        <div class="news-v2-badge">
                            <img class="img-responsive" src="<?php echo base_url() ?>resources/foto_gallery/album.png" alt="">

                        </div>
                        <div class="news-v2-desc bg-color-light" style="-moz-box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);webkit-box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12);">
                            <?php echo $judul ?>
                        </div>
                    </div>

            <?php
                endforeach;
            ?>
            <?php else : ?>

            <?php endif; ?>
            </div>
        </div>
        <div class="row" style="text-align: center;margin-top: 20px">
            <?php echo $paging ?>
        </div>
    </div>
</div>
<!--=== End News Block ===-->
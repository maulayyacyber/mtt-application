<!--=== News Block ===-->
<div class="bg-color-light">
    <div class="container content-sm">
        <div class="text-center margin-bottom-50">
            <h2 class="title-v2 title-center">BERITA HARI INI</h2>
        </div>

        <div class="row news-v2">
            <div class="col-md-12" style="margin-bottom: 20px">
                <div class="search-events" style="text-align: center">
                    <form method="GET" action="<?php echo base_url('articles/search');?>" style="margin-top: 10px">
                        <div class = "input-group">
                            <input type = "text" name = "q" class = "form-control input-lg" placeholder="Masukkan Judul Articles dan Enter" autocomplete="off" id="articles">
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
            if($articles!= NULL):
            foreach($articles->result() as $hasil):

                if(strlen($hasil->judul_articles)<40)
                {
                    $judul = '<h3><a href="'.base_url('articles/read').'/'.$hasil->slug.'/" style="text-decoration:none">'.$hasil->judul_articles.'</a></h3>';
                }else{
                    $judul = '<h3><a href="'.base_url('articles/read').'/'.$hasil->slug.'/" style="text-decoration:none" title="'.$hasil->judul_articles.'">'.substr($hasil->judul_articles, 0,40).'...</a></h3>';

                }

                if(strlen($hasil->meta_descriptions) < 50)
                {
                    $descriptions = '<p>'.$hasil->meta_descriptions.'</p>';
                }else{
                    $descriptions = '<p>'.substr($hasil->meta_descriptions, 0,50).'...</p>';
                }
                ?>

                <div class="col-md-3" style="margin-bottom: 20px">
                    <div class="news-v2-badge">
                        <img class="img-responsive" src="<?php echo base_url() ?>resources/images/articles/thumb/<?php echo $hasil->thumbnail ?>" alt="">
                        <p>
                            <span> <?php echo $this->web->tgl_tunggal($hasil->created_at) ?></span>
                            <small><?php echo $this->web->bulan_inggris($hasil->created_at) ?></small>
                        </p>
                    </div>
                    <div class="news-v2-desc bg-color-light" style="-moz-box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);webkit-box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12);">
                        <?php echo $judul ?>
                        <small><i class="fa fa-user-circle"></i>  <?php echo $hasil->nama_user ?> </small>
                        <?php echo $descriptions ?>
                    </div>
                </div>


                <?php
            endforeach;
            ?>
        </div>

        <div class="row" style="text-align: center;margin-top: 20px">
            <?php echo $paging ?>

            <?php else : ?>
                <div class="col-md-12">
                    <div class="alert alert-danger">
                        <span><b> Warning! </b> Data tidak ada didatabase </span>
                    </div>
                    <div class="reload" style="text-align: center;margin-bottom: 7px">
                        <a  href="<?php echo base_url('articles?source=reload&utf8=✓') ?>" class="btn btn-danger btn-reset btn-fill" id="load" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Reloading..."><i class="fa fa-repeat"></i> Reload Page</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<!--=== End News Block ===-->
<!--=== News Block ===-->
<div class="bg-color-light">
    <div class="container content-sm">
        <div class="text-center margin-bottom-50">
            <h2 class="title-v2 title-center">EVENT & STORE/h2>
        </div>

        <div class="row news-v2">
            <div class="col-md-12" style="margin-bottom: 20px">
                <div class="search-events" style="text-align: center">
                    <form method="GET" action="<?php echo base_url('events/search');?>" style="margin-top: 10px">
                        <div class = "input-group">
                            <input type = "text" name = "q" class = "form-control input-lg" placeholder="Masukkan Nama Events dan Enter" autocomplete="off" id="articles">
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
                if($events != NULL):
                foreach($events->result() as $hasil):

                    //check lenght title
                    if(strlen($hasil->judul_event)<40)
                    {
                        $judul = '<h3><a href="'.base_url('events/read').'/'.$hasil->slug.'/" style="text-decoration:none">'.$hasil->judul_event.'</a></h3>';
                    }else{
                        $judul = '<h3><a href="'.base_url('events/read').'/'.$hasil->slug.'/" style="text-decoration:none" title="'.$hasil->judul_event.'">'.substr($hasil->judul_event, 0,40).'...</a></h3>';

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
                            <img class="img-responsive" src="<?php echo base_url() ?>resources/images/events/thumb/<?php echo $hasil->thumbnail ?>" alt="">

                        </div>
                        <div class="news-v2-desc bg-color-light" style="-moz-box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);webkit-box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12);">
                            <?php echo $judul ?>
                            <small><i class="fa fa-map-marker"></i> <?php echo $hasil->lokasi_event ?> </small>
                            <p><a href="<?php echo base_url() ?>events/join/<?php echo $this->encryption->encode($hasil->id_event) ?>" class="btn-u btn-u-sea rounded"><i class="fa fa-shopping-cart"></i>BELI</a></p>
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
                        <a  href="<?php echo base_url('events?source=reload&utf8=✓') ?>" class="btn btn-danger btn-reset btn-fill" id="load" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Reloading..."><i class="fa fa-repeat"></i> Reload Page</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<!--=== End News Block ===-->
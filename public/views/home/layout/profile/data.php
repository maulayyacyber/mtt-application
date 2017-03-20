<?php foreach ($data_pages->result() as $hasil) { ?>
<!--=== News Block ===-->
<div class="bg-color-light">
    <div class="container content-sm">
        <div class="row news-v2">
            <div class="col-md-7">
                <div class="page-detail" style="-moz-box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);webkit-box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12);padding: 15px 15px;background-color: #fff">
                    <div class="title-page" style="font-size: 20px;color: #333">
                        <?php echo $hasil->judul_page ?>
                    </div>
                    <hr>
                    <div class="content-page" style="font-size: 16px;color: #333">
                        <?php echo $hasil->isi_page ?>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <?php
                if($articles_terbaru != NULL) :
                    foreach ($articles_terbaru->result() as $hasil):
                        ?>
                        <div class="page-detail" style="margin-bottom:10px;-moz-box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);webkit-box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12);padding: 15px 15px;background-color: #fff">
                            <div class="media">
                                <div class="media-left">
                                    <a href="<?php echo base_url() ?>articles/read/<?php echo $hasil->slug ?>/">
                                        <img class="media-object" src="<?php echo base_url() ?>resources/images/articles/<?php echo $hasil->thumbnail ?>" style="width: 168px;height: 94px" alt="...">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <a href="" style="text-decoration: none">
                                        <h4 class="media-heading" style="font-family: Roboto;font-weight: 400;font-size: 14px"><?php echo $hasil->judul_articles ?></h4>
                                    </a>
                                    <div class="date" style="color: #333">
                                        <i class="fa fa-calendar-o"></i> <?php echo $this->web->tgl_indo_no_hari($hasil->created_at) ?> <i class="fa fa-eye"></i> Dilihat <?php echo $hasil->views ?> kali
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    endforeach;
                    ?>
                    <?php
                else:
                    ?>

                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!--=== End News Block ===-->
<?php } ?>
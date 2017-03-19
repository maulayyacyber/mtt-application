<!--=== News Block ===-->
<div class="bg-color-light">
    <div class="container content-sm">
        <div class="row news-v2">
            <?php
                if($detail_articles != NULL) :
            ?>
            <div class="col-md-7">

                <div class="page-detail" style="-moz-box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);webkit-box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12);padding: 15px 15px;background-color: #fff">
                    <h2><?php echo $detail_articles->judul_articles ?></h2>
                    <div class="blog-post-tags">
                        <ul class="list-unstyled list-inline blog-info">
                            <li><i class="fa fa-calendar"></i> <?php echo $this->web->tgl_indo_no_hari($detail_articles->created_at) ?></li>
                            <li><i class="fa fa-pencil"></i> <?php echo $detail_articles->nama_user ?></li>
                            <li><i class="fa fa-eye"></i> Dilihat <?php echo $detail_articles->views ?> kali</li>
                        </ul>
                        <ul class="list-unstyled list-inline blog-tags">
                            <li>
                                <i class="fa fa-tags"></i>
                                <span>
                                    <?php
                                    if($detail_articles->meta_keywords != NULL):
                                        $tags = explode(",", $detail_articles->meta_keywords);
                                        foreach($tags as $k => $v):
                                            ?>
                                            <a href="#"><?php echo $v ?></a>
                                            <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </span>
                            </li>
                        </ul>
                    </div>
                    <div class="content-page" style="font-size: 16px;color: #333">
                        <img src="<?php echo base_url() ?>resources/images/articles/<?php echo $detail_articles->thumbnail ?>" class="img-responsive">
                        <div class="secsion-articles" style="font-size: 16px;color: #333;margin-top: 10px;padding: 10px 0px">
                            <?php echo $detail_articles->isi_articles ?>
                        </div>
                    </div>
                </div>

                <div class="page-detail" style="margin-top:30px;-moz-box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);webkit-box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12);padding: 15px 15px;background-color: #fff">
                    <div id="comments">
                        <?php echo $disqus ?>
                    </div>
                </div>

            </div>
             <?php
                else:
             ?>
                <?php redirect('/') ?>
             <?php endif; ?>
            <div class="col-md-5">
                <?php
                if($articles_terbaru != NULL) :
                    foreach ($articles_terbaru->result() as $hasil):
                        ?>
                <div class="page-detail" style="margin-bottom:10px;-moz-box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);webkit-box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12);padding: 15px 15px;background-color: #fff">
                    <div class="media">
                        <div class="media-left">
                            <a href="">
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
</div>
<!--=== End News Block ===-->
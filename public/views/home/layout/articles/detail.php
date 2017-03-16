<!--=== News Block ===-->
<div class="bg-color-light">
    <div class="container content-sm">
        <div class="row news-v2">
            <?php
                if($detail_articles != NULL) :
            ?>
            <div class="col-md-8">

                <div class="page-detail" style="-moz-box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);webkit-box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12);padding: 15px 15px;background-color: #fff">
                    <h2><?php echo $detail_articles->judul_articles ?></h2>
                    <div class="blog-post-tags">
                        <ul class="list-unstyled list-inline blog-info">
                            <li><i class="fa fa-calendar"></i> <?php echo $this->web->tgl_indo_lengkap($detail_articles->created_at) ?></li>
                            <li><i class="fa fa-pencil"></i> <?php echo $detail_articles->nama_user ?></li>
                            <li><i class="fa fa-comments"></i> <a href="<?php echo base_url() ?>articles/<?php echo $detail_articles->slug ?>/#comments">Comments</a></li>
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
                        <div class="secsion-articles" style="font-size: 16px;color: #333;margin-top: 10px">
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
            <div class="col-md-4">
                <div class="page-detail" style="-moz-box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);webkit-box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12);padding: 15px 15px;background-color: #fff">

                </div>
            </div>
            <?php
                else:
            ?>

            <?php endif; ?>
        </div>
    </div>
</div>
<!--=== End News Block ===-->
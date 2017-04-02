<!--=== News Block ===-->
<div class="bg-color-light">
    <div class="container content-sm">
        <div class="text-center margin-bottom-50">
            <h2 class="title-v2 title-center" style="text-transform: uppercase"><?php echo $title ?></h2>
        </div>

        <div class="row news-v2">
            <div class="col-md-12" style="margin-bottom: 20px">
                <div class="cube-portfolio container margin-bottom-60">
                <div id="grid-container" class="cbp-l-grid-agency">
                    <?php
                    if ($data_foto != NULL):
                        foreach ($data_foto->result() as $hasil):
                    ?>
                    <div class="cbp-item">
                        <div class="cbp-caption margin-bottom-20">
                            <div class="cbp-caption-defaultWrap">
                                <img src="<?php echo base_url() ?>resources/foto_gallery/<?php echo strtolower(url_title($hasil->nama_album)) ?>/<?php echo $hasil->foto_gallery ?>" alt="">
                            </div>
                            <div class="cbp-caption-activeWrap">
                                <div class="cbp-l-caption-alignCenter">
                                    <div class="cbp-l-caption-body">
                                        <ul class="link-captions no-bottom-space">
                                            <li><a href="<?php echo base_url() ?>resources/foto_gallery/<?php echo strtolower(url_title($hasil->nama_album)) ?>/<?php echo $hasil->foto_gallery ?>" class="cbp-lightbox" data-title="<?php echo $hasil->caption_foto ?>"><i class="rounded-x fa fa-search"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="cbp-title-dark">
                            <div class="cbp-l-grid-agency-title"><?php echo $hasil->caption_foto ?></div>
                        </div>
                    </div>
                    <?php
                        endforeach;
                    ?>
                    <?php endif; ?>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
<!--=== End News Block ===-->
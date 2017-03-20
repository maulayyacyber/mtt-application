<!--=== Footer v6 ===-->
<div id="footer-v6" class="footer-v6">
    <div class="footer">
        <div class="container">
            <div class="row">
                <!-- About Us -->
                <div class="col-md-3 sm-margin-bottom-40">
                    <div class="heading-footer"><h2><i class="fa fa-user-circle-o"></i> About MTT</h2></div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis blandit ut metus a commodo. Pellentesque congue tellus sed enim sollicitudin, id blandit mauris eleifend.</p>
                </div>
                <!-- End About Us -->

                <!-- Recent News -->
                <div class="col-md-3 sm-margin-bottom-40">
                    <div class="heading-footer"><h2><i class="fa fa-book"></i> Recent News</h2></div>
                    <ul class="list-unstyled link-news">
                        <?php
                            if(articles_footer() != NULL) :
                            foreach (articles_footer() as $hasil) :
                        ?>
                        <li>
                            <a style="text-decoration: none" href="<?php echo base_url() ?>articles/read/<?php echo $hasil->slug ?>/"><i class="icon-arrow-right"></i> <?php echo $hasil->judul_articles ?></a>
                            <small><i class="fa fa-calendar-o"></i> <?php echo $this->web->tgl_indo_no_hari($hasil->created_at) ?> <i class="fa fa-eye"></i> Dilihat <?php echo $hasil->views ?> kali</small>
                        </li>
                        <?php endforeach; ?>
                        <?php endif;?>
                    </ul>
                </div>
                <!-- End Recent News -->

                <!-- Recent News -->
                <div class="col-md-3 sm-margin-bottom-40">
                    <div class="heading-footer"><h2><i class="fa fa-calendar-check-o"></i> Recent Events</h2></div>
                    <ul class="list-unstyled link-news">
                        <?php
                        if(events_footer() != NULL) :
                            foreach (events_footer() as $hasil) :
                                ?>
                                <li>
                                    <a style="text-decoration: none" href="<?php echo base_url() ?>events/read/<?php echo $hasil->slug ?>/"><i class="icon-arrow-right"></i> <?php echo $hasil->judul_event ?></a>
                                    <small>Lokasi : <i class="fa fa-map-marker"></i> <?php echo $hasil->lokasi_event ?></small>
                                </li>
                            <?php endforeach; ?>
                        <?php endif;?>
                    </ul>
                </div>
                <!-- End Recent News -->

                <!-- Contacts -->
                <div class="col-md-3">
                    <div class="heading-footer"><h2><i class="fa fa-comments-o"></i> Contacts</h2></div>
                    <ul class="list-unstyled contacts">
                        <li>
                            <i class="radius-3x fa fa-map-marker"></i>
                            795 Folsom Ave, Suite 600,
                            San Francisco, CA 94107
                        </li>
                        <li>
                            <i class="radius-3x fa fa-phone"></i>
                            (+123) 456 7890<br>
                            (+123) 456 7891
                        </li>
                    </ul>
                </div>
                <!-- End Contacts -->
            </div>
        </div><!--/container -->
    </div>

    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-8 sm-margon-bottom-10">
                    <ul class="list-inline terms-menu">
                        <li class="silver"><?php echo systems('site_footer') ?></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline dark-social pull-right space-bottom-0">
                        <li>
                            <a data-placement="top" data-toggle="tooltip" class="tooltips" data-original-title="Facebook" href="#">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>
                        <li>
                            <a data-placement="top" data-toggle="tooltip" class="tooltips" data-original-title="Twitter" href="#">
                                <i class="fa fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a data-placement="top" data-toggle="tooltip" class="tooltips" data-original-title="Vine" href="#">
                                <i class="fa fa-vine"></i>
                            </a>
                        </li>
                        <li>
                            <a data-placement="top" data-toggle="tooltip" class="tooltips" data-original-title="Google plus" href="#">
                                <i class="fa fa-google-plus"></i>
                            </a>
                        </li>
                        <li>
                            <a data-placement="top" data-toggle="tooltip" class="tooltips" data-original-title="Pinterest" href="#">
                                <i class="fa fa-pinterest"></i>
                            </a>
                        </li>
                        <li>
                            <a data-placement="top" data-toggle="tooltip" class="tooltips" data-original-title="Instagram" href="#">
                                <i class="fa fa-instagram"></i>
                            </a>
                        </li>
                        <li>
                            <a data-placement="top" data-toggle="tooltip" class="tooltips" data-original-title="Tumblr" href="#">
                                <i class="fa fa-tumblr"></i>
                            </a>
                        </li>
                        <li>
                            <a data-placement="top" data-toggle="tooltip" class="tooltips" data-original-title="Youtube" href="#">
                                <i class="fa fa-youtube"></i>
                            </a>
                        </li>
                        <li>
                            <a data-placement="top" data-toggle="tooltip" class="tooltips" data-original-title="Soundcloud" href="#">
                                <i class="fa fa-soundcloud"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--=== End Footer v6 ===-->
</div><!--/wrapper-->

<!-- JS Global Compulsory -->
<script type="text/javascript" src="<?php echo base_url() ?>resources/frontend/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>resources/frontend/plugins/jquery/jquery-migrate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>resources/frontend/plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- JS Implementing Plugins -->
<script type="text/javascript" src="<?php echo base_url() ?>resources/frontend/plugins/back-to-top.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>resources/frontend/plugins/smoothScroll.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>resources/frontend/plugins/jquery.parallax.js"></script>
<script src="<?php echo base_url() ?>resources/frontend/plugins/master-slider/masterslider/masterslider.min.js"></script>
<script src="<?php echo base_url() ?>resources/frontend/plugins/master-slider/masterslider/jquery.easing.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>resources/frontend/plugins/counter/waypoints.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>resources/frontend/plugins/counter/jquery.counterup.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>resources/frontend/plugins/fancybox/source/jquery.fancybox.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>resources/frontend/plugins/owl-carousel/owl-carousel/owl.carousel.js"></script>
<!-- JS Customization -->
<script type="text/javascript" src="<?php echo base_url() ?>resources/frontend/js/custom.js"></script>
<!-- JS Page Level -->
<script type="text/javascript" src="<?php echo base_url() ?>resources/frontend/js/app.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>resources/frontend/js/plugins/fancy-box.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>resources/frontend/js/plugins/owl-carousel.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>resources/frontend/js/plugins/master-slider-fw.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>resources/frontend/js/plugins/style-switcher.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        App.init();
        App.initCounter();
        App.initParallaxBg();
        FancyBox.initFancybox();
        MSfullWidth.initMSfullWidth();
        OwlCarousel.initOwlCarousel();
        StyleSwitcher.initStyleSwitcher();
    });
</script>
<!--[if lt IE 9]>
<script src="<?php echo base_url() ?>resources/frontend/plugins/respond.js"></script>
<script src="<?php echo base_url() ?>resources/frontend/plugins/html5shiv.js"></script>
<script src="<?php echo base_url() ?>resources/frontend/plugins/placeholder-IE-fixes.js"></script>
<![endif]-->
</body>
</html>

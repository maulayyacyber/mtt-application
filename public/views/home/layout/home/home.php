<!-- About Info -->
<div class="container content-sm">
    <div class="row">
        <div class="col-md-6">
            <div class="carousel slide carousel-v1 margin-bottom-40" id="sliders">
                <div class="carousel-inner">
                    <?php
                    $item_class = ' active';
                    foreach($sliders->result() as $hasil) :
                        //$item_class = ($i == 1) ? 'item active' : 'item';
                        ?>
                        <div class="item<?php echo $item_class; ?>">
                            <a href="<?php echo $hasil->link_slider ?>">
                                <img src="<?php echo base_url() ?>resources/images/sliders/<?php echo $hasil->image_slider ?>">
                            </a>
                        </div>

                        <?php
                        $item_class = '';
                    endforeach;
                    ?>
                </div>

                <div class="carousel-arrow">
                    <a data-slide="prev" href="#sliders" class="left carousel-control">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a data-slide="next" href="#sliders" class="right carousel-control">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
                <h2 class="title-v2">MEDICAL TOP TEAM</h2>
                <p style="font-size: 15px">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.</p>
                <p style="font-size: 15px">If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures.</p><br>
                <a href="<?php echo base_url() ?>members/login/" class="btn-u btn-brd btn-brd-hover btn-u-dark"><i class="icon-lock"></i> Login  </a>
                <a href="<?php echo base_url() ?>members/daftar/" class="btn-u btn-u-sea"><i class="icon-user-follow"></i> Daftar</a>
        </div>
    </div>

</div>
<!-- End About Info -->

<!--=== News Block ===-->
<div class="bg-color-light">
<div class="container content-sm">
    <div class="text-center margin-bottom-50">
        <h2 class="title-v2 title-center">RECENT ARTICLES</h2>
    </div>

    <div class="row news-v2">
        <div id="articles">

        </div>
    </div>
    <div class="row" style="text-align: center;margin-top: 20px">
        <button class="btn-u btn-u-sea rounded" id="load_more" data-val = "0">More articles <img style="display: none" id="loader" src="<?php echo base_url('resources/images/loader.svg') ?>" style="width: 5px;height: 5px"></button>
    </div>
</div>
</div>
<!--=== End News Block ===-->

<!--=== News Block ===-->
    <div class="container content-sm">
        <div class="text-center margin-bottom-50">
            <h2 class="title-v2 title-center">RECENT EVENTS</h2>
        </div>

        <div class="row news-v2">
            <div id="events">

            </div>
        </div>
        <div class="row" style="text-align: center;margin-top: 20px">
            <button class="btn-u btn-u-sea rounded" id="load_more_events" data-val = "0">More events <img style="display: none" id="loader" src="<?php echo base_url('resources/images/loader.svg') ?>" style="width: 5px;height: 5px"></button>
        </div>
    </div>
<!--=== End News Block ===-->
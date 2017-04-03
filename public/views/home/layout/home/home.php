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
               

                <p style="font-size: 15px">Selamat Datang Di Portal Perhimpunan Mahasiswa Kesehatan Medical Top Team (PERMAKES MTT). <p>
                <p style="font-size: 15px">Selamat Datang Di Portal Perhimpunan Mahasiswa Kesehatan Medical Top Team (PERMAKES MTT). 
                PERMAKES MTT adalah wadah para mahasiswa kesehatan yang terdiri dari berbagai jurusan kesehatan diantaranya :
                </p>
                <ol style="font-size: 15px">
                    <li>Kedokteran</li>
                    <li>Keperawatan</li>
                    <li>Kebidanan</li>
                    <li>Farmasi</li>
                    <li>Kesehatan Masyarakat</li>
                    <li>Analis, dll</li>
                </ol>

                  <p style="font-size: 15px">PERMAKES MTT diharapkan menjadi penghubung antara seluruh mahasiswa kesehatan se-Indonesia. Untuk dapat terhubung silahkan daftarkan diri anda</p>
                <br>

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
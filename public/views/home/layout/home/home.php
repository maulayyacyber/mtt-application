<!-- About Info -->
<div class="container content-sm">
    <div class="row">
        <div class="col-md-7">
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
        <div class="col-md-5">
            <div class="card-form" style="-moz-box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);webkit-box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12);padding: 15px 15px">
                <form>
                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama" placeholder="Nama Lengkap">
                    </div>
                    <div class="form-group">
                        <label for="email">Alamat Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Alamat Email">
                    </div>
                    <div class="form-group">
                        <label for="no_hp">No Handphone</label>
                        <input type="text" class="form-control" id="no_hp" placeholder="No Handphone">
                    </div>
                    <button type="submit" class="btn-u btn-u-sea">Submit</button>
                </form>
            </div>
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
        <button class="btn-u btn-u-sea" id="load_more" data-val = "0">More articles <img style="display: none" id="loader" src="<?php echo base_url('resources/images/loader.svg') ?>" style="width: 5px;height: 5px"></button>
    </div>
</div>
</div>
<!--=== End News Block ===-->
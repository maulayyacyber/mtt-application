<!--=== News Block ===-->
<div class="bg-color-light">
    <div class="container content-sm">
        <div class="row news-v2">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                <div class="page-detail" style="margin-bottom:10px;-moz-box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);webkit-box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12);padding: 15px 15px;background-color: #fff">
                    <?php
                    $attributes = array('class' => 'reg-page');
                    echo form_open('members/forgot?source=login&utf8=✓', $attributes)
                    ?>
                        <div class="reg-header">
                            <h2>Lupa password member</h2>
                        </div>

                        <div class="input-group margin-bottom-20">
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <input type="email" placeholder="Alamat Email" name="email" class="form-control">

                        </div>
                        <?php echo form_error('email'); ?>
                        <?php echo $this->session->flashdata('notif'); ?>
                        <?php if(isset($error)) { echo $error; }; ?>
                        <div class="row">
                            <div class="col-md-6">
                                <button class="btn-u btn-u-sea" type="submit">Kirim</button>
                            </div>
                        </div>

                        <hr>

                        <h4>Belum punya akun ?</h4>
                        <p>silahkan daftar, 
                        <a class="color-green" href="<?php echo base_url() ?>members/daftar/">disini</a> untuk menjadi member.

                        </p>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
 
 
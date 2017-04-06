
<!DOCTYPE html>
<html lang="en" class="ie8">
<html lang="en" class="ie9">
<html lang="en">
<head>
    <title>Form Daftar Member - Medical Top Team</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">

    <!-- Web Fonts -->
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,700&amp;subset=cyrillic,latin">

    <!-- CSS Global Compulsory -->
    <link rel="stylesheet" href="<?php echo base_url() ?>resources/frontend/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>resources/frontend/css/style.css">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="<?php echo base_url() ?>resources/frontend/plugins/animate.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>resources/frontend/plugins/line-icons/line-icons.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>resources/frontend/plugins/font-awesome/css/font-awesome.min.css">

    <!-- CSS Page Style -->
    <link rel="stylesheet" href="<?php echo base_url() ?>resources/frontend/css/pages/page_log_reg_v4.css">

    <!-- CSS Customization -->
    <link rel="stylesheet" href="<?php echo base_url() ?>resources/frontend/css/custom.css">
</head>

<body>
<!--=== Content Part ===-->
<div class="container-fluid">
    <div class="row equal-height-columns">


        <div class="col-md-612 col-sm-12 form-block equal-height-column">
            <div class="reg-block" style="-moz-box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);webkit-box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12);padding: 20px 15px;">
                <a href="<?php echo base_url() ?>">
                    <img src="<?php echo base_url() ?>resources/images/logo.png" alt="" style="margin-bottom: 30px">
                </a>
                <h2 class="margin-bottom-30">Form Pendaftaran Member</h2>
                <?php
                $attributes = array('id' => 'frm_login');
                echo form_open_multipart('members/save?source=form&utf8=✓', $attributes)
                ?>
                <div class="input-group margin-bottom-20">
                    <span class="input-group-addon rounded-left"><i class="icon-user color-sea"></i></span>
                    <input type="text" class="form-control rounded-right" name="nama" placeholder="Nama Lengkap" required>
                </div>

                <div class="input-group margin-bottom-20">
                    <span class="input-group-addon rounded-left"><i class="icon-calendar color-sea"></i></span>
                    <input type="text" class="form-control rounded-right" name="ttl" placeholder="Tempat, Tanggal, lahir" required>
                </div>

                <div class="input-group margin-bottom-20">
                    <span class="input-group-addon rounded-left"><i class="icon-briefcase color-sea"></i></span>
                    <select class="form-control" name="institusi_id" id="kategori" style="background: transparent;border-left: none;padding-left: 10px;padding-right: 10px;height: 50px;border-color: rgba(214,214,214,.5);border-left: none;color: #969595;">
                        <option value="" selected="selected">- - Pilih Institusi - -</option>
                        <?php
                        foreach($select_institusi->result_array() as $row)
                        {
                            if($row['id_institusi']== "")
                            {
                                ?>
                                <option value="<?php echo $row['id_institusi']; ?>" selected="selected"><?php echo $row['nama_institusi']; ?></option>
                                <?php
                            } else {
                                ?>
                                <option value="<?php echo $row['id_institusi']; ?>"><?php echo $row['nama_institusi']; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="input-group margin-bottom-20">
                    <span class="input-group-addon rounded-left"><i class="icon-screen-smartphone color-sea"></i></span>
                    <input type="text" class="form-control rounded-right" name="no_hp" placeholder="No. HP" required>
                </div>

                <div class="input-group margin-bottom-30">
                    <span class="input-group-addon rounded-left"><i class="icon-envelope color-sea"></i></span>
                    <input type="email" class="form-control rounded-right" name="email" placeholder="Alamat Email" required>
                </div>

                <div class="input-group margin-bottom-30">
                    <span class="input-group-addon rounded-left"><i class="icon-lock color-sea"></i></span>
                    <input type="password" class="form-control rounded-right" name="password" placeholder="Password" required>
                </div>

                <div class="input-group margin-bottom-30">
                    <span class="input-group-addon rounded-left"><i class="icon-home color-sea"></i></span>
                    <input type="text" class="form-control rounded-right" name="alamat" placeholder="Alamat Rumah" required>
                </div>

                <div class="input-group margin-bottom-30">
                    <span class="input-group-addon rounded-left"><i class="icon-call-end color-sea"></i></span>
                    <input type="text" class="form-control rounded-right" name="telephone" placeholder="Telephone" required>
                </div>

                <div class="input-group margin-bottom-30">
                    <span class="input-group-addon rounded-left"><i class="icon-symbol-male color-sea"></i></span>
                    <select class="form-control rounded-right" name="jenis_kelamin" required style="background: transparent;border-left: none;padding-left: 10px;padding-right: 10px;height: 50px;border-color: rgba(214,214,214,.5);border-left: none;color: #969595;">
                        <option> -- Pilih Jenis Kelamin --</option>
                        <option value="Laki - Laki">Laki - Laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>

                <div class="input-group margin-bottom-30">
                    <span class="input-group-addon rounded-left"><i class="icon-bubbles color-sea"></i></span>
                    <input type="text" class="form-control rounded-right" name="bbm" placeholder="BBM" required>
                </div>

                <div class="input-group margin-bottom-30">
                    <span class="input-group-addon rounded-left"><i class="icon-bubble color-sea"></i></span>
                    <input type="text" class="form-control rounded-right" name="line" placeholder="Line" required>
                </div>

                <div class="input-group margin-bottom-30">
                    <span class="input-group-addon rounded-left"><i class="icon-heart color-sea"></i></span>
                    <input type="text" class="form-control rounded-right" name="instagram" placeholder="Instagram" required>
                </div>

                <div class="input-group margin-bottom-30">
                    <span class="input-group-addon rounded-left"><i class="icon-social-facebook color-sea"></i></span>
                    <input type="text" class="form-control rounded-right" name="facebook" placeholder="Facebook" required>
                </div>

                <div class="input-group margin-bottom-30">
                    <span class="input-group-addon rounded-left"><i class="icon-graduation color-sea"></i></span>
                    <input type="text" class="form-control rounded-right" name="riwayat_pendidikan" placeholder="Riwayat Pendidikan" required>
                </div>

                <div class="input-group margin-bottom-30">
                    <span class="input-group-addon rounded-left"><i class="icon-grid color-sea"></i></span>
                    <input type="text" class="form-control rounded-right" name="riwayat_pengalaman_organisasi" placeholder="Riwayat Pengalaman Organisasi" required>
                </div>

                <div class="input-group margin-bottom-30">
                    <span class="input-group-addon rounded-left"><i class="icon-star color-sea"></i></span>
                    <select class="form-control"  name="agama" id="sel1" style="background: transparent;border-left: none;padding-left: 10px;padding-right: 10px;height: 50px;border-color: rgba(214,214,214,.5);border-left: none;color: #969595;">
                        <option> -- Pilih Agama --</option>
                        <option value="Islam">Islam</option>
                        <option value="Kristen">kristen</option>
                        <option value="Budha">Budha</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Konghucu">Konghucu</option>
                    </select>
                </div>

                <div class="input-group margin-bottom-30">
                    <span class="input-group-addon rounded-left"><i class="icon-paper-clip color-sea"></i></span>
                    <input type="file" class="form-control rounded-right" name="userfile" placeholder="Foto" required>
                </div>

                <div class="checkbox margin-bottom-30">
                    <label style="width: 100%;max-width: 100%">
                        <input type="checkbox"> Saya menyatakan data yang saya ini adalah benar, jika tidak saya siap menerima konsekuensinya
                    </label>
                </div>

                <button type="submit" class="btn-u btn-u-sea btn-block rounded">Daftar <i class="fa fa-send"></i> </button>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div><!--/container-->
<!--=== End Content Part ===-->

<!--=== Sticky Footer ===-->
<div class="container sticky-footer">
    <ul class="list-unstyled list-inline social-links margin-bottom-30">
        <li><a href="#"><i class="icon-custom icon rounded-x icon-bg-u fa fa-facebook"></i></a></li>
        <li><a href="#"><i class="icon-custom icon rounded-x icon-bg-u fa fa-twitter"></i></a></li>
        <li><a href="#"><i class="icon-custom icon rounded-x icon-bg-u fa fa-linkedin"></i></a></li>
    </ul>
    <p class="copyright-space">
        <?php echo systems('site_footer') ?>
    </p>
</div>
<!--=== End Sticky Footer ===-->

<!-- JS Global Compulsory -->
<script src="<?php echo base_url() ?>resources/frontend/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url() ?>resources/frontend/plugins/jquery/jquery-migrate.min.js"></script>
<script src="<?php echo base_url() ?>resources/frontend/plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- JS Implementing Plugins -->
<script src="<?php echo base_url() ?>resources/frontend/plugins/back-to-top.js"></script>
<script src="<?php echo base_url() ?>resources/frontend/plugins/backstretch/jquery.backstretch.min.js"></script>

<!-- JS Customization -->
<script src="<?php echo base_url() ?>resources/frontend/js/custom.js"></script>

<!-- JS Page Level -->
<script src="<?php echo base_url() ?>resources/frontend/js/app.js"></script>
<script>
    jQuery(document).ready(function() {
        App.init();
    });
</script>
<!--[if lt IE 9]>
<script src="<?php echo base_url() ?>resources/frontend/plugins/respond.js"></script>
<script src="<?php echo base_url() ?>resources/frontend/plugins/html5shiv.js"></script>
<script src="<?php echo base_url() ?>resources/frontend/plugins/placeholder-IE-fixes.js"></script>
<![endif]-->
</body>
</html>

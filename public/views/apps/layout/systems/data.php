
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php echo $title ?>
            <small>Web Applications</small>
        </h1>
    </section>

    <!-- Main content -->
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <?php echo $this->session->flashdata('notif') ?>
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-cogs"></i> Setting Systems</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="update-system">
                        <?php
                        $attributes = array('id' => 'frm_login');
                        echo form_open_multipart('apps/systems/save?source=update&utf8=✓', $attributes)
                        ?>
                        <div class="form-group">
                            <label for="artilces">Admin Title</label>
                            <input type="text" class="form-control" name="admin_title" value="<?php echo systems('admin_title') ?>" id="articles" placeholder="Enter Admin Title">
                            <input type="hidden" name="id_system" value="<?php echo $this->encryption->encode(systems('id_system')) ?>">
                        </div>
                        <div class="form-group">
                            <label for="artilces">Admin Footer</label>
                            <input type="text" class="form-control" name="admin_footer" value="<?php echo systems('admin_footer') ?>" id="articles" placeholder="Enter Admin Footer">
                        </div>
                        <div class="form-group">
                            <label for="artilces">Site Title</label>
                            <input type="text" class="form-control" name="site_title" value="<?php echo systems('site_title') ?>" id="articles" placeholder="Enter Site Title">
                        </div>
                        <div class="form-group">
                            <label for="artilces">Site Footer</label>
                            <input type="text" class="form-control" name="site_footer" value="<?php echo systems('site_footer') ?>" id="articles" placeholder="Enter Site Footer">
                        </div>
                        <div class="form-group">
                            <label for="artilces">About Medical Top Team</label>
                            <textarea class="form-control" name="about_me" rows="3" placeholder="Enter About Medical Top Team"><?php echo systems('about_me') ?></textarea>
                        </div>
                            <div class="form-group">
                                <label for="artilces">Alamat Kantor</label>
                                <textarea class="form-control" name="alamat" rows="3" placeholder="Enter Alamat Kantor"><?php echo systems('alamat') ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="artilces">No. Telephone</label>
                                <input type="text" class="form-control" name="no_telp" value="<?php echo systems('no_telp') ?>" id="articles" placeholder="Enter No. Telephone">
                            </div>
                            <div class="form-group">
                                <label for="artilces">No. Telephone 2</label>
                                <input type="text" class="form-control" name="no_telp2" value="<?php echo systems('no_telp2') ?>" id="articles" placeholder="Enter No. Telephone 2">
                            </div>
                        <div class="form-group">
                            <label for="artilces">Meta Keywords</label>
                            <input type="text" class="form-control" name="keywords" value="<?php echo systems('keywords') ?>" id="articles" placeholder="Enter Meta Keywords">
                        </div>
                        <div class="form-group">
                            <label for="artilces">Meta Descriptions</label>
                            <textarea class="form-control" name="descriptions" rows="6" placeholder="Enter Meta Descriptions"><?php echo systems('descriptions') ?></textarea>
                        </div>
                        <div class="submit">
                            <button type="submit" class="btn btn-success btn-save btn-fill"><i class="fa fa-save"></i> Update</button>
                            <button type="reset" class="btn btn-warning btn-reset btn-fill"><i class="fa fa-repeat"></i> Reset</button>
                        </div>
                        <?php echo form_close(); ?>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>

    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
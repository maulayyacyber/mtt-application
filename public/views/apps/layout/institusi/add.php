
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
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-building-o"></i> Add Institusi</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="add-articles">
                            <?php
                            $attributes = array('id' => 'frm_login');
                            echo form_open_multipart('apps/institusi/save?source=login&utf8=✓', $attributes)
                            ?>
                            <div class="form-group">
                                <label for="artilces">Nama Institusi</label>
                                <input type="text" class="form-control" name="nama_institusi" id="articles" placeholder="Enter Nama Institusi">
                                <input type="hidden" name="type" value="<?php echo $type ?>">
                            </div>
                            <div class="submit">
                                <button type="submit" class="btn btn-success btn-save btn-fill"><i class="fa fa-save"></i> Save</button>
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
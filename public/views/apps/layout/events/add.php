
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
                        <h3 class="box-title"><i class="fa fa-calendar-o"></i> Add Events</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="add-events">
                            <?php
                            $attributes = array('id' => 'frm_login');
                            echo form_open_multipart('apps/events/save?source=login&utf8=✓', $attributes)
                            ?>
                            <div class="form-group">
                                <label>Thumbnail Events</label>
                                <input type="file" class="form-control" name="userfile" style="margin-bottom: 10px">
                                <input type="hidden" name="type" value="<?php echo $type ?>">
                                <span class="label label-danger">
                                       NOTE!
                                    </span>
                                <span>
                                        Gambar thumbnail disarankan ukuran 600X300 PX
                                     </span>
                            </div>
                            <div class="form-group">
                                <label for="artilces">Judul Events</label>
                                <input type="text" class="form-control" name="judul" id="articles" placeholder="Enter Judul Events">
                            </div>
                            <div class="form-group">
                                <label for="artilces">Isi Events</label>
                                <textarea class="ckeditor" id="post" name="isi" rows="6" placeholder="Enter Isi Events"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="artilces">Harga Ticket Events</label>
                                <input type="text" class="form-control" name="harga" id="articles" placeholder="Enter Harga Ticket Events">
                            </div>
                            <div class="form-group">
                                <label for="artilces">Lokasi Events</label>
                                <textarea class="form-control" name="lokasi" rows="3" placeholder="Enter Lokasi Events"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="artilces">Meta Keywords</label>
                                <input type="text" class="form-control" name="meta_keywords" id="articles" placeholder="Enter Meta Keywords">
                            </div>
                            <div class="form-group">
                                <label for="artilces">Meta Descriptions</label>
                                <textarea class="form-control" name="meta_descriptions" rows="6" placeholder="Enter Meta Descriptions"></textarea>
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
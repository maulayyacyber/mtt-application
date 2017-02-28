
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
                        <h3 class="box-title"><i class="fa fa-book"></i> Edit Articles</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="edit-articles">
                        <?php
                        $attributes = array('id' => 'frm_login');
                        echo form_open_multipart('apps/articles/save?source=login&utf8=✓', $attributes)
                        ?>
                        <div class="form-group">
                            <label>Thumbnail Articles</label>
                            <input type="file" class="form-control" name="userfile" style="margin-bottom: 10px">
                            <input type="hidden" name="type" value="<?php echo $type ?>">
                            <input type="hidden" name="id_articles" value="<?php echo $this->encryption->encode($data_articles['id_articles']) ?>">
                            <span class="label label-danger">
                                       NOTE!
                                    </span>
                            <span>
                                        Gambar thumbnail disarankan ukuran 600X300 PX
                                     </span>
                        </div>
                        <div class="form-group">
                            <label for="artilces">Judul Articles</label>
                            <input type="text" class="form-control" name="judul" value="<?php echo $data_articles['judul_articles'] ?>" id="articles" placeholder="Enter Judul Articles">
                        </div>
                        <div class="form-group">
                            <label for="artilces">Isi Articles</label>
                            <textarea class="form-control" id="post" name="isi" rows="6" placeholder="Enter Isi Articles"><?php echo $data_articles['isi_articles'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="artilces">Meta Keywords</label>
                            <input type="text" class="form-control" name="meta_keywords" value="<?php echo $data_articles['meta_keywords'] ?>" id="articles" placeholder="Enter Meta Keywords">
                        </div>
                        <div class="form-group">
                            <label for="artilces">Meta Descriptions</label>
                            <textarea class="form-control" name="meta_descriptions" rows="6" placeholder="Enter Meta Descriptions"><?php echo $data_articles['meta_descriptions'] ?></textarea>
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
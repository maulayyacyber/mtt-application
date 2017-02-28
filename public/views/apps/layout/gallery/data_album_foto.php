
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
                        <h3 class="box-title"><i class="fa fa-picture-o"></i> Upload Gambar</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <?php
                        $attributes = array('id' => 'frm_login');
                        echo form_open_multipart('apps/gallery/upload?source=upload&utf8=✓', $attributes)
                        ?>
                        <div class="form-group">
                            <label>Pilih Gambar</label>
                            <input type="file" class="form-control" name="files[]" style="margin-bottom: 10px">
                            <input type="hidden" name="id_album" value="<?php echo $this->encryption->encode($id_album) ?>">
                        </div>
                        <div class="form-group">
                            <label for="artilces">Caption Gambar</label>
                            <input type="text" class="form-control" name="caption_foto" id="articles" placeholder="Enter Caption Gambar">
                        </div>
                        <div class="submit">
                            <button type="submit" class="btn btn-success btn-save btn-fill"><i class="fa fa-save"></i> Upload</button>
                            <button type="reset" class="btn btn-warning btn-reset btn-fill"><i class="fa fa-repeat"></i> Reset</button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                    <!-- /.box-body -->
                </div>

                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-picture-o"></i> Data Foto Album</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" style="margin-top:10px;font-family: Roboto;font-weight: 300;">
                                <tbody>
                                <thead>
                                <tr>
                                    <th class="text-center" style="color: #000;">No.</th>
                                    <th class="text-center" style="color: #000;"><i class="fa fa-bookmark"></i> CAPTION GAMBAR</th>
                                    <th class="text-center" style="color: #000;"><i class="fa fa-picture-o"></i> GAMBAR</th>
                                    <th class="text-center" style="color: #000;"><i class="fa fa-cogs"></i> OPTIONS</th>
                                </tr>
                                </thead>
                                <?php
                                if($album != NULL):
                                    $no = $this->uri->segment(6) + 1;
                                    foreach($album->result() as $hasil):
                                 ?>
                                    <tr>
                                        <td class="text-center"><?php echo $no++; ?></td>
                                        <td> <?php echo $hasil->caption_foto ?></td>
                                        <td class="text-center"> <img src="<?php echo base_url() ?>resources/foto_gallery/<?php echo strtolower(url_title($hasil->nama_album)) ?>/<?php echo $hasil->foto_gallery ?>" class="img-responsive" style="width: 230px;height: 150px"></td>
                                        <td class="text-center">
                                            <a class='badge badge-danger' style="font-family: Roboto;font-weight: 400;background-color: #842020;" data-toggle="tooltip" data-placement="top" title="Delete ?" href='<?php echo base_url() ?>apps/gallery/delete_picture/<?php echo $this->encryption->encode($hasil->id_foto) ?>'><i class="fa fa-trash"></i> Delete</a>
                                        </td>
                                    </tr>
                                    <?php
                                endforeach;
                                ?>
                                </tbody>
                            </table>
                            <?php echo $paging ?>
                            <?php else : ?>
                                </tbody>
                                </table>
                                <div class="alert alert-danger">
                                    <span><b> Warning! </b> Data tidak ada didatabase </span>
                                </div>
                                <div class="reload" style="text-align: center;margin-bottom: 7px">
                                    <a  href="<?php echo base_url('apps/gallery?source=reload&utf8=✓') ?>" class="btn btn-danger btn-reset btn-fill" id="load" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Reloading..."><i class="fa fa-repeat"></i> Reload Page</a>
                                </div>
                            <?php endif; ?>
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

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
                        <h3 class="box-title"><i class="fa fa-users"></i> Add Members</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="add-members">
                            <?php
                            $attributes = array('id' => 'frm_login');
                            echo form_open_multipart('apps/members/save?source=login&utf8=✓', $attributes)
                            ?>
                            <div class="form-group">
                                <label for="artilces">Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama" id="articles" placeholder="Enter Nama Lengkap">
                                <input type="hidden" name="type" value="<?php echo $type ?>">
                            </div>
                            <div class="form-group">
                                <label for="artilces">Pilih Institusi</label>
                                <select class="form-control" name="institusi_id" id="kategori">
                                    <option value="" selected="selected">- - Pilih Institusi - -</option>
                                    <?php
                                    foreach($select_institusi->result_array() as $row)
                                    {
                                        if($row['id_institusi']== $data_members)
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
                            <div class="form-group">
                                <label for="artilces">Tempat Tanggal Lahir</label>
                                <input type="text" class="form-control" name="ttl" id="articles" placeholder="Enter Tempat tanggal Lahir">
                            </div>
                            <div class="form-group">
                                <label for="artilces">Jenis Kelamin</label>
                                    <select class="form-control"  name="jenis_kelamin" id="sel1">
                                        <option value="Laki - Laki">Laki - Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                            </div>
                            <div class="form-group">
                                <label for="artilces">Alamat</label>
                                <textarea class="form-control" name="alamat" rows="6" placeholder="Enter Alamat Rumah"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="artilces">Alamat Email</label>
                                <input type="email" class="form-control" name="email" id="articles" placeholder="Enter Alamat Email">
                            </div>
                            <div class="form-group">
                                <label for="artilces">No Telp</label>
                                <input type="text" class="form-control" name="no_telp" id="articles" placeholder="Enter No Telp">
                            </div>
                            <div class="form-group">
                                <label for="artilces">Line</label>
                                <input type="text" class="form-control" name="line" id="articles" placeholder="Enter ID Line">
                            </div>
                            <div class="form-group">
                                <label for="artilces">BBM</label>
                                <input type="text" class="form-control" name="bbm" id="articles" placeholder="Enter PIN BBM">
                            </div>
                            <div class="form-group">
                                <label for="artilces">Instagram</label>
                                <input type="text" class="form-control" name="instagram" id="articles" placeholder="Enter Username Instagram">
                            </div>
                            <div class="form-group">
                                <label for="artilces">Facebook</label>
                                <input type="text" class="form-control" name="facebook" id="articles" placeholder="Enter Facebook">
                            </div>
                            <div class="form-group">
                                <label for="artilces">Riwayat Pendidikan</label>
                                <input type="text" class="form-control" name="riwayat_pendidikan" id="articles" placeholder="Enter Riwayat Pendidikan">
                            </div>
                            <div class="form-group">
                                <label for="artilces">Riwayat Pengalaman Organisasi</label>
                                <input type="text" class="form-control" name="riwayat_pengalaman_organisasi" id="articles" placeholder="Enter Riwayat pengalaman Organisasi">
                            </div>
                            <div class="form-group">
                                <label for="artilces">Pilih Agama</label>
                                <select class="form-control"  name="agama" id="sel1">
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">kristem</option>
                                    <option value="Budha">Budha</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Konghucu">Konghucu</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="artilces">Telephone Rumah</label>
                                <input type="text" class="form-control" name="telephone_rumah" id="articles" placeholder="Enter Telephone Rumah">
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
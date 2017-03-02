
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
                        <h3 class="box-title"><i class="fa fa-male"></i> Data Users Events</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <?php
                                if($data_users_events['status'] == "0")
                                {
                                    $status = '<span class="badge badge-danger" style="font-family: Roboto;font-weight: 400;background-color: #ff9b2d;">Belum Lunas</span>';
                                }else{
                                    $status = '<span class="badge badge-success" style="font-family: Roboto;font-weight: 400;background-color: #358420;">Lunas</span>';
                                }
                            ?>
                            <table class="table table-hover">
                                <tr>
                                    <th style="font-size: 17px"><i class="fa fa-file-o"></i> Attribute</th>
                                    <th style="font-size: 17px"><i class="fa fa-clone"></i> Value</th>
                                </tr>
                                <tr>
                                    <td style="width: 15%">Nama Lengkap</td>
                                    <td><?php echo $data_users_events['nama'] ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 15%">Telephone</td>
                                    <td><?php echo $data_users_events['telephone'] ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 15%">BBM</td>
                                    <td><?php echo $data_users_events['bbm'] ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 15%">No HP</td>
                                    <td><?php echo $data_users_events['no_hp'] ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 15%">No KTP</td>
                                    <td><?php echo $data_users_events['no_ktp'] ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 15%">Alamat Email</td>
                                    <td><?php echo $data_users_events['email'] ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 15%">Institunsi</td>
                                    <td><?php echo $data_users_events['institusi'] ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 15%">Jenis Kelamin</td>
                                    <td><?php echo $data_users_events['jenis_kelamin'] ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 15%">Alamat Rumah</td>
                                    <td><?php echo $data_users_events['alamat'] ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 15%">Status</td>
                                    <td><?php echo $status ?></td>
                                </tr>
                            </table>
                            <div class="submit" style="margin-bottom: 7px">
                                <a href="<?php echo base_url() ?>apps/users_events/"  class="btn btn-success btn-save btn-fill"><i class="fa fa-arrow-left"></i> Kembali</a>
                                <a href="<?php echo base_url() ?>apps/users_events/send/<?php echo $this->encryption->encode($data_users_events['id_user_event']) ?>" type="reset" class="btn btn-primary btn-reset btn-fill"> Send Email <i class="fa fa-send"></i></a>
                            </div>
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
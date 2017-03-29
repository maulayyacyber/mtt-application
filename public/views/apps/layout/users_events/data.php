
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
                        <form method="GET" action="<?php echo base_url('apps/users_events/search');?>" style="margin-top: 10px">
                            <div class = "input-group">
                                <input type = "text" name = "q" class = "form-control input-md" placeholder="Masukkan kata kunci dan enter" autocomplete="off" id="articles">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                <span class = "input-group-btn">
                              <button class = "btn btn-default btn-md" type = "submit">
                                 <i class="fa fa-search"></i> Search
                              </button>
                           </span>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover" style="margin-top:20px;font-family: Roboto;font-weight: 300;">
                                <tbody>
                                <thead>
                                <tr>
                                    <th class="text-center" style="color: #000;">No.</th>
                                    <th class="text-center" style="color: #000;"><i class="fa fa-user-circle-o"></i> NAMA LENGKAP</th>
                                    <th class="text-center" style="color: #000;"><i class="fa fa-bookmark"></i> JUDUL EVENT </th>
                                    <th class="text-center" style="color: #000;"><i class="fa fa-info-circle"></i> STATUS</th>
                                    <th class="text-center" style="color: #000;"><i class="fa fa-cogs"></i> OPTIONS</th>
                                </tr>
                                </thead>
                                <?php
                                if($users_events != NULL):
                                $no = $this->uri->segment(4) + 1;
                                foreach($users_events->result() as $hasil):

                                    if($hasil->status == "0"){

                                        $status = '<span class="badge badge-danger" style="font-family: Roboto;font-weight: 400;background-color: #ff9b2d;"><i class="fa fa-circle-o-notch fa-spin"></i> Belum Lunas</span>';

                                        $update_status = '<a class="badge badge-primary" style="font-family: Roboto;font-weight: 400;background-color: #1969bc;" data-toggle="tooltip" data-placement="top" title="Sudah Lunas ?" href="'.base_url().'apps/users_events/confirm_payment/'.$this->encryption->encode($hasil->id_user_event).'/'.$this->encryption->encode('1').'"><i class="fa fa-check-circle"></i> Update</a>';

                                    }elseif($hasil->status == "1"){

                                        $status = '<span class="badge badge-success" style="font-family: Roboto;font-weight: 400;background-color: #358420;"><i class="fa fa-check-circle"></i> Lunas</span>';

                                        $update_status = '<a class="badge badge-primary" style="font-family: Roboto;font-weight: 400;background-color: #1969bc;" data-toggle="tooltip" data-placement="top" title="Belum Lunas ?" href="'.base_url().'apps/users_events/confirm_payment/'.$this->encryption->encode($hasil->id_user_event).'/'.$this->encryption->encode('0').'"><i class="fa fa-ban"></i> Update</a>';
                                    }

                                    ?>
                                    <tr>
                                        <td class="text-center"><?php echo $no++; ?></td>
                                        <td> <?php echo $hasil->nama ?></td>
                                        <td><a href="<?php echo base_url() ?>events/read/<?php echo $hasil->slug ?>/" target="_blank" style="color: #367fa9"><?php echo $hasil->judul_event ?></a></td>
                                        <td class="text-center"> <?php echo $status ?></td>
                                        <td class="text-center">
                                            <?php echo $update_status ?>
                                            <a class='badge badge-success' style="font-family: Roboto;font-weight: 400;background-color: #358420;" data-toggle="tooltip" data-placement="top" title="Detail" href='<?php echo base_url() ?>apps/users_events/detail/<?php echo $this->encryption->encode($hasil->id_user_event) ?>'><i class="fa fa-external-link"></i> Detail</a>
                                            <a class='badge badge-danger' style="font-family: Roboto;font-weight: 400;background-color: #842020;" data-toggle="tooltip" data-placement="top" title="Delete ?" href='<?php echo base_url() ?>apps/users_events/delete/<?php echo $this->encryption->encode($hasil->id_user_event) ?>'><i class="fa fa-trash"></i> Delete</a>
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
                                    <a  href="<?php echo base_url('apps/users_events?source=reload&utf8=✓') ?>" class="btn btn-danger btn-reset btn-fill" id="load" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Reloading..."><i class="fa fa-repeat"></i> Reload Page</a>
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
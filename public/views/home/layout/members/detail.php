<?php
    if($detail_members != NULL) :
?>
    <!--=== News Block ===-->
    <div class="bg-color-light">
        <div class="container content-sm">
            <div class="row news-v2">
                <div class="col-md-7">
                    <div class="page-detail" style="-moz-box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);webkit-box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12);padding: 15px 15px;background-color: #fff">
                        <div class="content-page" style="font-size: 16px;color: #333">
                            <table class="table table-hover table-striped table-bordered">
                                <tr>
                                    <th style="font-size: 17px"><i class="fa fa-clone"></i> Attribute</th>
                                    <th style="font-size: 17px"><i class="fa fa-clone"></i> Value</th>
                                </tr>
                                <tr>
                                    <td style="width: 30%">Nama Lengkap</td>
                                    <td><?php echo $detail_members->nama ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 15%">Tempat tanggal Lahir</td>
                                    <td><?php echo $detail_members->ttl ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 15%">Jenis Kelamin</td>
                                    <td><?php echo $detail_members->jenis_kelamin ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 15%">Alamat</td>
                                    <td><?php echo $detail_members->alamat ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 15%">Institusi</td>
                                    <td><?php echo $detail_members->nama_institusi ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 15%">Alamat Email</td>
                                    <td><?php echo $detail_members->email ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 15%">No. Telp</td>
                                    <td><?php echo $detail_members->no_telp ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 15%">Line</td>
                                    <td><?php echo $detail_members->line ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 15%">BBM</td>
                                    <td><?php echo $detail_members->bbm ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 15%">Instagram</td>
                                    <td><?php echo $detail_members->instagram ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 15%">Facebook</td>
                                    <td><?php echo $detail_members->facebook ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 15%">Riwayat Pendidikan</td>
                                    <td><?php echo $detail_members->riwayat_pendidikan ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 15%">Riwayat Pengalaman Organisasi</td>
                                    <td><?php echo $detail_members->riwayat_pengalaman_organisasi ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 15%">Agama</td>
                                    <td><?php echo $detail_members->agama ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 15%">Telephone Rumah</td>
                                    <td><?php echo $detail_members->telephone_rumah ?></td>
                                </tr>
                            </table>
                            <a href="<?php echo base_url() ?>members/" class="btn-u btn-u-sea btn-block rounded"> <i class="icon-arrow-left"></i> Kembali</a>
                        </div>
                    </div>
                </div>
                <?php
                else:
                    ?>
                    <?php redirect('/') ?>
                <?php endif; ?>
                <div class="col-md-5">
                    <?php
                    if($articles_terbaru != NULL) :
                        foreach ($articles_terbaru->result() as $hasil):
                            ?>
                            <div class="page-detail" style="margin-bottom:10px;-moz-box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);webkit-box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12);padding: 15px 15px;background-color: #fff">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="">
                                            <img class="media-object" src="<?php echo base_url() ?>resources/images/articles/<?php echo $hasil->thumbnail ?>" style="width: 168px;height: 94px" alt="...">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <a href="<?php echo base_url() ?>articles/read/<?php echo $hasil->slug ?>/" style="text-decoration: none">
                                            <h4 class="media-heading" style="font-family: Roboto;font-weight: 400;font-size: 14px"><?php echo $hasil->judul_articles ?></h4>
                                        </a>
                                        <div class="date" style="color: #333">
                                            <i class="fa fa-calendar-o"></i> <?php echo $this->web->tgl_indo_no_hari($hasil->created_at) ?> <i class="fa fa-eye"></i> Dilihat <?php echo $hasil->views ?> kali
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        endforeach;
                        ?>
                        <?php
                    else:
                        ?>

                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <!--=== End News Block ===-->

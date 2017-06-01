<!--=== News Block ===-->
<div class="bg-color-light">
    <div class="container content-sm">
        <div class="row news-v2">
            <?php
            if($detail_events != NULL) :
                ?>
                <div class="col-md-7">

                    <div class="page-detail" style="-moz-box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);webkit-box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12);padding: 15px 15px;background-color: #fff">
                        <h2><?php echo $detail_events->judul_event ?></h2>
                        <hr>
                        <div class="content-page" style="font-size: 16px;color: #333">
                            <img src="<?php echo base_url() ?>resources/images/events/<?php echo $detail_events->thumbnail ?>" class="img-responsive">
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="page-detail" style="-moz-box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);webkit-box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12);padding: 15px 15px;background-color: #fff">
                        <div class="secsion-articles" style="font-size: 14px;color: #333;margin-top: 10px">
                            <?php echo $detail_events->isi_event ?>
                        </div>
                        <hr>
                        <div class="event-author" style="font-size: 16px;color: #333;">
                            <i class="fa fa-map-marker"></i>  Lokasi Event :
                             <?php echo $detail_events->lokasi_event ?>
                            <hr>
                            <i class="fa fa-cc-paypal"></i>  Harga Ticket Event :
                            <?php echo $detail_events->harga ?>
                            <hr>
                            <a href="<?php echo base_url() ?>events/join/<?php echo $this->encryption->encode($detail_events->id_event) ?>" class="btn-u btn-u-sea btn-block rounded" style="padding-top: 12px;padding-bottom: 12px;text-transform: uppercase;">BELI <i class="fa fa-calendar-check-o"></i> </a>
                       
                            <a href="" class="btn-block btn btn-info rounded" type="button" data-toggle="modal" data-target="#myModal">Lihat Yang Mendaftar</a>
                        </div>

                    </div>
                </div>
                <?php
            else:
                ?>

            <?php endif; ?>
        </div>
    </div>
</div>
<!--=== End News Block ===-->

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center">PESERTA YANG MENDAFTAR</h4>
      </div>
      <div class="modal-body ">
        
            <table id="table-peserta" class="table table-striped">
                <thead>
                  <tr>
                    <th>Event</th>
                    <th>Nama Peserta</th>
                    <th>Panitia Membawa</th>
                    <th>status</th>
                  </tr>
                </thead>
            </table>  

            


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
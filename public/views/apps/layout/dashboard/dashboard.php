
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
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?php print $today_visit ?></h3>

                    <p>HARI INI</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?php print $week_visit ?></h3>

                    <p>MINGGU INI</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3><?php print $month_visit ?></h3>

                    <p>BULAN INI</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3><?php print $year_visit ?></h3>

                    <p>TAHUN INI</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

     <div class="row">
         <div class="col-md-12">
             <div class="box box-solid">
                 <div class="box-header with-border">
                     <h3 class="box-title">Grafik Pengunjung</h3>
                 </div>
                 <!-- /.box-header -->
                 <div class="box-body">
                     <div class="btn-group">
                         <button type="button" id="hari" onclick="javascript:GetToday('<?php print date("Y-m-d") ?>')" class="btn btn-default btn-sm" style="border-radius: 0px;border-width: 1px;"><i class="fa fa-bar-chart-o"></i></i> Hari ini</button>
                         <button type="button" id="minggu" onclick="javascript:GetWeek(<?php print date("Y-m-d") ?>, <?php print date( "Y-m-d", strtotime( date("Y-m-d"). "-7 day" ) ) ?>)" class="btn btn-default btn-sm" style="border-radius: 0px;border-width: 1px;"><i class="fa fa-bar-chart-o"></i></i> Minggu ini</button>
                         <button type="button" id="bulan" onclick="javascript:GetMonth(<?php print date("Y-m-d") ?>)" class="btn btn-default btn-sm" style="border-radius: 0px;border-width: 1px;"><i class="fa fa-bar-chart-o"></i></i> Bulan ini</button>
                         <button type="button" id="tahun" onclick="javascript:GetAllTime()" class="btn btn-default btn-sm" style="border-radius: 0px;border-width: 1px;"><i class="fa fa-bar-chart-o"></i></i> Semua</button>
                     </div>
                     <hr>
                        <div id="container" style="width: 98%"></div>
                 </div>
                 <!-- /.box-body -->
             </div>
         </div>
     </div>

    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
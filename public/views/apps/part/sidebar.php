<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url() ?>resources/images/avatar/<?php echo $this->session->userdata('apps_foto') ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo $this->session->userdata('apps_nama') ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li <?php if(isset($dashboard)) { echo 'class="active"'; } ?>><a href="<?php echo base_url() ?>apps/dashboard/"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
            <li <?php if(isset($users)) { echo 'class="active"'; } ?>><a href="<?php echo base_url() ?>apps/users/"><i class="fa fa-user-circle-o"></i> <span>Users</span></a></li>
            <li <?php if(isset($institusi)) { echo 'class="active"'; } ?>><a href="<?php echo base_url() ?>apps/institusi/"><i class="fa fa-building-o"></i> <span>Institusi</span></a></li>

            <li <?php if(isset($panitia)) { echo 'class="active"'; } ?>><a href="<?php echo base_url() ?>apps/panitia/"><i class="fa fa-id-card"></i> <span>Panitia</span></a></li>

            <li <?php if(isset($members)) { echo 'class="active"'; } ?>><a href="<?php echo base_url() ?>apps/members/"><i class="fa fa-users"></i> <span>Members</span></a></li>
            <li <?php if(isset($pages)) { echo 'class="active"'; } ?>><a href="<?php echo base_url() ?>apps/pages/"><i class="fa fa-television"></i> <span>Pages</span></a></li>
            <li <?php if(isset($events)) { echo 'class="active"'; } ?>><a href="<?php echo base_url() ?>apps/events/"><i class="fa fa-calendar-o"></i> <span>Events</span></a></li>
            <li <?php if(isset($users_events)) { echo 'class="active"'; } ?>><a href="<?php echo base_url() ?>apps/users_events/"><i class="fa fa-male"></i> <span>Users Events</span></a></li>
            <li <?php if(isset($articles)) { echo 'class="active"'; } ?>><a href="<?php echo base_url() ?>apps/articles/"><i class="fa fa-book"></i> <span>Articles</span></a></li>
            <li <?php if(isset($gallery)) { echo 'class="active"'; } ?>><a href="<?php echo base_url() ?>apps/gallery/"><i class="fa fa-picture-o"></i> <span>Gallery</span></a></li>
            <li class="header">MAIN SYSTEM</li>
            <li <?php if(isset($sliders)) { echo 'class="active"'; } ?>><a href="<?php echo base_url() ?>apps/sliders/"><i class="fa fa-desktop"></i> <span>Setting Slider</span></a></li>
            <li <?php if(isset($systems)) { echo 'class="active"'; } ?>><a href="<?php echo base_url() ?>apps/systems/"><i class="fa fa-cogs"></i> <span>Setting System</span></a></li>
            <li <?php if(isset($mails)) { echo 'class="active"'; } ?>><a href="<?php echo base_url() ?>apps/mails/"><i class="fa fa-envelope"></i> <span>Setting Mail Server</span></a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
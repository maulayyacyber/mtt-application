<!DOCTYPE html>
<html lang="en" class="ie8">
<html lang="en" class="ie9">
<html lang="en">
<head>
    <title><?php echo $title  ?> - <?php echo systems('site_title') ?></title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="<?php if(isset($author)) { echo $author; } else { echo 'Medical Top Team'; } ?>">
    <meta name="robots" content="no-cache">
    <meta name="description" content="<?php print $descriptions ?>">
    <meta name="keywords" content="<?php print $keywords ?>">
    <meta property="og:url" content="<?php print base_url() ?><?php print $this->uri->uri_string() ?>/">
    <meta property="og:site_name" content="Pondok Kode">
    <meta property="og:title" content="<?php print $title ?>">
    <meta property="og:description" content="<?php print $descriptions ?>">
    <meta property="og:image" content="<?php print base_url('resources/images/logo.png') ?>">
    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">

    <!-- Web Fonts -->
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin'>

    <!-- CSS Global Compulsory -->
    <link rel="stylesheet" href="<?php echo base_url() ?>resources/frontend/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>resources/frontend/css/style.css">

    <!-- CSS Header and Footer -->
    <link rel="stylesheet" href="<?php echo base_url() ?>resources/frontend/css/headers/header-v6.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>resources/frontend/css/footers/footer-v6.css">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="<?php echo base_url() ?>resources/frontend/plugins/animate.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>resources/frontend/plugins/line-icons/line-icons.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>resources/frontend/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>resources/frontend/plugins/cube-portfolio/cubeportfolio/css/cubeportfolio.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>resources/frontend/plugins/cube-portfolio/cubeportfolio/custom/custom-cubeportfolio.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>resources/frontend/plugins/fancybox/source/jquery.fancybox.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>resources/frontend/plugins/owl-carousel/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>resources/frontend/plugins/master-slider/masterslider/style/masterslider.css">
    <link rel='stylesheet' href="<?php echo base_url() ?>resources/frontend/plugins/master-slider/masterslider/skins/black-2/style.css">
    <!-- CSS Pages Style -->
    <link rel="stylesheet" href="<?php echo base_url() ?>resources/frontend/css/pages/page_one.css">

    <!-- CSS Theme -->
    <link rel="stylesheet" href="<?php echo base_url() ?>resources/frontend/css/theme-colors/default.css" id="style_color">
    <link rel="stylesheet" href="<?php echo base_url() ?>resources/frontend/css/theme-skins/dark.css">

    <!-- CSS Customization -->
    <link rel="stylesheet" href="<?php echo base_url() ?>resources/frontend/css/custom.css">
    <script>
        var url = "<?php echo base_url() ?>";
    </script>
</head>

<body class="header-fixed header-fixed-space">
<div class="wrapper">
    <!--=== Header v6 ===-->
    <div class="header-v6 header-classic-white header-sticky" style="-moz-box-shadow: 1px 1px 2px 0 rgba(0,0,0,.12);webkit-box-shadow: 1px 1px 2px 0 rgba(0,0,0,.12);box-shadow: 1px 1px 2px 0 rgba(0,0,0,.12);">
        <!-- Navbar -->
        <div class="navbar mega-menu" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="menu-container">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Navbar Brand -->
                    <div class="navbar-brand">
                        <a href="<?php echo base_url() ?>">
                            <img class="shrink-logo" src="<?php echo base_url() ?>resources/images/logo.png" alt="Logo">
                        </a>
                    </div>
                    <!-- ENd Navbar Brand -->

                    <!-- Header Inner Right -->
                    <div class="header-inner-right">
                        <ul class="menu-icons-list">
                            <li class="menu-icons">
                                <i class="menu-icons-style search search-close search-btn fa fa-search"></i>
                                <div class="search-open">
                                    <form method="GET" action="<?php echo base_url('articles/search');?>">
                                        <input type="text" name="q" class="animated fadeIn form-control" placeholder="Enter keywords...">
                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- End Header Inner Right -->
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-responsive-collapse">
                    <div class="menu-container">
                        <ul class="nav navbar-nav">
                            <!-- Home -->
                            <li class="<?php if(isset($home)) { echo 'active'; } ?>"><a href="<?php echo base_url() ?>"><i class="fa fa-home"></i> Home</a></li>
                            <!-- End Home -->

                            <!-- Pages -->
                            <li class="dropdown <?php if(isset($profile)) { echo ' active'; } ?>">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-user-circle"></i> Profile
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- About Pages -->
                                    <li class="<?php if(isset($sejarah)) { echo 'active'; } ?>">
                                        <a href="<?php echo base_url() ?>sejarah/"><i class="icon-arrow-right"></i> Sejarah</a>
                                    </li>
                                    <li class="<?php if(isset($gallery)) { echo 'active'; } ?>">
                                        <a href="<?php echo base_url() ?>gallery/"><i class="icon-arrow-right"></i> Gallery</a>
                                    </li>
                                    <li class="<?php if(isset($arti_lgoo)) { echo 'active'; } ?>">
                                        <a href="<?php echo base_url() ?>arti-logo/"><i class="icon-arrow-right"></i> Arti Logo</a>
                                    </li>
                                    <li class="<?php if(isset($visi_misi)) { echo 'active'; } ?>">
                                        <a href="<?php echo base_url() ?>visi-dan-misi/"><i class="icon-arrow-right"></i> Visi dan Misi</a>
                                    </li>
                                    <li class="<?php if(isset($struktur_organisasi)) { echo 'active'; } ?>">
                                        <a href="<?php echo base_url() ?>struktur-organisasi/"><i class="icon-arrow-right"></i> Struktur Organisasi</a>
                                    </li>
                                    <!-- End About Pages -->
                                </ul>
                            </li>
                            <li class="<?php if(isset($members)) { echo 'active'; } ?>"><a href="<?php echo base_url() ?>members/"><i class="fa fa-male"></i> Member</a></li>
                            <li class="<?php if(isset($events)) { echo 'active'; } ?>"><a href="<?php echo base_url() ?>events/"><i class="fa fa-calendar-check-o"></i> Event</a></li>
                            <li class="<?php if(isset($contact)) { echo 'active'; } ?>"><a href="<?php echo base_url() ?>contact/"><i class="fa fa-comments-o"></i> Contact</a></li>
                            <!-- End Pages -->
                        </ul>
                    </div>
                </div><!--/navbar-collapse-->
            </div>
        </div>
        <!-- End Navbar -->
    </div>
    <!--=== End Header v6 ===-->

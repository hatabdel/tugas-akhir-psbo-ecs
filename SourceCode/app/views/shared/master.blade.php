<!doctype html>
<html>
    <head>
        <title>@yield('title') E-Learning Collaborative System</title>
        <link rel="stylesheet" href="<?php echo url()."/public/css/apps.css"; ?>" />
        <link rel="stylesheet" href="<?php echo url()."/public/scripts/bootstrap/bootstrap/bootstrap.min.css"; ?>" />
        <link rel="stylesheet" href="<?php echo url()."/public/scripts/bootstrap/bootstrap/bootstrap-responsive.min.css"; ?>" />
        <link rel="stylesheet" href="<?php echo url()."/public/scripts/bootstrap/font-awesome/css/font-awesome.min.css"; ?>" />
        <link rel="stylesheet" href="<?php echo url()."/public/scripts/bootstrap/normalize/normalize.css"; ?>" />
        
         <!--page specific css styles-->
        <link rel="stylesheet" href="<?php echo url()."/public/scripts/bootstrap/data-tables/DT_bootstrap.css"; ?>" />

        <!--flaty css styles-->
        <link rel="stylesheet" href="<?php echo url()."/public/css/flaty_themes/flaty.css"; ?>" />
        <link rel="stylesheet" href="<?php echo url()."/public/css/flaty_themes/flaty-responsive.css"; ?>" />

        
        <script type="text/javascript" src="<?php echo url()."/public/scripts/jquery/jquery.min.js"; ?>"></script>
        <script type="text/javascript" src="<?php echo url()."/public/scripts/modernizr/modernizr-2.6.2.min.js"; ?>"></script>
		<!--menambahkan icon-->
        <link rel="shortcut icon" href="favicon.ico">
        <script type="text/javascript" src="<?php echo url()."/public/scripts/bootstrap/bootstrap/bootstrap.min.js"; ?>"></script>
        <script type="text/javascript" src="<?php echo url()."/public/scripts/nicescroll/jquery.nicescroll.min.js"; ?>"></script>
        <script type="text/javascript" src="<?php echo url()."/public/js/datetimepicker_css.js"; ?>"></script>
        <script type="text/javascript" src="<?php echo url()."/public/images/cal.gif"; ?>"></script>

        <!--page specific plug in scripts-->
        <script type="text/javascript" src="<?php echo url()."/public/scripts/bootstrap/data-tables/jquery.dataTables.js"; ?>"></script>
        <script type="text/javascript" src="<?php echo url()."/public/scripts/bootstrap/data-tables/DT_bootstrap.js"; ?>"></script>

        <script type="text/javascript" src="<?php echo url()."/public/scripts/flot/jquery.flot.js"; ?>"></script>
        <script type="text/javascript" src="<?php echo url()."/public/scripts/flot/jquery.flot.resize.js"; ?>"></script>
        <script type="text/javascript" src="<?php echo url()."/public/scripts/flot/jquery.flot.pie.js"; ?>"></script>
        <script type="text/javascript" src="<?php echo url()."/public/scripts/flot/jquery.flot.stack.js"; ?>"></script>
        <script type="text/javascript" src="<?php echo url()."/public/scripts/flot/jquery.flot.crosshair.js"; ?>"></script>
        <script type="text/javascript" src="<?php echo url()."/public/scripts/flot/jquery.flot.tooltip.min.js"; ?>"></script>
        <script type="text/javascript" src="<?php echo url()."/public/scripts/sparkline/jquery.sparkline.min.js"; ?>"></script>
        
        <!--flaty scripts-->
        <script type="text/javascript" src="<?php echo url()."/public/scripts/flaty/flaty.js"; ?>"></script>
        <script type="text/javascript" src="<?php echo url()."/public/scripts/aztable/azTable.js"; ?>"></script>
        <script type="text/javascript" src="<?php echo url()."/public/scripts/jquery.countdown.min.js"; ?>"></script>
        <script type="text/javascript" src="<?php echo url()."/public/scripts/apps.js"; ?>"></script>
        <script type="text/javascript">
            $(document).ready(function () { 
                if ($('#main-content').height() < $(window).height()) $('#main-content').css("min-height",$(window).height()); 
            });
        </script>
        <style type="text/css">
            #main-content {
                min-height: 100%;
            }
        </style>
    </head>
    <body>
	    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <!-- BEGIN Brand -->
                    <a href="#" class="brand">
                        <small>
                            <i class="icon-desktop"></i>
                            E-Learning Collaborative System 
                        </small>
                    </a>
                    <!-- END Brand -->

                    <!-- BEGIN Responsive Sidebar Collapse -->
                    <a href="#" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
                        <i class="icon-reorder"></i>
                    </a>
                    <!-- END Responsive Sidebar Collapse -->

                    <!-- BEGIN Navbar Buttons -->
                    <?php 
                    $show = true;
                    if (isset($mode)) {
                        if ($mode == "register") {
                            $show = false;
                        }
                    }
                    if ($show) {
                    ?>
                    <ul class="nav flaty-nav pull-right">
                      <!-- BEGIN Button User -->
                        <li class="nav-header" style="display:none">
                            <i class="icon-time"></i>
                            Logined From 20:45
                        </li>
                        <li class="divider"></li>

                        <li>
                            <a href="<?php echo url()."/login/logout"; ?>">
                                <i class="icon-off"></i>
                            </a>
                        </li>
                        <!-- END Button User -->
                    </ul>
                    <?php } ?>
                    <!-- END Navbar Buttons -->
                </div><!--/.container-fluid-->
            </div><!--/.navbar-inner-->
        </nav>
        <!-- END Navbar -->

        <!-- BEGIN Container -->
        <div class="container-fluid" id="main-container">
            <!-- BEGIN Side bar -->
            <?php if ($show) { ?>
            <div id="sidebar" class="nav-collapse">
                @include('shared.leftmenu')
                <!-- BEGIN Side bar Collapse Button -->
                <div id="sidebar-collapse" class="visible-desktop">
                    <i class="icon-double-angle-left"></i>
                </div>
                <!-- END Side bar Collapse Button -->
            </div>
            <?php } ?>
            <!-- END Side bar -->

            <!-- BEGIN Content -->
            <div id="main-content" <?php echo (!$show ? "style=\"margin-left:0px;\"" : ""); ?>>
                <!-- BEGIN Page Title -->
                <div class="page-title">
                    <div>
                        <h1><strong><?php //echo $_MODULE_ID; ?></strong></h1>
                        <h4><?php //echo $_MODULE_DESCRIPTION; ?></h4>
                    </div>
                </div>
                <!-- END Page Title -->

                <!-- BEGIN Bread Crumb -->
                <div id="breadcrumbs" style="display: none">
                    <ul class="breadcrumb">
                        <li class="active"><i class="icon-home"></i>Home</li>
                    </ul>
                </div>
                <!-- END Bread Crumb -->

                <!-- BEGIN Main Content -->
                <div class="row-fluid">
				
                    @yield('main_content')
                </div>
                <!-- END Main Content -->
                
                <footer style="bottom: 0px;">
				
                    <p>2014 &copy; ECS - Bogor Agricultural University.</p>
                </footer>
                <a id="btn-scrollup" class="btn btn-circle btn-large" href="#"><i class="icon-chevron-up"></i></a>
            </div>
            <!-- END Content -->
        </div>
    </body>
</html>
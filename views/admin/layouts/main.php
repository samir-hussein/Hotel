<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    $this->response->redirect("/admin");
    exit;
}
?>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CMS</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="/views/admin/assets/css/normalize.css">
    <link rel="stylesheet" href="/views/admin/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/views/admin/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="/views/admin/assets/css/themify-icons.css">
    <link rel="stylesheet" href="/views/admin/assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="/views/admin/assets/css/cs-skin-elastic.css">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="/views/admin/assets/css/lib/datatable/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="/views/admin/assets/scss/style.css">
    <link href="/views/admin/assets/css/lib/vector-map/jqvmap.min.css" rel="stylesheet">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

    <style>
        html, body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            text-transform: capitalize;
        }
    </style>

</head>
<body>


        <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="/admin/home">CMS</a>
                <a class="navbar-brand hidden" href="/admin/home"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="/admin/home"> <i class="menu-icon fa fa-dashboard"></i>Home</a>
                    </li>
                    <h3 class="menu-title">Pages</h3><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>Home Slider</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-bars"></i><a href="/admin/all_home_slider">edit & delete</a></li>
                            <li><i class="fa fa-bars"></i><a href="/admin/add_home_slider">add</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>Hotel images</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-bars"></i><a href="/admin/all_hotel_images">delete</a></li>
                            <li><i class="fa fa-bars"></i><a href="/admin/add_hotel_images">add</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>about us</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-bars"></i><a href="/admin/all_about_us">edit & delete</a></li>
                            <li><i class="fa fa-bars"></i><a href="/admin/add_about_us">add</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>food departments</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-bars"></i><a href="/admin/add_food_department">add</a></li>
                            <li><i class="fa fa-bars"></i><a href="/admin/delete_food_department">delete</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>all Foods</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-bars"></i><a href="/admin/add_food">add</a></li>
                            <li><i class="fa fa-bars"></i><a href="/admin/all_foods">edit & delete</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>room types</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-bars"></i><a href="/admin/add_room_type">add</a></li>
                            <li><i class="fa fa-bars"></i><a href="/admin/all_room_types">edit & delete</a></li>
                        </ul>
                    </li>
                    <?php if ($_SESSION['type'] == "owner"): ?>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>Users</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-th"></i><a href="/admin/add-user">Add</a></li>
                            <li><i class="menu-icon fa fa-th"></i><a href="/admin/all-user">All Users</a></li>
                        </ul>
                    </li>
                    <?php endif;?>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <div class="header-left">
                        <h5 style="text-transform: capitalize;"><a href="home"><i class="fa fa-user"></i> Welcome <?=$_SESSION['user']?></a></h5>
                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="/logout">
                            <button class="btn btn-danger float-right">Logout</button>
                        </a>
                    </div>
                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->
        {{content}}
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="/views/admin/assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="/views/admin/assets/js/plugins.js"></script>
    <script src="/views/admin/assets/js/main.js"></script>


    <script src="/views/admin/assets/js/lib/chart-js/Chart.bundle.js"></script>
    <script src="/views/admin/assets/js/dashboard.js"></script>
    <script src="/views/admin/assets/js/widgets.js"></script>
    <script src="/views/admin/assets/js/lib/data-table/datatables.min.js"></script>
    <script src="/views/admin/assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="/views/admin/assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="/views/admin/assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
    <script src="/views/admin/assets/js/lib/data-table/jszip.min.js"></script>
    <script src="/views/admin/assets/js/lib/data-table/pdfmake.min.js"></script>
    <script src="/views/admin/assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="/views/admin/assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="/views/admin/assets/js/lib/data-table/buttons.print.min.js"></script>
    <script src="/views/admin/assets/js/lib/data-table/buttons.colVis.min.js"></script>
    <script src="/views/admin/assets/js/lib/data-table/datatables-init.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
          $('#bootstrap-data-table-export').DataTable();
        } );

        $('.msg').fadeOut(10000);
    </script>

</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="./assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">

    <!-- MetisMenu CSS -->
    <link href="./assets/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="./assets/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="./assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<div class="preloader"></div>
<div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="./">Social Tool</a>
        </div>
        <!-- /.navbar-header -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li>
                        <a data-template="dashboard" class="load-template"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="./"><i class="fa fa-facebook-official" aria-hidden="true" style="margin-right: 5px"></i> Facebook<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a data-template="" class="load-template">Lên Lịch Post Bài</a>
                            </li>
                            <li>
                                <a data-template="" class="load-template">Check Comment Post</a>
                            </li>
                            <li>
                                <a data-template="" class="load-template">Up Comment</a>
                            </li>
                            <li>
                                <a data-template="" class="load-template">Up Share</a>
                            </li>
                            <li>
                                <a data-template="" class="load-template">Get Token</a>
                            </li>
                            <li>
                                <a data-template="facebook.add-token" class="load-template">Add Token</a>
                            </li>
                            <li>
                                <a data-template="facebook.list-token" class="load-template">Danh Sách Token</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a><i class="fa fa-youtube-play" aria-hidden="true" style="margin-right: 5px"></i> Youtube<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a data-template="" class="load-template">Up Comment</a>
                            </li>
                            <li>
                                <a data-template="" class="load-template">Up Like</a>
                            </li>
                            <li>
                                <a data-template="" class="load-template">Add Cookie</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>

    <div id="page-wrapper">

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="./assets/vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="./assets/vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="./assets/vendor/metisMenu/metisMenu.js"></script>

<!-- Custom Theme JavaScript -->
<script src="./assets/js/sb-admin-2.js"></script>

<!-- Init File JavaScript -->
<script src="./assets/js/init.js"></script>
<script src="./assets/js/facebook/add-token.js"></script>
<script src="./assets/js/facebook/list-token.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
</body>

</html>

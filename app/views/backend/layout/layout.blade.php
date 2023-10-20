<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>САС</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="/backend/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/backend/css/fonts/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="/backend/css/icons/ionicons.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="/backend/plugins/select2/select2.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/backend/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="/backend/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/backend/plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="/backend/plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="/backend/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="/backend/plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="/backend/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="/backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <!-- jquery-nestable -->
    <link rel="stylesheet" href="/backend/plugins/jquery-nestable/jquery.nestable.css">
    <!-- Pace style -->
    <link rel="stylesheet" href="/backend/plugins/pace/pace.min.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="/backend/plugins/iCheck/all.css">

    <!-- BEGIN:File Upload Plugin CSS files-->
    <link href="/backend/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet"/>
    <link href="/backend/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet"/>
    <link href="/backend/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet"/>

    <!-- custom -->
    <link rel="stylesheet" href="/backend/css/custom.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="/backend/js/html5shiv.min.js"></script>
    <script src="/backend/js/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition skin-black sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="/admin/dashboard" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>A</b>LT</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">
                <img src="/backend/img/logo_sas.png" alt="Super Assist Systems Admin panel">
            </span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="/backend/img/person-icon.png" class="user-image" alt="User Image">
                            <span class="hidden-xs">{{ Auth::user()->username }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            {{--<li class="user-header">--}}
                                {{--<img src="/backend/img/user2-160x160.jpg" class="img-circle" alt="User Image">--}}

                                {{--<p>--}}
                                    {{--Alexander Pierce - Web Developer--}}
                                    {{--<small>Member since Nov. 2012</small>--}}
                                {{--</p>--}}
                            {{--</li>--}}
                            <!-- Menu Body -->
                            {{--<li class="user-body">--}}
                                {{--<div class="row">--}}
                                    {{--<div class="col-xs-4 text-center">--}}
                                        {{--<a href="#">Followers</a>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-xs-4 text-center">--}}
                                        {{--<a href="#">Sales</a>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-xs-4 text-center">--}}
                                        {{--<a href="#">Friends</a>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<!-- /.row -->--}}
                            {{--</li>--}}
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                {{--<div class="pull-left">--}}
                                    {{--<a href="#" class="btn btn-default btn-flat">Profile</a>--}}
                                {{--</div>--}}
                                <div class="pull-right">
                                    <a href="/logout" class="btn btn-danger btn-flat">Гарах</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- sidebar menu: : style can be found in sidebar.less -->
            @include('backend.contents.menus.menu')
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        {{ $content or '' }}

    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2016 <a href="http://www.super-assist.com/" target="_blank">Super Assist
                Systems</a>.</strong> All rights
        reserved.
    </footer>

    <div class="category-modal">
        <div class="modal">
            <div class="modal-dialog">
                <div class="modal-content">

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </div>
    <!-- /.example-modal -->

    <div class="picture-modal">
        <div class="modal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </div>
    <!-- /.example-modal -->

</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.0 -->
<script src="/backend/plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/backend/js/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="/backend/bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="/backend/js/raphael-min.js"></script>
<script src="/backend/plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="/backend/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="/backend/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="/backend/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="/backend/plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="/backend/js/moment.min.js"></script>
<script src="/backend/plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="/backend/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="/backend/plugins/datepicker/locales/bootstrap-datepicker.mn.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="/backend/plugins/ckeditor/ckeditor.js"></script>
<script src="/backend/plugins/ckeditor/adapters/jquery.js"></script>
<!-- Ckeditor -->
<script src="/backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="/backend/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/backend/plugins/fastclick/fastclick.js"></script>
<!-- Jquery-nestable -->
<script src="/backend/plugins/jquery-nestable/jquery.nestable.js"></script>
<!-- AdminLTE App -->
<script src="/backend/js/app.min.js"></script>

<!-- BEGIN:File Upload Plugin JS files-->
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="/backend/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="/backend/plugins/jquery-file-upload/js/vendor/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="/backend/plugins/jquery-file-upload/js/vendor/load-image.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="/backend/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min.js"></script>
<!-- blueimp Gallery script -->
<script src="/backend/plugins/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="/backend/plugins/jquery-file-upload/js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="/backend/plugins/jquery-file-upload/js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="/backend/plugins/jquery-file-upload/js/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="/backend/plugins/jquery-file-upload/js/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin -->
<script src="/backend/plugins/jquery-file-upload/js/jquery.fileupload-audio.js"></script>
<!-- The File Upload video preview plugin -->
<script src="/backend/plugins/jquery-file-upload/js/jquery.fileupload-video.js"></script>
<!-- The File Upload validation plugin -->
<script src="/backend/plugins/jquery-file-upload/js/jquery.fileupload-validate.js"></script>
<!-- The File Upload user interface plugin -->
<script src="/backend/plugins/jquery-file-upload/js/jquery.fileupload-ui.js"></script>
<!-- PACE -->
<script src="/backend/plugins/pace/pace.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="/backend/plugins/iCheck/icheck.min.js"></script>
<!-- Select2 -->
<script src="/backend/plugins/select2/select2.full.min.js"></script>

<script src="/backend/js/form-fileupload.js"></script>

<!-- Custom -->
<script src="/backend/js/custom.js"></script>
</body>
</html>
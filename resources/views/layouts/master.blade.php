<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76"
        href="https://demos.creative-tim.com/material-dashboard-pro/assets/img/apple-icon.png">
    <link rel="icon" type="image/png"
        href="https://demos.creative-tim.com/material-dashboard-pro/assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        AMS-@yield('title')
    </title>

    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="https://demos.creative-tim.com/material-dashboard-pro/assets/css/material-dashboard.min.css?v=2.1.2"
        rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="https://demos.creative-tim.com/material-dashboard-pro/assets/demo/demo.css" rel="stylesheet" />
    <!-- Google Tag Manager -->

    <!-- Latest compiled and minified CSS -->
    {{-- <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css"> --}}

    {{-- select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    @yield('css')
</head>

<body class="">
    <div class="wrapper ">
        <div class="sidebar" data-color="rose" data-background-color="black"
            data-image="https://demos.creative-tim.com/material-dashboard-pro/assets/img/sidebar-1.jpg">
            <!--Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger" Tip 2: you can also add an image using data-image tag-->
            <div class="logo"><a href="{{ route('home') }}" class="simple-text logo-mini">
                    S
                </a>
                <a href="{{ route('home') }}" class="simple-text logo-normal">
                    Manager
                </a></div>
            <div class="sidebar-wrapper">
                <div class="user">
                    <div class="photo">
                        <img src="{{ asset('avatar1-1.png') }}" />
                    </div>
                    <div class="user-info">
                        <a data-toggle="collapse" href="#collapseExample" class="username">
                            <span>
                                {{ ucfirst(Auth()->user()->name) }}
                                <b class="caret"></b>
                            </span>
                        </a>
                        <div class="collapse" id="collapseExample">
                            <ul class="nav">
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('teacher.profile', ['id'=>auth()->user()->id]) }}">
                                        <span class="sidebar-mini"> MP </span>
                                        <span class="sidebar-normal"> My Profile </span>
                                    </a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a class="nav-link"
                                    @if (auth()->user()->type == 2) href="{{ route('teacher.edit', ['teacher' => auth()->user()->id]) }}"
                                @elseif (auth()->user()->type == 3)
                                href="{{ route('student.edit', ['student' => auth()->user()->id]) }}" @endif>
                                <span class="sidebar-mini"> EP </span>
                                <span class="sidebar-normal"> Edit Profile </span>
                                </a>
                                </li> --}}
                                {{-- <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        <span class="sidebar-mini"> S </span>
                                        <span class="sidebar-normal"> Settings </span>
                                    </a>
                                </li> --}}
                            </ul>
                        </div>
                    </div>
                </div>
                <ul class="nav">

                    <li class="nav-item {{ (request()->is('home')) ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="material-icons">dashboard</i>
                            <p> Dashboard </p>
                        </a>
                    </li>

                    @if (auth()->user()->type == 1 )
                    <li
                        class="nav-item {{ (request()->is('subject*') || request()->is('course*') || request()->is('department*')) ? 'active' : '' }}">
                        <a class="nav-link" data-toggle="collapse" href="#componentsExamples1">
                            <i class="material-icons">person</i>
                            <p> Masters
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse {{ (request()->is('subject*') || request()->is('course*') || request()->is('department*')) ? 'show' : '' }}"
                            id="componentsExamples1">
                            <ul class="nav">
                                <li class="nav-item {{ (request()->is('subject*')) ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('subject.create') }}">
                                        <i class="material-icons">subject</i>
                                        <p> Subject </p>
                                    </a>
                                </li>
                            </ul>

                            <ul class="nav">
                                <li class="nav-item {{ (request()->is('department*')) ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('department.create') }}">
                                        <i class="material-icons">view_headline</i>
                                        <p> Department </p>
                                    </a>
                                </li>
                            </ul>

                            {{-- <ul class="nav">
                                <li class="nav-item {{ (request()->is('course*')) ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('course.create') }}">
                                        <i class="material-icons">view_headline</i>
                                        <p> Subjects of Dep. </p>
                                    </a>
                                </li>
                            </ul> --}}
                        </div>
                    </li>
                    {{-- @endif

                    @if (auth()->user()->type == 1) --}}
                    <li class="nav-item {{ (request()->is('teacher*') || request()->is('student*')) ? 'active' : '' }}">
                        <a class="nav-link" data-toggle="collapse" href="#componentsExamples">
                            <i class="material-icons">person</i>
                            <p> User Management
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse {{ (request()->is('teacher*') || request()->is('student*')) ? 'show' : '' }}"
                            id="componentsExamples">
                            <ul class="nav">
                                <li class="nav-item {{ (request()->is('teacher*')) ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('teacher.create') }}">
                                        <span class="sidebar-mini"> T </span>
                                        <span class="sidebar-normal"> Teachers </span>
                                    </a>
                                </li>
                            </ul>

                            <ul class="nav">
                                <li class="nav-item {{ (request()->is('student*')) ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('student.create') }}">
                                        <span class="sidebar-mini"> S </span>
                                        <span class="sidebar-normal"> Students </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endif

                    @if (auth()->user()->type == 1 || auth()->user()->type == 2 )
                    <li class="nav-item {{ (request()->is('attendance*')) ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('attendance.create') }}">
                            <i class="material-icons">view_headline</i>
                            <p> Mark Attendance </p>
                        </a>
                    </li>

                    <li class="nav-item {{ (request()->is('close*')) ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('close.create') }}">
                            <i class="material-icons">view_headline</i>
                            <p> Close Attendance </p>
                        </a>
                    </li>
                    @endif

                    @if (auth()->user()->type == 1 )
                    <li class="nav-item {{ (request()->is('report*') ) ? 'active' : '' }}">
                        <a class="nav-link" data-toggle="collapse" href="#report">
                            <i class="material-icons">person</i>
                            <p> Reports
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse {{ (request()->is('report*') ) ? 'show' : '' }}"
                            id="report">
                            <ul class="nav">
                                <li class="nav-item {{ (request()->is('*student-list')) ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('report.student-list') }}">
                                        <i class="material-icons">subject</i>
                                        <p> Students List </p>
                                    </a>
                                </li>
                            </ul>

                            <ul class="nav">
                                <li class="nav-item {{ (request()->is('*teacher-list')) ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('report.teacher-list') }}">
                                        <i class="material-icons">subject</i>
                                        <p> Teacher List </p>
                                    </a>
                                </li>
                            </ul>

                            {{-- <ul class="nav">
                                <li class="nav-item {{ (request()->is('*course-list')) ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('report.course-list') }}">
                                        <i class="material-icons">subject</i>
                                        <p> Course List </p>
                                    </a>
                                </li>
                            </ul> --}}

                            <ul class="nav">
                                <li class="nav-item {{ (request()->is('*course-list')) ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('report.course-list') }}">
                                        <i class="material-icons">subject</i>
                                        <p> Department List </p>
                                    </a>
                                </li>
                            </ul>

                           
                        </div>
                    </li>
                    @endif

                </ul>
            </div>
        </div>

        <div class="main-panel">

            <!-- Navbar top-->
            <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <div class="navbar-minimize">
                            <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
                                <i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
                                <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
                            </button>
                        </div>
                        <a class="navbar-brand" href="javascript:;">@yield('pageTitle')</a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end">
                        <ul class="navbar-nav">

                            <li class="nav-item dropdown">
                                <a class="nav-link" href="javascript:;" id="navbarDropdownProfile"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">person</i>
                                    <p class="d-lg-none d-md-block">
                                        Account
                                    </p>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                                    {{-- <a class="dropdown-item" href="#">Profile</a>
                                    <a class="dropdown-item" href="#">Settings</a> --}}
                                    <div class="dropdown-divider"></div>

                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                    {{-- <a class="dropdown-item" href="#">Log out</a> --}}
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar top -->

            <div class="content">
                <div class="content">
                    <div class="container-fluid">

                        @include('layouts.success_error')

                        @yield('content')

                        <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form method="POST" id="deleteForm">
                                    @csrf
                                    @method('DELETE');
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            Confirm Delete!!
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you wish to remove " <strong id="remove"></strong>"?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default"
                                                data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-danger btn-ok">Delete</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <footer class="footer">
                <div class="container-fluid">

                </div>
            </footer>
        </div>
    </div>

    <!--   Core JS Files   -->
    <script src="https://demos.creative-tim.com/material-dashboard-pro/assets/js/core/jquery.min.js"></script>
    <script src="https://demos.creative-tim.com/material-dashboard-pro/assets/js/core/popper.min.js"></script>
    <script src="https://demos.creative-tim.com/material-dashboard-pro/assets/js/core/bootstrap-material-design.min.js">
    </script>
    <script
        src="https://demos.creative-tim.com/material-dashboard-pro/assets/js/plugins/perfect-scrollbar.jquery.min.js">
    </script>
    <!-- Plugin for the momentJs  -->
    <script src="https://demos.creative-tim.com/material-dashboard-pro/assets/js/plugins/moment.min.js"></script>
    <!--  Plugin for Sweet Alert -->
    <script src="https://demos.creative-tim.com/material-dashboard-pro/assets/js/plugins/sweetalert2.js"></script>
    <!-- Forms Validations Plugin -->
    <script src="https://demos.creative-tim.com/material-dashboard-pro/assets/js/plugins/jquery.validate.min.js">
    </script>
    <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
    <script src="https://demos.creative-tim.com/material-dashboard-pro/assets/js/plugins/jquery.bootstrap-wizard.js">
    </script>
    <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="https://demos.creative-tim.com/material-dashboard-pro/assets/js/plugins/bootstrap-selectpicker.js">
    </script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <!-- (Optional) Latest compiled and minified JavaScript translation files -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script> --}}

    <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
    {{-- <script
        src="https://demos.creative-tim.com/material-dashboard-pro/assets/js/plugins/bootstrap-datetimepicker.min.js">
    </script> --}}
    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
    <script src="https://demos.creative-tim.com/material-dashboard-pro/assets/js/plugins/jquery.dataTables.min.js">
    </script>
    <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
    <script src="https://demos.creative-tim.com/material-dashboard-pro/assets/js/plugins/bootstrap-tagsinput.js">
    </script>
    <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
    <script src="https://demos.creative-tim.com/material-dashboard-pro/assets/js/plugins/jasny-bootstrap.min.js">
    </script>
    <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
    <script src="https://demos.creative-tim.com/material-dashboard-pro/assets/js/plugins/fullcalendar.min.js"></script>
    <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2Yno10-YTnLjjn_Vtk0V8cdcY5lC4plU"></script>
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Chartist JS -->
    <script src="https://demos.creative-tim.com/material-dashboard-pro/assets/js/plugins/chartist.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="https://demos.creative-tim.com/material-dashboard-pro/assets/js/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="https://demos.creative-tim.com/material-dashboard-pro/assets/js/material-dashboard.min.js?v=2.1.2"
        type="text/javascript"></script>
    <!-- Material Dashboard DEMO methods, don't include it in your project! -->
    <script src="https://demos.creative-tim.com/material-dashboard-pro/assets/demo/demo.js"></script>

    {{-- select2 --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>


    @yield('script')

    <script>
        $(document).ready(function() {
        $().ready(function() {

        // $('select').select2({
        //     theme: "classic"
        // });

        $('select').selectpicker({
            liveSearch: true,
            // liveSearchNormalize: true,
            style: 'select-with-transition',
        });


        $('#datatables').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
            ],
            responsive: false,
            language: {
            search: "_INPUT_",
            searchPlaceholder: "Search records",
            }
        });

        $('#confirm-delete').on('show.bs.modal', function(e) {
            // $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            // alert ($(e.relatedTarget).data('href'));
            // $('#deleteForm').action = $(e.relatedTarget).data('href');
            $("#deleteForm").attr("action", $(e.relatedTarget).data('href')); //Will set it
            $('#deleteId').val($(e.elatedTarget).data('id'));
            $(this).find('#remove').text($(e.relatedTarget).data('name'));
        });
        
        $sidebar = $('.sidebar');

        $sidebar_img_container = $sidebar.find('.sidebar-background');

        $full_page = $('.full-page');

        $sidebar_responsive = $('body > .navbar-collapse');

        window_width = $(window).width();

        fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

        if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
          if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
            $('.fixed-plugin .dropdown').addClass('open');
          }

        }

        $('.fixed-plugin a').click(function(event) {
          // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
          if ($(this).hasClass('switch-trigger')) {
            if (event.stopPropagation) {
              event.stopPropagation();
            } else if (window.event) {
              window.event.cancelBubble = true;
            }
          }
        });

        $('.fixed-plugin .active-color span').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-color', new_color);
          }

          if ($full_page.length != 0) {
            $full_page.attr('filter-color', new_color);
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.attr('data-color', new_color);
          }
        });

        $('.fixed-plugin .background-color .badge').click(function() {
          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('background-color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-background-color', new_color);
          }
        });

        $('.fixed-plugin .img-holder').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).parent('li').siblings().removeClass('active');
          $(this).parent('li').addClass('active');


          var new_image = $(this).find("img").attr('src');

          if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            $sidebar_img_container.fadeOut('fast', function() {
              $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
              $sidebar_img_container.fadeIn('fast');
            });
          }

          if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $full_page_background.fadeOut('fast', function() {
              $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
              $full_page_background.fadeIn('fast');
            });
          }

          if ($('.switch-sidebar-image input:checked').length == 0) {
            var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
            $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
          }
        });

        $('.switch-sidebar-image input').change(function() {
          $full_page_background = $('.full-page-background');

          $input = $(this);

          if ($input.is(':checked')) {
            if ($sidebar_img_container.length != 0) {
              $sidebar_img_container.fadeIn('fast');
              $sidebar.attr('data-image', '#');
            }

            if ($full_page_background.length != 0) {
              $full_page_background.fadeIn('fast');
              $full_page.attr('data-image', '#');
            }

            background_image = true;
          } else {
            if ($sidebar_img_container.length != 0) {
              $sidebar.removeAttr('data-image');
              $sidebar_img_container.fadeOut('fast');
            }

            if ($full_page_background.length != 0) {
              $full_page.removeAttr('data-image', '#');
              $full_page_background.fadeOut('fast');
            }

            background_image = false;
          }
        });

        $('.switch-sidebar-mini input').change(function() {
          $body = $('body');

          $input = $(this);

          if (md.misc.sidebar_mini_active == true) {
            $('body').removeClass('sidebar-mini');
            md.misc.sidebar_mini_active = false;

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

          } else {

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

            setTimeout(function() {
              $('body').addClass('sidebar-mini');

              md.misc.sidebar_mini_active = true;
            }, 300);
          }

          // we simulate the window Resize so the charts will get updated in realtime.
          var simulateWindowResize = setInterval(function() {
            window.dispatchEvent(new Event('resize'));
          }, 180);

          // we stop the simulation of Window Resize after the animations are completed
          setTimeout(function() {
            clearInterval(simulateWindowResize);
          }, 1000);

        });
      });
    });

    </script>
    <!-- Sharrre libray -->
    <script src="https://demos.creative-tim.com/material-dashboard-pro/assets/demo/jquery.sharrre.js"></script>

    <noscript>
        <img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=111649226022273&amp;ev=PageView&amp;noscript=1" />
    </noscript>
</body>

</html>
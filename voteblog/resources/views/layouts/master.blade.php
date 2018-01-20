<html lang="en">
    
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>@yield('title')</title>

        <!-- Bootstrap core CSS -->
        <link href="{!! asset('/theme/simple-sidebar/vendor/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="{!! asset('/theme/simple-sidebar/css/simple-sidebar.css') !!}" rel="stylesheet">
        <!-- Custom styles for Bootstrap sidebar (Avery) -->
        <link href="{!! asset('/css/simple-sidebar-mod.css') !!}" rel="stylesheet">
    </head>

    <body>

        <div id="wrapper" class="toggled">
            @include('layouts/sidebar')

            <!-- Page Content -->
            <div id="page-content-wrapper">
                <div class="container-fluid">
                    @yield('content')
                    <!-- <a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle">Toggle Menu</a>-->
                </div>
            </div>
            <!-- /#page-content-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- Bootstrap core JavaScript -->
        <script src="{!! asset('/theme/simple-sidebar/vendor/jquery/jquery.min.js') !!}"></script>
        <script src="{!! asset('/theme/simple-sidebar/vendor/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>

        <!-- Menu Toggle Script -->
        <!-- <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
        </script>-->
    </body>
</html>
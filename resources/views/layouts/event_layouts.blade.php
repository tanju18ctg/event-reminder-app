<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="{{asset('event-assets')}}/css/styles.css" rel="stylesheet" />

    </head>
    <body class="sb-nav-fixed">
    @stack('modals')
    @stack('scripts')
    <!-- Include Nav Header file -->
      @include('partials.nav-header');

        <div id="layoutSidenav">
            <!-- include sidenav file -->
            @include('partials/side-nav')
               <div id="layoutSidenav_content">
               
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Event Reminder Apps</h1>
                        @yield('events')
                      
                    </div>
                </main>
                <!-- include Partial File -->
                @include('partials/footer')
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{asset('event-assets')}}/js/scripts.js"></script>
        <script src="{{asset('event-assets')}}/font-awesome/fontawesome.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="{{asset('event-assets')}}/assets/demo/chart-area-demo.js"></script>
        <script src="{{asset('event-assets')}}/assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="{{asset('event-assets')}}/js/datatables-simple-demo.js"></script>
       
    </body>
</html>

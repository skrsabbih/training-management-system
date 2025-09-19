<!doctype html>
<html lang="en">

<head>

    @include('backend/section.link')

    <title>TMS - Admin Dashboard</title>
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">
        // Sidebar
        @include('backend/section.sidebar')
        // Header
        @include('backend/section.header')
        <!--start page wrapper -->
        <div class="page-wrapper">
            @yield('section')
        </div>
        <!--end page wrapper -->
        <!--start overlay-->
        @include('backend/section.footer')
    </div>
    <!--end wrapper-->
    @include('backend/section.script')
</body>

</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title') | {{ config('settings.site.app.appname') }}</title>
  <!-- Include core + vendor Styles  -->
    @include('admin.include.styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ asset('admin/dist/img/nk-admin.png') }}" alt="AdminLTELogo" height="60" width="60">
  </div>
    <x:notify-messages />
     @include('admin.include.header') 
     @include('admin.include.sidebar') 
     <!-- Content Wrapper. Contains page content -->
     <div class="content-wrapper">
     
        @include('admin.include.breadcrumb') 

           @yield('content')       <!--Include Startkit Content-->

     </div>
    <!-- /.content-wrapper -->  
    @include('admin.include.footer')

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark"></aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- include default scripts -->
@include('admin.include.scripts')
</body>
</html>

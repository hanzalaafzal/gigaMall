<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from odindesign-themes.com/emerald-dragon/dashboard-settings.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 28 Dec 2018 10:30:32 GMT -->
<head>
	@include('frontEnd.client.includes.head')
</head>
<body>
	@include('frontEnd.client.includes.menu')
    <!-- DASHBOARD BODY -->
    <div class="dashboard-body">
        <!-- DASHBOARD HEADER -->
        @include('frontEnd.client.includes.header')
        <!-- DASHBOARD HEADER -->
        @include('frontEnd.client.includes.errors')

        <!-- DASHBOARD CONTENT -->
        @yield('dashboard')
        <!-- DASHBOARD CONTENT -->
    </div>
    <!-- /DASHBOARD BODY -->

	<div class="shadow-film closed"></div>
	@include('frontEnd.client.includes.foot')
</body>

<!-- Mirrored from odindesign-themes.com/emerald-dragon/dashboard-settings.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 28 Dec 2018 10:30:36 GMT -->
</html>
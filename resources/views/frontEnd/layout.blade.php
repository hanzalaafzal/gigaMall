<!DOCTYPE html>
<html lang="en">

<head>
	@include('frontEnd.includes.head')
</head>
<body>
	@include('frontEnd.includes.header')
	@include('frontEnd.includes.errors')
	@yield('content')
	@include('frontEnd.includes.footer')
	@include('frontEnd.includes.foot')
	
</body>

</html>
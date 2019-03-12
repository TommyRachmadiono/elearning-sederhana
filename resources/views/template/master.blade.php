<!doctype html>
<html lang="en">

@include('template.partials.head')

<body>
	@include('template.partials.top_nav')
	
	<div class="container">
		@yield('content')
	</div>

	@include('template.partials.footer')
</body>
</html>
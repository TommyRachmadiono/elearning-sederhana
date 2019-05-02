<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<div class="container">
		<a class="navbar-brand" href="{{ route('index_page') }}"><b>Simple e-Learning</b></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item danger">
					<a class="btn btn-warning" href="{{ route('logout') }}">Logout</a>
				</li>
			</ul>
		</div>
	</div>
</nav>
<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-nav" aria-expended="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="{{route('home.index')}}" class="navbar-brand">
					Pokemania
				</a>
			</div>
			<div class="collapse navbar-collapse" id="bs-nav">
				<ul class="nav navbar-nav">
					<li class="{{ Request::is('/') ? 'active' : null }}"><a href="{{route('home.index')}}">Home</a></li>
					<li class="{{ Request::segment(1) === 'pokedex' ? 'active' : (Request::segment(1) === 'pokemon' ? 'active' : null) }}"><a href="{{route('home.pokedex')}}">Pokedex</a></li>
					<li class="{{ Request::segment(1) === 'quiz' ? 'active' : null }}"><a href="{{route('home.quiz')}}">Quiz</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
                <li><a href="profile.html">
							<!-- Profile -->
							<i class="fas fa-user"></i>
						</a></li>

					<li><a href="wildfight.html" class="alignPerfect">
							<!-- Wild Fight -->
							<img src="{{ URL::to('images/pokeball.svg') }}" height="20" />
						</a></li>

					<li><a href="shop.html">
							<!-- Shop -->
							<i class="fas fa-shopping-cart"></i>
						</a></li>

					<li><a href="arena.html" class="alignPerfect">
							<!-- Battle Arena -->
							<img src="{{ URL::to('images/stadium.svg') }}" height="20" />
						</a></li>

					<li><a href="create.html">
							<!-- Create Tournament -->
							<i class="fas fa-plus"></i>
						</a></li>

					<li><a href="index.html">
							<!-- Sign Out -->
							<i class="fas fa-door-closed"></i>
						</a></li>
					<li><a href="signup.html">
							Signup
							<i class="fas fa-user-plus"></i>
						</a></li>
					<li><a href="login.html">
							Login
							<i class="fas fa-user"></i>
						</a></li>
				</ul>
			</div>
		</div>
    </nav>
    

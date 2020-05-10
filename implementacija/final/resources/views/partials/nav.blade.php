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
                <li><a href="{{ route('home') }}">
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
							<i class="fas fa-door-closed"></i>&nbsp;&nbsp;Logout
						</a></li>
						@guest
						<li class="nav-item">
							<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
						</li>
						@if (Route::has('register'))
							<li class="nav-item">
								<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
							</li>
						@endif
					@else
						<li class="nav-item dropdown">
							<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
								{{ Auth::user()->name }} <span class="caret"></span>
							</a>
	
							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="{{ route('logout') }}"
								   onclick="event.preventDefault();
												 document.getElementById('logout-form').submit();">
									{{ __('Logout') }}
								</a>
	
								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									@csrf
								</form>
							</div>
						</li>
					@endguest
				</ul>
			</div>
		</div>
    </nav>
    

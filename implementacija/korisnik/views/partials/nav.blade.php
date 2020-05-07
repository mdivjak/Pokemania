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
					<li class="active"><a href="{{route('home.index')}}">Home</a></li>
					<li><a href="{{route('home.pokedex')}}">Pokedex</a></li>
					<li><a href="{{route('home.quiz')}}">Quiz</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
                <li><a href="{{ route('user.show', 1) }}">
							<!-- Profile -->
							<i class="fas fa-user"></i>
						</a></li>

					<li><a href="wildfight.html" class="alignPerfect">
							<!-- Wild Fight -->
							<img src="/images/pokeball.svg" height="20" />
						</a></li>

					<li><a href="{{ route('user.shop', 1) }}">
							<!-- Shop -->
							<i class="fas fa-shopping-cart"></i>
						</a></li>

					<li><a href="{{ route('tournament.index') }}" class="alignPerfect">
							<!-- Battle Arena -->
							<img src="/images/stadium.svg" height="20" />
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
					<li><a href="{{ route('login') }}">
							Login
							<i class="fas fa-user"></i>
						</a></li>
				</ul>
			</div>
		</div>
    </nav>
    

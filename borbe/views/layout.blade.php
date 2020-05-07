
<!DOCTYPE html>
<html>

<head>
	<title>Pokemania - Wild battle</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-2.1.4.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="css-Borbe/styles.css">
  <link rel="stylesheet" href="css-Borbe/wildBattle.css">
	<link rel="icon" href="images-Borbe/pokeball.ico">

</head>

<body>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-nav" aria-expended="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a href="admin.html" class="navbar-brand">
          Pokemania
        </a>
      </div>
      <div class="collapse navbar-collapse" id="bs-nav">
        <ul class="nav navbar-nav">
          <li><a href="index.html">Home</a></li>
          <li><a href="pokedex.html">Pokedex</a></li>
          <li><a href="quiz.html">Quiz</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">

          <li><a href="profile.html">
              <!-- Profile -->
              <i class="fas fa-user"></i>
            </a></li>

          <li class="active"><a href="wildfight.html">
              <!-- Wild Fight -->
              <img src="images-Borbe/pokeball.svg" height="20" />
            </a></li>

          <li><a href="shop.html">
              <!-- Shop -->
              <i class="fas fa-shopping-cart"></i>
            </a></li>

          <li><a href="arena.html">
              <!-- Battle Arena -->
              <img src="images-Borbe/stadium.svg" height="20" />
            </a></li>

          <li><a href="index.html">
              <!-- Sign Out -->
              <i class="fas fa-door-closed"></i>
            </a></li>
        </ul>
      </div>
    </div>
  </nav>
  <br><br><br><br>

  @yield('content')

</body>
</html>

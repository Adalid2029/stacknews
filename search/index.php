<?php
require_once("../conn.php");
//$type = $_GET['search'];
$search = 'select * from content_vid where title like \'%' . $_GET['query'] . '%\' order by hire_date desc';
$statement = $pdo->prepare($search);
$statement->execute(array());
$statement = $statement->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<title>Search...</title>
	<meta charset="utf-8">
	<meta property="og:title" content="Stack News">
	<meta property="og:image" content="https://cdn3.iconfinder.com/data/icons/web-design-and-development-glyph-vol-1/64/web-development-glyph-04-512.png">
	<meta property="og:site_name" content="https://platzi.xyz/">
	<meta name="description" content="Videotutoriales, Películas, Series">
	<meta property="og:description" content="Videotutoriales, Películas, Series">
	<meta property="og:url" content="https://platzi.xyz">
	<meta property="og:type" content="article">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


	<!--<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">-->
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="icon" type="image/png" href="new.png" />
	<!--<script async src="https://epnt.ebay.com/static/epn-smart-tools.js"></script>-->
	<!--Publicidad de Adf.ly
	<script type="text/javascript"> 
	    var adfly_id = 17289315; 
	    var adfly_advert = 'int'; 
	    var frequency_cap = 5; 
	    var frequency_delay = 5; 
	    var init_delay = 3; 
	    var popunder = true; 
	</script>-
	<script src="https://cdn.adf.ly/js/entry.js"></script> -->
</head>

<body onselectstart="return false;" ondragstart="return false;">
	<header>

		<!--Navbar-->
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<a class="navbar-brand" href="#">StackNews</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<!--Dropdown _vid-->
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Video Tutoriales
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="../index.php?cat=todo">Todo</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="../index.php?cat=prog">Programación</a>
							<a class="dropdown-item" href="../index.php?cat=db">Base de Datos</a>
							<a class="dropdown-item" href="../index.php?cat=disWeb">Diseño Web</a>
							<a class="dropdown-item" href="../index.php?cat=red">Redes</a>
						</div>
					</li>
					<!--Dropdown _pel-->
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Peliculas
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="../movies/index.php?cat=todo">Todo</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="../movies/index.php?cat=acc">Acción</a>
							<a class="dropdown-item" href="../movies/index.php?cat=ter">Terror</a>
							<a class="dropdown-item" href="../movies/index.php?cat=sus">Suspenso</a>
							<a class="dropdown-item" href="../movies/index.php?cat=com">Comedia</a>
						</div>
					</li>


					<li class="nav-item">
						<a class="nav-link" href="../series/">Series</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="https://www.paypal.me/stacknw">Donar</a>
					</li>
					<li class="nav-item">
						<a class="nav-link disabled" href="#">Contribuir</a>
					</li>
				</ul>
				<form class="form-inline my-2 my-lg-0">
					<input class="form-control mr-sm-2" value="<?= trim($_GET['query']) ?>" type="search" name="query" placeholder="Search" aria-label="Search">
					<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
				</form>
			</div>
		</nav>
		<!--/.Navbar-->
	</header>
	<!--jumbotron-->
	<!--<section class="jumbotron" onclick="location.href = 'http://zipansion.com/A9MD'">-->
	<section class="jumbotron">
		<div class="container">
			<div class="row">
				<div class="col-md-9 col-sm-12">
					<div class="jumbotron jumbotron-fluid">
						<div class="container">
							<h1 class="display-4">StackNews</h1>
							<p class="lead">Video Tutoriales <i>(<?= $_GET['query'] ?>)</i></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="main container">
		<div class="row">
			<aside class="col-md-2 hidden-xs hidden-sm">

				<!-- Start of adf.ly banner code -->
				<center>
					<br>
					<h3>Gana dinero por 1000 visitas 5$</h3>
					<a href="https://join-adf.ly/17289315"><img border="0" src="https://cdn.adf.ly/images/banners/adfly.125x125.3.gif" width="125" height="125" title="AdF.ly - acorta links y gana dinero!" /></a>
				</center>

			</aside>
			<section class="posts col-md-6">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Inicio</a></li>
						<li class="breadcrumb-item active" aria-current="page"><?= $_GET['query'] ?></li>
					</ol>
				</nav>
				<?php foreach ($statement as $key => $value) : ?>
					<article class="post clearfix">
						<a href="../description/index.php?id=<?= $value['id'] ?>&type=_vid" target="_blank" class="thumb pull-left">
							<img src="../imagenes/<?= $value['image'] ?>" alt="" class="img-thumbnail">
						</a>
						<h2 class="post-title">
							<a href="../description/index.php?id=<?= $value['id'] ?>&type=_vid" target="_blank"><?= $value['title'] ?></a>
						</h2>
						<p>
							<span class="post-fecha"><?= $value['hire_date'] ?></span> por <span class="post-autor"><a href="#">StackNews</a></span>
						</p>
						<p class="post-contenido text-justify" onclick="location.href = 'http://zipansion.com/A9MD'"><?= substr($value['description'], 0, 200) . '...'; ?></p>
						<div class="contenedor-botones">
							<a style="width: 100%" href="../description/index.php?id=<?= $value['id'] ?>&type=_vid" class="btn btn-primary">Descargar, Leer mas</a>
						</div>
					</article>
				<?php endforeach ?>
			</section>
		</div>
	</section>

	<footer>

	</footer>
	<script type="text/javascript" src="js/delRigth.js"></script>
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<!--<script type="text/javascript" src="../js/bootstrap.js"></script>-->
</body>

</html>
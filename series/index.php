<?php
require_once("../conn.php");
$sql="select id,title,description,hire_date,image from content_ser order by rand();";
$statement = $pdo->prepare($sql);
$statement->execute(array());
$statement = $statement->fetchAll();
require_once("../conn.php");
$sqlRecent="select id,title,description,hire_date from content_ser order by id desc limit 4";
$rec = $pdo->prepare($sqlRecent);
$rec->execute(array());
$rec = $rec->fetchAll();
$allSer = selectAllSeries($pdo);
function selectAllSeries($pdo){
		$sql = "select id, title from content_ser order by title";
		$rs = $pdo->prepare($sql);
		$rs->execute(array());
		$rs = $rs->fetchAll();
		return $rs;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Series</title>
	<meta charset="utf-8">
	<meta property="og:title" content="Stack News">
    <meta property="og:image" content="https://cdn3.iconfinder.com/data/icons/web-design-and-development-glyph-vol-1/64/web-development-glyph-04-512.png">
    <meta property="og:site_name" content="platzi.xyz">
    <meta name="description" content="Videotutoriales, Películas, Series">
    <meta property="og:description" content="Videotutoriales, Películas, Series">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body onselectstart="return false;" ondragstart="return false;">
	<header>
		<nav class="navbar navbar-inverse navbar-static-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
	        			<span class="sr-only">Desplegar / Ocultar</span>
	        			<span class="icon-bar"></span>
	        			<span class="icon-bar"></span>
	        			<span class="icon-bar"></span>
	      			</button>
	      		<a href="#" class="navbar-brand">StackNews</a>
				</div>
				<!--Inicia Menu-->
				<div class="collapse navbar-collapse" id="myNavbar">
					<ul class="nav navbar-nav">
						<li class="dropdown">
							<a class="dropdown-toogle" data-toggle="dropdown" href="" role="button">
								Video Tutoriales <span class="caret"></span>
							</a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="../index.php?cat=todo">Todo</a></li>
								<li class="divider"></li>
								<li><a href="../index.php?cat=prog">Programación</a></li>
								<li><a href="../index.php?cat=db">Base de datos</a></li>
								<li><a href="../index.php?cat=disWeb">Diseño Web</a></li>
								<li><a href="../index.php?cat=red">Redes</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a  class="dropdown-toogle" data-toggle="dropdown" href="" role="button">
								Peliculas <span class="caret"></span>
							</a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="../movies/index.php?cat=todo">Todo</a></li>
								<li class="divider"></li>
								<li><a href="../movies/index.php?cat=acc">Acción</a></li>
								<li><a href="../movies/index.php?cat=ter">Terror</a></li>
								<li><a href="../movies/index.php?cat=sus">Suspenso</a></li>
								<li><a href="../movies/index.php?cat=com">Comedia</a></li>
							</ul>
						</li>
						<li class=" active"><a href="#">Series</a></li>
						<li><a href="https://www.paypal.me/stacknw">Donar</a></li>
						<li><a href="#" onclick="alert('not developed for series')">Contribuir</a></li>
					</ul>
				</div>
			</div>
		</nav>
	</header>
	<!--jumbotron-->
	<section class="jumbotron" onclick="location.href = 'http://zipansion.com/A9MD'">
		<div class="container">
			<h1 class="titulo-blog">StackNews</h1>
			<p class="text-cat-jumb">Series <i>(Todo)</i></p>
		</div>
	</section>
	<section class="main container">
		<div class="row">
			<aside class="col-md-3 hidden-xs hidden-sm">
				<h4>Recién Agregados</h4>
				<?php foreach ($rec as $key => $value): ?>
				<a href="description.php?id=<?=$value['id']?>&type=_ser" class="list-group-item">
					<h4 class="list-group-item-heading"><?=$value['title']?></h4>
					<p class="list-group-item-text text-justify"><?=substr($value['description'],0,100).'...'?></p>
				</a>	
				<?php endforeach ?>
				<h4>Listado de Series</h4>
				<?php foreach ($allSer as $key => $value): ?>
				<a href="description.php?id=<?=$value['id']?>&type=_ser" class="list-group-item">
					<h5 class="list-group-item-heading"><?=$value['title']?></h5>
				</a>	
				<?php endforeach ?>
				<!--Publicidad-->
				<a href="https://join-adf.ly/17289315"><img border="0" src="https://cdn.adf.ly/images/banners/adfly.160x600.4.gif" width="160" height="600" title="AdF.ly - acorta links y gana dinero!" /></a>
				<!--Fin Publicidad-->
			</aside>
			<section class="posts col-md-9">
				<div class="miga-de-pan">
					<ol class="breadcrumb">
						<li><a href="#">Inicio</a></li>
						<li class="active">Todo</li>
					</ol>
				</div>
				<?php foreach ($statement as $key => $value): ?>
				<article class="post clearfix">
					<a href="https://icutit.ca/KNhUSOPrKF" target="_blank" class="thumb pull-left">
						<img src="../imagenes/<?=$value['image']?>" alt="" class="img-thumbnail">
					</a>
					<h2 class="post-title">
						<a href="description.php?id=<?=$value['id']?>&type=_ser"><?=$value['title']?></a>
					</h2>
					<p>
						<span class="post-fecha"><?=$value['hire_date']?></span> por <span class="post-autor"><a href="#">StackNews</a></span>
					</p>
					<p class="post-contenido text-justify" onclick="location.href = 'https://icutit.ca/KNhUSOPrKF'"><?=$value['description']?></p>
					<div class="contenedor-botones">
						<a href="description.php?id=<?=$value['id']?>&type=_ser" class="btn btn-primary">Descargar, Leer mas</a>
						<a href="description.php?id=<?=$value['id']?>&type=_ser" class="btn btn-success">Enviar comentario <span class="badge">1</span></a>
					</div>
				</article>
				<?php endforeach?>
			</section>

		</div>
	</section>

	<footer>
		<div class="container">
			<div class="row">
				<div class="col-xs-6">
					<p>StackNews</p>
				</div>
				<div class="col-xs-6">
					<ul class="list-inline text-right">
						<li><a href="../">VideoTutoriales</a></li>
						<li><a href="../movies">Peliculas</a></li>
						<li><a href="#">Series</a></li>
					</ul>
				</div>
			</div>
		</div>
	</footer>
	<script type="text/javascript" src="../js/delRigth.js"></script>
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
</body>
</html>
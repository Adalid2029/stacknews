<?php
require_once("conn.php");
//cantidad de registros por página
$pageView = 10;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
//la pagina inicia en 0 y se multimplica  $por_pagina
$start = ($page - 1) * $pageView;
$totalPages = view5Pages($pdo, $pageView);
$sql = "";
$dat = "";
if (isset($_GET['cat'])) {
	switch ($_GET['cat']) {
		case "todo":
			$dat = "Todo";
			$sql = "select id,title,description,hire_date,image from content_vid order by id desc LIMIT $start, $pageView;";
			break;
		case "prog":
			$dat = "Programación";
			$sql = "select id,title,description,hire_date,image from content_vid where category='Progr' order by id desc LIMIT $start, $pageView;";
			break;
		case "db":
			$dat = "Base de datos";
			$sql = "select id,title,description,hire_date,image from content_vid where category='DataB' order by id desc LIMIT $start, $pageView;";
			break;
		case "disWeb":
			$dat = "Diseño Web";
			$sql = "select id,title,description,hire_date,image from content_vid where category='DiWeb' order by id desc LIMIT $start, $pageView;";
			break;
		case "red":
			$dat = "Redes";
			$sql = "select id,title,description,hire_date,image from content_vid where category='Redes' order by id desc LIMIT $start, $pageView;";
			break;
		default:
			$dat = "Todo";
			$sql = "select id,title,description,hire_date,image from content_vid order by id desc LIMIT $start, $pageView;";
			break;
	}
} else {
	$dat = "Todo";
	//$sql = "select id,title,description,hire_date,image from content_vid order by id desc LIMIT $start, $pageView;";
	$sql = "select id,title,description,hire_date,image from content_vid order by rand() LIMIT $start, $pageView;";
}
$statement = $pdo->prepare($sql);
$statement->execute(array());
$statement = $statement->fetchAll();

$sqlRecent = "select id,title,description,hire_date,image from content_vid order by id desc limit 4";
$rec = $pdo->prepare($sqlRecent);
$rec->execute(array());
$rec = $rec->fetchAll();

function view5Pages($pdo, $pageView)
{
	if (isset($_GET['cat'])) {
		switch ($_GET['cat']) {
			case "todo":
				$query = "SELECT * FROM content_vid;";
				break;
			case "prog":
				$query = "SELECT * FROM content_vid where category='Progr';";
				break;
			case "db":
				$query = "SELECT * FROM content_vid where category='DataB';";
				break;
			case "disWeb":
				$query = "SELECT * FROM content_vid where category='DiWeb';";
				break;
			case "red":
				$query = "SELECT * FROM content_vid where category='Redes';";
				break;

			default:
				$query = "SELECT * FROM content_vid;";
				break;
		}
	} else {
		$query = "SELECT * FROM content_vid;";
	}

	//seleccionar toda la tabla de content_vid
	$count = $pdo->prepare($query);
	$count->execute();
	$count = $count->fetchAll();

	//contar el total de registros
	$totalRecords = count($count);


	//usando ceil para dividir el total de registros entre $por_pagina
	$totalPages = ceil($totalRecords / $pageView);
	return $totalPages;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<title>Stack News</title>
	<meta charset="utf-8">
	<meta property="og:title" content="Stack News">
	<meta property="og:image" content="https://cdn3.iconfinder.com/data/icons/web-design-and-development-glyph-vol-1/64/web-development-glyph-04-512.png">
	<meta property="og:site_name" content="https://platzi.xyz/">
	<meta name="description" content="Videotutoriales, Películas, Series">
	<meta property="og:description" content="Videotutoriales, Películas, Series">
	<meta property="og:url" content="https://platzi.xyz/">
	<meta property="og:type" content="article">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<!--<link rel="stylesheet" type="text/css" href="css/bootstrap.css">-->
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="https://cdn.materialdesignicons.com/5.0.45/css/materialdesignicons.min.css">
	<link rel="icon" type="image/png" href="https://cdn3.iconfinder.com/data/icons/web-design-and-development-glyph-vol-1/64/web-development-glyph-04-512.png" />
</head>
<!--<body onselectstart="return false;" ondragstart="return false;">-->

<body>
	<div id="fb-root"></div>
	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v6.0&appId=219073752766608&autoLogAppEvents=1"></script>
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
							<a class="dropdown-item" href="index.php?cat=todo">Todo</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="index.php?cat=prog">Programación</a>
							<a class="dropdown-item" href="index.php?cat=db">Base de Datos</a>
							<a class="dropdown-item" href="index.php?cat=disWeb">Diseño Web</a>
							<a class="dropdown-item" href="index.php?cat=red">Redes</a>
						</div>
					</li>
					<!--Dropdown _pel-->
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Peliculas
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="movies/index.php?cat=todo">Todo</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="movies/index.php?cat=acc">Acción</a>
							<a class="dropdown-item" href="movies/index.php?cat=ter">Terror</a>
							<a class="dropdown-item" href="movies/index.php?cat=sus">Suspenso</a>
							<a class="dropdown-item" href="movies/index.php?cat=com">Comedia</a>
						</div>
					</li>


					<li class="nav-item">
						<a class="nav-link" href="series/">Series</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="https://www.paypal.me/stacknw">Donar</a>
					</li>
					<li class="nav-item">
						<a class="nav-link disabled" href="#">Contribuir</a>
					</li>
				</ul>
				<form class="form-inline my-2 my-lg-0" action="search/index.php">
					<input class="form-control mr-sm-2" type="search" name="query" placeholder="Buscar..." aria-label="Buscar...">
					<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Ir</button>
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
				<div class="col-md-3 col-sm-12">
					<div class="jumbotron jumbotron-fluid">
						<div class="container">
							<h1 class="display-4">StackNews</h1>
							<p class="lead">Video Tutoriales <i>(<?= $dat ?>)</i></p>
						</div>
					</div>
				</div>
				<!--Plugin de comentarios de Facebook-->
				<div class="col-md-3">
					<div class="fb-group" data-href="https://www.facebook.com/groups/stacknews" data-width="200" data-show-social-context="true" data-show-metadata="false"></div>
				</div>
				<div class="col-md-3">
					<a href="https://mega.nz/aff=QAfTVe3If9Y" target="_blank"><img src="imagenes/mega.webp" alt="..." class="img-thumbnail"></a>
					<p class="text-center">Obtén 50GB Gratis..!</p>
				</div>
				<div class="col-md-3">
					<a href="/series/description.php?id=8&type=_ser" target="_blank"><img src="imagenes/casa_papel_4.1.jpg" alt="..." class="img-thumbnail"></a>
				</div>
			</div>
		</div>
	</section>

	<section class="container-fluid">
		<div class="row">
			<aside class="col-md-3">
				<h4>Categorias</h4>
				<?php
				if (isset($_GET['cat'])) {
					switch ($_GET['cat']) {
						case "todo":
				?>
							<div class="lis-group">
								<a href="index.php?cat=todo" class="list-group-item active"><i class="account-box"></i> Todo</a>
								<a href="index.php?cat=prog" class="list-group-item">Programación</a>
								<a href="index.php?cat=db" class="list-group-item">Base de datos</a>
								<a href="index.php?cat=disWeb" class="list-group-item">Diseño Web</a>
								<a href="index.php?cat=red" class="list-group-item">Redes</a>
							</div>
						<?php
							break;
						case "prog":
						?>
							<div class="lis-group">
								<a href="index.php?cat=todo" class="list-group-item">Todo</a>
								<a href="index.php?cat=prog" class="list-group-item active">Programación</a>
								<a href="index.php?cat=db" class="list-group-item">Base de datos</a>
								<a href="index.php?cat=disWeb" class="list-group-item">Diseño Web</a>
								<a href="index.php?cat=red" class="list-group-item">Redes</a>
							</div>
						<?php
							break;
						case "db":
						?>
							<div class="lis-group">
								<a href="index.php?cat=todo" class="list-group-item">Todo</a>
								<a href="index.php?cat=prog" class="list-group-item">Programación</a>
								<a href="index.php?cat=db" class="list-group-item active">Base de datos</a>
								<a href="index.php?cat=disWeb" class="list-group-item">Diseño Web</a>
								<a href="index.php?cat=red" class="list-group-item">Redes</a>
							</div>
						<?php
							break;
						case "disWeb":
						?>
							<div class="lis-group">
								<a href="index.php?cat=todo" class="list-group-item">Todo</a>
								<a href="index.php?cat=prog" class="list-group-item">Programación</a>
								<a href="index.php?cat=db" class="list-group-item">Base de datos</a>
								<a href="index.php?cat=disWeb" class="list-group-item active">Diseño Web</a>
								<a href="index.php?cat=red" class="list-group-item">Redes</a>
							</div>
						<?php
							break;
						case "red":
						?>
							<div class="lis-group">
								<a href="index.php?cat=todo" class="list-group-item">Todo</a>
								<a href="index.php?cat=prog" class="list-group-item">Programación</a>
								<a href="index.php?cat=db" class="list-group-item">Base de datos</a>
								<a href="index.php?cat=disWeb" class="list-group-item">Diseño Web</a>
								<a href="index.php?cat=red" class="list-group-item active">Redes</a>
							</div>
					<?php
							break;
					}
				} else {
					?>
					<div class="lis-group">
						<a href="index.php?cat=todo" class="list-group-item active">Todo</a>
						<a href="index.php?cat=prog" class="list-group-item">Programación</a>
						<a href="index.php?cat=db" class="list-group-item">Base de datos</a>
						<a href="index.php?cat=disWeb" class="list-group-item">Diseño Web</a>
						<a href="index.php?cat=red" class="list-group-item">Redes</a>
					</div>
				<?php
				}
				?>

				<h4>Recién Agregados</h4>
				<?php foreach ($rec as $key => $value) : ?>
					<div class="row">
						<div class="col-md-12">
							<a href="description/index.php?id=<?= $value['id'] ?>&type=_vid" class="list-group-item">
								<h4 class="list-group-item-heading"><?= $value['title'] ?></h4>
								<p class="list-group-item-text text-justify"><?= substr($value['description'], 0, 90) . '...' ?></p>

								<div class="col-md-12">
									<img class="img-thumbnail" src="imagenes/<?= $value['image'] ?>" alt="<?= $value['title'] ?>">
								</div>
							</a>

						</div>
					</div>
				<?php endforeach ?>
				<div class="fb-page" data-href="https://www.facebook.com/desarolladoresweb/" data-tabs="timeline" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
					<blockquote cite="https://www.facebook.com/desarolladoresweb/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/desarolladoresweb/">Programadores</a></blockquote>
				</div>
				<!-- Start of adf.ly banner code -->
				<center>
					<br>
					<h3>Gana dinero por 1000 visitas 5$</h3>
					<a href="https://join-adf.ly/17289315"><img src="https://cdn.adf.ly/images/banners/adfly.125x125.3.gif" width="125" height="125" title="AdF.ly - acorta links y gana dinero!" /></a>
				</center>
				<!-- End of adf.ly banner code -->

				<!-- Start of epn.ebay.es banner code
				<center>
					<ins class="epn-placement" data-config-id="5ccc29121c71ad42fe921293"></ins>
				</center>
				 End of epn.ebay.es banner code -->

			</aside>
			<section class="posts col-md-6">
				<!-- <div class="row">
					<div class="col-sm-6 col-xs-12">
						<table width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;">
							<tr>
								<td height="28" style="line-height:28px;">&nbsp;</td>
							</tr>
							<tr>
								<td style="">
									<table border="0" width="280" cellspacing="0" cellpadding="0" style="border-collapse:separate;background-color:#ffffff;border:1px solid #dddfe2;border-radius:3px;font-family:Helvetica, Arial, sans-serif;margin:0px auto;">

										<tr>
											<td style="font-size:14px;font-weight:bold;padding:8px 8px 0px 8px;text-align:center;">Programadores</td>
										</tr>
										<tr>
											<td style="color:#90949c;font-size:12px;font-weight:normal;text-align:center;">Grupo de Facebook · 9402 miembros</td>
										</tr>
										<tr>
											<td style="padding:8px 12px 12px 12px;">
												<table border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse;width:100%;">
													<tr>
														<td style="background-color:#4267b2;border-radius:3px;text-align:center;"><a style="color:#3b5998;text-decoration:none;cursor:pointer;width:100%;" href="https://www.facebook.com/plugins/group/join/popup/?group_id=617981228580882&amp;source=email_campaign_plugin" target="_blank" rel="noopener">

																<table border="0" cellspacing="0" cellpadding="3" align="center" style="border-collapse:collapse;">
																	<tr>
																		<td style="border-bottom:3px solid #4267b2;border-top:3px solid #4267b2;"><img width="16" src="https://facebook.com/images/groups/plugin/email/app_fb_32_fig_white.png" /></td>
																		<td style="border-bottom:3px solid #4267b2;border-top:3px solid #4267b2;color:#FFF;font-family:Helvetica, Arial, sans-serif;font-size:12px;font-weight:bold;">Unirte al grupo</td>
																	</tr>
																</table>
															</a></td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td class="text-center">Buenas este grupo tiene el fin de compartir ideas, vídeos, pdf todo relacionado a programación, desarrollo web, redes, seguridad informática. Y puede...</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</div>
					<div class="col-sm-6 col-xs-12">
						<table width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;">
							<tr>
								<td height="28" style="line-height:28px;">&nbsp;</td>
							</tr>
							<tr>
								<td style="">
									<table border="0" width="280" cellspacing="0" cellpadding="0" style="border-collapse:separate;background-color:#ffffff;border:1px solid #dddfe2;border-radius:3px;font-family:Helvetica, Arial, sans-serif;margin:0px auto;">

										<tr>
											<td style="font-size:14px;font-weight:bold;padding:8px 8px 0px 8px;text-align:center;">Pagina de Programadores</td>
										</tr>
										<tr>
											<td style="color:#90949c;font-size:12px;font-weight:normal;text-align:center;">Pagina de Facebook · 333 seguidores</td>
										</tr>
										<tr>
											<td style="padding:8px 12px 12px 12px;">
												<table border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse;width:100%;">
													<tr>
														<td style="background-color:#4267b2;border-radius:3px;text-align:center;"><a style="color:#3b5998;text-decoration:none;cursor:pointer;width:100%;" href="https://www.facebook.com/desarolladoresweb/" target="_blank" rel="noopener">
																<table border="0" cellspacing="0" cellpadding="3" align="center" style="border-collapse:collapse;">
																	<tr>
																		<td style="border-bottom:3px solid #4267b2;border-top:3px solid #4267b2;"><img width="16" src="https://facebook.com/images/groups/plugin/email/app_fb_32_fig_white.png" /></td>
																		<td style="border-bottom:3px solid #4267b2;border-top:3px solid #4267b2;color:#FFF;font-family:Helvetica, Arial, sans-serif;font-size:12px;font-weight:bold;">Seguir la pagina</td>
																	</tr>
																</table>
															</a></td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td class="text-center">Tomar la decisión de cuidarse es cerebral. No vale correr siete millas al día y llegar a la nevera y comer lo que te da la gana. Valentín Fuster, uno de los cardiólogos más prestigiosos del mundo: El corazón sirve para dar cantidad de vida; el cerebro, para dar calidad de vida</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr style="">
								<td height="14" style="line-height:14px;">&nbsp;</td>
							</tr>
						</table>
					</div>
				</div> -->

				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Inicio</a></li>
						<li class="breadcrumb-item active" aria-current="page"><?= $dat ?></li>
					</ol>
				</nav>
				<?php foreach ($statement as $key => $value) : ?>
					<article class="post clearfix">
						<a href="description/index.php?id=<?= $value['id'] ?>&type=_vid" target="_blank" class="thumb pull-left">
							<img src="imagenes/<?= $value['image'] ?>" alt="" class="img-thumbnail">
						</a>
						<h2 class="post-title">
							<a href="description/index.php?id=<?= $value['id'] ?>&type=_vid" target="_blank"><?= $value['title'] ?></a>
						</h2>
						<p>
							<span class="post-fecha"><?= $value['hire_date'] ?></span> por <span class="post-autor"><a href="#">StackNews</a></span>
						</p>
						<p class="post-contenido text-justify" onclick="location.href = 'http://zipansion.com/A9MD'"><?= substr($value['description'], 0, 190) . '...'; ?></p>
						<div class="contenedor-botones">
							<a href="description/index.php?id=<?= $value['id'] ?>&type=_vid" class="btn btn-primary" style="width: 100%">Descargar, Leer mas</a>
						</div>
					</article>
				<?php endforeach ?>
				<?php switch ($dat) {
					case 'Todo':
				?>
						<nav aria-label="...">
							<ul class="pagination">
								<li class="page-item">
									<a class="page-link" href="index.php?cat=todo&page=1" tabindex="-1">Inicio</a>
								</li>
								<?php
								for ($i = 1; $i <= $totalPages; $i++) {
									if ($page == $i) {
								?>
										<li class="page-item active">
											<a class="page-link" href="index.php?cat=todo&page=<?= $i ?>"><?= $i ?> <span class="sr-only">(current)</span></a>
										</li>
									<?php
									} else {
									?>
										<li class="page-item">
											<a class="page-link" href="index.php?cat=todo&page=<?= $i ?>"><?= $i ?> <span class="sr-only">(current)</span></a>
										</li>
								<?php
									}
								} ?>
								<li class="page-item">
									<a class="page-link" href="index.php?cat=todo&page=<?= $totalPages ?>">Final</a>
								</li>
							</ul>
						</nav>
					<?php
						break;
					case 'Programación':
					?>
						<nav aria-label="...">
							<ul class="pagination">
								<li class="page-item">
									<a class="page-link" href="index.php?cat=prog&page=1" tabindex="-1">Inicio</a>
								</li>
								<?php
								for ($i = 1; $i <= $totalPages; $i++) {
									if ($page == $i) {
								?>
										<li class="page-item active">
											<a class="page-link" href="index.php?cat=prog&page=<?= $i ?>"><?= $i ?> <span class="sr-only">(current)</span></a>
										</li>
									<?php
									} else {
									?>
										<li class="page-item">
											<a class="page-link" href="index.php?cat=prog&page=<?= $i ?>"><?= $i ?> <span class="sr-only">(current)</span></a>
										</li>
								<?php
									}
								} ?>
								<li class="page-item">
									<a class="page-link" href="index.php?cat=prog&page=<?= $totalPages ?>">Final</a>
								</li>
							</ul>
						</nav>
					<?php
						break;
					case 'Base':
					?>
						<nav aria-label="...">
							<ul class="pagination">
								<li class="page-item">
									<a class="page-link" href="index.php?cat=db&page=1" tabindex="-1">Inicio</a>
								</li>
								<?php
								for ($i = 1; $i <= $totalPages; $i++) {
									if ($page == $i) {
								?>
										<li class="page-item active">
											<a class="page-link" href="index.php?cat=db&page=<?= $i ?>"><?= $i ?> <span class="sr-only">(current)</span></a>
										</li>
									<?php
									} else {
									?>
										<li class="page-item">
											<a class="page-link" href="index.php?cat=db&page=<?= $i ?>"><?= $i ?> <span class="sr-only">(current)</span></a>
										</li>
								<?php
									}
								} ?>
								<li class="page-item">
									<a class="page-link" href="index.php?cat=db&page=<?= $totalPages ?>">Final</a>
								</li>
							</ul>
						</nav>
					<?php
						break;
					case 'Diseño':
					?>
						<nav aria-label="...">
							<ul class="pagination">
								<li class="page-item">
									<a class="page-link" href="index.php?cat=disWeb&page=1" tabindex="-1">Inicio</a>
								</li>
								<?php
								for ($i = 1; $i <= $totalPages; $i++) {
									if ($page == $i) {
								?>
										<li class="page-item active">
											<a class="page-link" href="index.php?cat=disWeb&page=<?= $i ?>"><?= $i ?> <span class="sr-only">(current)</span></a>
										</li>
									<?php
									} else {
									?>
										<li class="page-item">
											<a class="page-link" href="index.php?cat=disWeb&page=<?= $i ?>"><?= $i ?> <span class="sr-only">(current)</span></a>
										</li>
								<?php
									}
								} ?>
								<li class="page-item">
									<a class="page-link" href="index.php?cat=disWeb&page=<?= $totalPages ?>">Final</a>
								</li>
							</ul>
						</nav>
					<?php
						break;
					case 'Redes':
					?>
						<nav aria-label="...">
							<ul class="pagination">
								<li class="page-item">
									<a class="page-link" href="index.php?cat=red&page=1" tabindex="-1">Inicio</a>
								</li>
								<?php
								for ($i = 1; $i <= $totalPages; $i++) {
									if ($page == $i) {
								?>
										<li class="page-item active">
											<a class="page-link" href="index.php?cat=red&page=<?= $i ?>"><?= $i ?> <span class="sr-only">(current)</span></a>
										</li>
									<?php
									} else {
									?>
										<li class="page-item">
											<a class="page-link" href="index.php?cat=red&page=<?= $i ?>"><?= $i ?> <span class="sr-only">(current)</span></a>
										</li>
								<?php
									}
								} ?>
								<li class="page-item">
									<a class="page-link" href="index.php?cat=red&page=<?= $totalPages ?>">Final</a>
								</li>
							</ul>
						</nav>
				<?php
						break;
				} ?>
			</section>
			<div class="col-md-3 hidden-xs">
				<h4>Top 10</h4>
				<?php foreach ($rec as $key => $value) : ?>
					<a href="./description/index.php?id=<?= $value['id'] ?>&type=_vid" class="list-group-item">
						<h4 class="list-group-item-heading"><?= $value['title'] ?></h4>
						<p class="list-group-item-text text-justify"><?= substr($value['description'], 0, 90) . '...' ?></p>
					</a>
				<?php endforeach ?>
				<!-- Start of epn.ebay.es banner cod
				<center>
					<ins class="epn-placement" data-config-id="5ccc2a54a0c76c2ddfd4a59e"></ins>
				</center>
				End of epn.ebay.es banner code -->
			</div>
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
						<li><a href="#">VideoTutoriales</a></li>
						<li><a href="movies/">Peliculas</a></li>
						<li><a href="series/">Series</a></li>
					</ul>
				</div>
			</div>
		</div>
	</footer>
	<div id="fb-root"></div>
	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v4.0&appId=1807417096249710&autoLogAppEvents=1"></script>
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

	<!--<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>-->
</body>

</html>
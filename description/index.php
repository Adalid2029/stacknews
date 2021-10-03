<?php
require_once("../conn.php");

switch (isset($_GET['id']) && isset($_GET['type'])) {
	case 1:
		$rs = selectElementById($_GET['id'], $_GET['type'], $pdo);
		$rec = selectRecents($_GET['id'], $_GET['type'], $pdo);
		$link = selectAllLinks($_GET['id'], $pdo, $_GET['type']);
		if (isset($_POST['id']) and isset($_POST['type']) and isset($_POST['email']) and isset($_POST['comentario']))
			insertComentary($type, $id, $email, $comentario, $pdo);
		break;
	case 0:
		header("Location: err.html");
		break;
	default:
		header("Location: err.html");
		break;
}

function selectRecents($id, $type, $pdo)
{
	$sql = "select id,title,description,hire_date from content" . $type . " order by id desc limit 4";
	$rec = $pdo->prepare($sql);
	$rec->execute(array($id));
	$rec = $rec->fetchAll();
	return $rec;
}
function selectElementById($id, $type, $pdo)
{
	$sql = "select * from content" . $type . " where id = ? ";
	$rec = $pdo->prepare($sql);
	$rec->execute(array($id));
	$rec = $rec->fetchAll();
	if (isset($rec[0]))
		$rec = $rec[0];
	else
		header("Location: err.html");

	return $rec;
}
function selectAllLinks($id, $pdo, $type)
{
	$sql = "select * from links" . $type . " where id_content =" . $id;
	$sta = $pdo->prepare($sql);
	$sta->execute(array());
	$sta = $sta->fetchAll();
	return $sta;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<title><?= $rs['title'] ?></title>
	<meta charset="utf-8">
	<meta property="og:title" content="Stack News">
	<meta property="og:image" content="https://platzi.xyz/imagenes/<?= $rs['image'] ?>">
	<meta name="description" content="Videotutoriales, Películas, Series">
	<meta property="og:description" content="<?= $rs['title'] ?>">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="icon" type="image/png" href="../imagenes/<?= $rs['image'] ?>" />
	<meta property="fb:app_id" content="1807417096249710" />

</head>
<!--onselectstart="return false;" ondragstart="return false;"-->

<body>
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
						<?php
						switch ($_GET['type']) {
							case '':
						?>
								<li class="dropdown active">
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
									<a class="dropdown-toogle" data-toggle="dropdown" href="" role="button">
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
								<li class=""><a href="../series/">Series</a></li>
								<li><a href="https://www.paypal.me/stacknw">Donar</a></li>
								<li><a href="#" onclick="alert('not developed for series')">Contribuir</a></li>
							<?php
								break;
							case '_pel':
							?>
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

								<li class="dropdown active">
									<a class="dropdown-toogle" data-toggle="dropdown" href="" role="button">
										Peliculas <span class="caret"></span>
									</a>
									<ul class="dropdown-menu" role="menu">
										<li><a href="../movies/index.php?cat=todo">Todo</a></li>
										<li class="divider"></li>
										<li><a href="../movies/index.php?cat=acc">Acción</a></li>
										<li><a href="../movies/index.php?cat=ter">Terror</a></li>
										<li><a href="../movies/index.php?cat=sus">Suspenso</a></li>
										<li><a href="../movies/index.php?cat=com">Comedia</a></li>
										<li><a href="https://www.paypal.me/stacknw">Donar</a></li>
										<li><a href="#" onclick="alert('not developed for series')">Contribuir</a></ </ul>
										</li>
										<li class=""><a href="../series/">Series</a></li>
									<?php
									break;
								case '_ser':
									?>
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
											<a class="dropdown-toogle" data-toggle="dropdown" href="" role="button">
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
										<li class="active"><a href="../series/">Series</a></li>
										<li><a href="https://www.paypal.me/stacknw">Valore mi esfuerzo</a></li>
									<?php
									break;

								default:
									?>
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
											<a class="dropdown-toogle" data-toggle="dropdown" href="" role="button">
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
										<li class=""><a href="../series/">Series</a></li>
										<li><a href="https://www.paypal.me/stacknw">Donar</a></li>
										<li><a href="#" onclick="alert('not developed for series')">Contribuir</a></li>
								<?php
									break;
							}
								?>
									</ul>
				</div>
			</div>
		</nav>
	</header>
	<!--jumbotron-->
	<section class="jumbotron">
		<div class="row">
			<div class="col-md-9 col-sm-12">
				<h1 class="titulo-blog">StackNews</h1>
				<p class="text-cat-jumb">Descripción <i>(<?= $rs['title'] ?>)</i></p>
			</div>
		</div>
	</section>

	<section class="container-fluid">
		<div class="row">
			<div class="col-md-2">
				<a href="https://mega.nz/aff=QAfTVe3If9Y" target="_blank"><img src="../imagenes/1200px-01_mega_logo.png" alt="..." class="img-thumbnail"></a>
				<p class="text-center">Obtén 50GB Gratis..!</p>
			</div>

			<section class="posts col-md-7">
				<article class="post clearfix">
					<h2 class="post-title">
						<a href="http://zipansion.com/A9MD" target="_blank"><?= $rs['title'] ?></a>
					</h2>
					<a href="http://zipansion.com/A9MD" target="_blank" class="thumb text-center">
						<img src="../imagenes/<?= $rs['image'] ?>" alt="" class="img-thumbnail">
					</a>

					<div class="row">
						<center>
							<div style="padding: 3px" class="col-md-3">
								<span><?= $rs['hire_date'] ?></span> por <span class="post-autor">
									<a href="#">StackNews</a>
								</span>
							</div>
							<div style="padding: 3px" class="col-md-3">
								<div class="fb-share-button" data-href="https://platzi.xyz/description/index.php?id=<?= $_GET['id'] ?>&type=<?= $_GET['type'] ?>" data-layout="box_count" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https://platzi.xyz/description/index.php?id=<?= $_GET['id'] ?>&type=<?= $_GET['type'] ?>&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Compartir</a></div>
							</div>
							<div style="padding: 3px" class="col-md-3">
								<div class="fb-save" data-uri="https://platzi.xyz/description/index.php?id=<?= $_GET['id'] ?>&type=<?= $_GET['type'] ?>" data-size="large"></div>
							</div>
							<div style="padding: 3px" class="col-md-3">
								<a href="https://api.whatsapp.com/send?text=Pensamos que podría interesarte este curso *<?= $rs['title'] ?>* https://platzi.xyz/description/index.php?id%3d<?= $_GET['id'] ?>%26type%3d<?= $_GET['type'] ?>" target="_blank" data-action="share/whatsapp/share" class="btn btn-success">Compartir<img style="width:20px;height:20px" src="https://web.whatsapp.com/img/favicon/1x/favicon.png"></a>
								<!--<a href="https://api.whatsapp.com/send?text=Pensamos que podría interesarte este curso <?= $rs['title'] ?> http://<?= $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] ?>?id%3d<?= $_GET['id'] ?>%26type%3d<?= $_GET['type'] ?>" target="_blank" data-action="share/whatsapp/share" class="btn btn-success">Compartir<img style="width:20px;height:20px" src="https://web.whatsapp.com/img/favicon/1x/favicon.png"></a>-->
							</div>
						</center>
					</div>

					<p class="post-contenido text-justify" onclick="location.href = 'http://zipansion.com/A9MD'"><?= $rs['description'] ?></p>
					<p>
					<div class="row">
						<div class="col-sm-9 col-xs-12">
							<p><i>Si el enlace no sirve o hay algún otro problema Envienos un mensaje privado</i></p>
						</div>
						<div class="col-sm-3 col-xs-12">
							<a href="" style="width:100%" class="btn btn-success" data-toggle="modal" data-target="#myModal">Enviar SMS privado <span class="badge">1</span></a>
						</div>
					</div>
					</p>
					<div id="myModal" class="modal fade" role="dialog">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-body  rel_body">
									<button type="button" class="close rel_clos" data-dismiss="modal">&times;</button>
									<div class="panel panel-success">
										<div class="panel-heading rel_success">
											<label>Enviar comentario</label>
										</div>
										<div class="panel-body">
											<form class="form-horizontal" role="form" action="../contact/index.php" method="post">
												<div class="form-group">
													<label class="control-label col-sm-3" for="email">Correo electrónico</label>
													<div class="col-sm-9">
														<input type="hidden" name="id" value="<?= $rs['id'] ?>">
														<input type="hidden" name="type" value="<?= $_GET['type'] ?>">
														<input type="email" class="form-control" name="email" required="" placeholder="Enviaremos un correo electrónico">
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-sm-3" for="pwd">Comentario:</label>
													<div class="col-sm-9">
														<input type="text" class="form-control" name="comentario" required="">
													</div>
												</div>
												<div class="form-group">
													<div class="col-sm-offset-8 col-sm-2">
														<button type="submit" class="btn btn-success col-xs-12">Enviar</button>
													</div>
													<div class="col-sm-2">
														<button type="button" class="btn btn-default col-xs-12" data-dismiss="modal">Exit</button>
													</div>
												</div>
											</form>

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</article>
				<!--Plugin de comentarios de Facebook-->
				<center>
					<div class="fb-comments" data-href="https://platzi.xyz/description/index.php?id=<?= $_GET['id'] ?>&type=<?= $_GET['type'] ?>" data-width="" data-numposts="5"></div>
				</center>
			</section>
			<div class="main container col-md-3">
				<aside class="col-md-12">
					<div class="fb-group" data-href="https://www.facebook.com/groups/stacknews" data-width="250" data-show-social-context="true" data-show-metadata="false"></div>
					<br>
					<div class="lis-group">
						<a style="width: 100%" class="btn btn-success" data-toggle="modal" data-target="#myVideo">Como descargar?</a>
						<div id="myVideo" class="modal fade" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-body  rel_body">
										<button type="button" class="close rel_clos" data-dismiss="modal">&times;</button>
										<div class="panel panel-success">
											<div class="panel-heading rel_success">
												<label></label>
											</div>
											<div class="panel-body">
												<div class="row">
													<div class="col-sm-12 col-xs-12">
														<iframe width="100%" height="460" src="https://www.youtube.com/embed/sk9WMtQnTBY?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="lis-group">
						<h5 class="list-group-item active">Contraseña</h5>
						<a href="" class="list-group-item"><?= $rs['password'] ?></a>
					</div>
					<div class="lis-group">
						<h5 class="list-group-item active">Links de Descarga</h5>
						<?php foreach ($link as $key => $value) : ?>
							<a href="<?= $value['link'] ?>" target="_blank" class="list-group-item"><?= $value['link'] ?></a>
						<?php endforeach ?>
					</div>
					<div class="hidden-xs hidden-sm">
						<h4>Recién Agregados</h4>
						<?php foreach ($rec as $key => $value) : ?>
							<a href="../description/index.php?id=<?= $value['id'] ?>&type=<?= $_GET['type'] ?>" class="list-group-item">
								<h4 class="list-group-item-heading"><?= $value['title'] ?></h4>
								<p class="list-group-item-text text-justify"><?= substr($value['description'], 0, 100) . '...' ?></p>
							</a>
						<?php endforeach ?>
					</div>
					<!-- Start of adf.ly banner code -->
					<center>
						<br>
						<h3>Gana dinero por 10000 visitas 5$</h3>
						<a href="https://join-adf.ly/17289315"><img border="0" src="https://cdn.adf.ly/images/banners/adfly.300x250.1.gif" width="300" height="250" title="AdF.ly - acorta links y gana dinero!" /></a>
					</center>
					<!-- End of adf.ly banner code -->
					<br>
				</aside>
			</div>
		</div>
	</section>
	<div id="fb-root"></div>
	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v4.0&appId=1807417096249710&autoLogAppEvents=1"></script>
	<script type="text/javascript" src="../js/delRigth.js"></script>
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
</body>

</html>
<?php
require_once("../conn.php");
switch (isset($_GET['id']) && isset($_GET['type'])) {
	case 1:
		$rs=selectElementById($_GET['id'],$_GET['type'],$pdo);
		$rec=selectRecents($_GET['id'],$_GET['type'],$pdo);
		if (isset($_POST['id'])and isset($_POST['type'])and isset($_POST['email'])and isset($_POST['comentario'])) {
			insertComentary($type, $id, $email, $comentario, $pdo);
		}
		$content = returnStringContent($rs['content']);
		break;
	case 0:
		header("Location: ../description/err.html");
		break;
	default:
		header("Location: ../description/err.html");
		break;
}
function returnStringContent($str){
		$str = $str."\n";
		$strString="";
		$dat=str_split($str);
		for($i=0;$i<count($dat)-3;$i++) {
			if ($dat[$i]=== "\n" and $dat[$i+1].$dat[$i+2].$dat[$i+3].$dat[$i+4]=="http") {
				$i=$i+1;
				$strString=$strString."\n<a target=\"_blank\" href=\"";
				$seq="";
				while ($dat[$i]<>"\n") {
					$seq=$seq.$dat[$i];
					$strString=$strString.$dat[$i];
					$i++;
				}
				$strString=$strString."\">".$seq."</a>\n";
			}
			elseif ($dat[$i]==="\n") {
				$strString = $strString."\n";	
			}
			$strString = $strString.$dat[$i];
		}	
		return $strString;
	}
function selectRecents($id,$type,$pdo){
	$sql="select id,title,description,hire_date from content".$type." order by id desc limit 6";
	$rec = $pdo->prepare($sql);
	$rec->execute(array($id));
	$rec = $rec->fetchAll();
	return $rec;
}
function selectElementById($id,$type,$pdo){
	$sql="select * from content".$type." where id = ? ";
	$rec = $pdo->prepare($sql);
	$rec->execute(array($id));
	$rec = $rec->fetchAll();
	if (isset($rec[0]))
		$rec = $rec[0];
	else
		header("Location: ../description/err.html");
	
	return $rec;	
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title><?=$rs['title']?></title>
	<meta charset="utf-8">
	<meta property="og:title" content="Stack News">
    <meta property="og:image" content="https://cdn3.iconfinder.com/data/icons/web-design-and-development-glyph-vol-1/64/web-development-glyph-04-512.png">
    <meta property="og:site_name" content="stacknews.000webhost.com">
    <meta name="description" content="Videotutoriales, Películas, Series">
    <meta property="og:description" content="Videotutoriales, Películas, Series">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="icon" type="img/png" href="../imagenes/<?=$rs['image']?>">

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
							<li class=""><a href="../series/">Series</a></li>
							<li><a href="https://www.paypal.me/stacknw">Donar</a></li>
							<li><a href="#" onclick="alert('not developed for series')">Contribuir</a></
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
							<li class=""><a href="../series/">Series</a></li>
							<li><a href="https://www.paypal.me/stacknw">Donar</a></li>
							<li><a href="#" onclick="alert('not developed for series')">Contribuir</a></li>
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
							<li class=""><a href="../series/">Series</a></li>
							<li><a href="https://www.paypal.me/stacknw">Valore mi esfuerzo</a></li>
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
	<section class="jumbotron" class="jumbotron" onclick="location.href = 'https://icutit.ca/KNhUSOPrKF'">
		<div class="container">
			<h1 class="titulo-blog">StackNews</h1>
			<p class="text-cat-jumb">Descripción <i>(<?=$rs['title']?>)</i></p>
		</div>
	</section>

	<section class="main container">
		<div class="row">
			<aside class="col-md-3 hidden-xs hidden-sm">
				<h4>Recién Agregados</h4>
				<?php foreach ($rec as $key => $value): ?>
				<a href="description.php?id=<?=$value['id']?>&type=<?=$_GET['type']?>" class="list-group-item">
					<h4 class="list-group-item-heading"><?=$value['title']?></h4>
					<p class="list-group-item-text text-justify"><?=substr($value['description'],0,100).'...'?></p>
				</a>	
				<?php endforeach ?>
			</aside>
			<section class="posts col-md-5">
				<article class="post clearfix">
					<h2 class="post-title">
						<a href="https://icutit.ca/KNhUSOPrKF" target="_blank"><?=$rs['title']?></a>
					</h2>
					<a href="https://icutit.ca/KNhUSOPrKF" target="_blank" class="thumb">
						<img src="../imagenes/<?=$rs['image']?>" alt="" class="img-thumbnail">
					</a>
					
					<p>
						<span class="post-fecha"><?=$rs['hire_date']?></span> por <span class="post-autor">
							<a href="#">StackNews</a>
						</span>
					</p>
					<p class="post-contenido text-justify" onclick="location.href = 'https://icutit.ca/KNhUSOPrKF'"><?=$rs['description']?></p>
					<div class="form-group">
						<div class="col-sm-offset-8 col-sm-4">
							<a href="" class="btn btn-success" data-toggle="modal" data-target="#myModal">Enviar comentario <span class="badge">1</span></a>	
						</div>
						
					</div>
					<!-- Start of adf.ly banner code -->
					<div style="width: 468px; text-align: center; font-family: verdana; font-size: 10px;"><a href="https://join-adf.ly/17289315"><img border="0" src="https://cdn.adf.ly/images/banners/adfly.468x60.5.gif" width="468" height="60" title="AdF.ly - acorta links y gana dinero!" /></a><br /><a href="https://join-adf.ly/17289315">Gana dinero por compartir tus enlaces!</a></div>
<!-- End of adf.ly banner code -->
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
													<label class="control-label col-sm-3" for="email">Correo electronico</label>
													<div class="col-sm-9">
														<input type="hidden" name="id" value="<?=$rs['id']?>">
														<input type="hidden" name="type" value="<?=$_GET['type']?>">
														<input type="email" class="form-control" name="email" required="" placeholder="">
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
			</section>
			<div class="main container">
				<div class="row">
					<aside class="col-md-4">
						<div class="">
							<h4>Links de Descarga</h4>
							<pre><?=$content?></pre>
						</div>
					</aside>
				</div>						
			</div>	
		</div>
	</section>
	<script type="text/javascript" src="../js/delRigth.js"></script>
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
</body>
</div>
</html>
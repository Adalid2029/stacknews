<?php
//En esta oportunidad veremos como extraer datos de una pagina con la clase 'simple_html_dom.php'
//Clase de Scraping
require_once('../libraries/simple_html_dom.php');

//Mi conexion a la base de datos
require_once('../conn.php');
getPage($pdo);
function getPage($pdo){
	//Declaramos los diferentes urls de las paginas que vamos a extraer contenido
	$array =  array('https://cursosmegaup.bid/', 'https://cursosmegaup.bid/page/2/','https://cursosmegaup.bid/page/3/','https://cursosmegaup.bid/page/4/','https://cursosmegaup.bid/page/5/','https://cursosmegaup.bid/page/6/','https://cursosmegaup.bid/page/7/','https://cursosmegaup.bid/page/8/','https://cursosmegaup.bid/page/9/','https://cursosmegaup.bid/page/10/','https://cursosmegaup.bid/page/11/','https://cursosmegaup.bid/page/12/','https://cursosmegaup.bid/page/13/','https://cursosmegaup.bid/page/14/','https://cursosmegaup.bid/page/15/','https://cursosmegaup.bid/page/16/','https://cursosmegaup.bid/page/17/','https://cursosmegaup.bid/page/18/','https://cursosmegaup.bid/page/19/','https://cursosmegaup.bid/page/20/','https://cursosmegaup.bid/page/21/','https://cursosmegaup.bid/page/22/','https://cursosmegaup.bid/page/23/','https://cursosmegaup.bid/page/24/','https://cursosmegaup.bid/page/25/','https://cursosmegaup.bid/page/26/','https://cursosmegaup.bid/page/27/','https://cursosmegaup.bid/page/28/');

	//Random generado de los anteriores url(s)
	$yourPageRand = $array[rand(0,27)];

	//Scraping a  la pagina hallada en el Random 
	$html = file_get_html($yourPageRand);

	//Buscando todos los posts
	$dat = $html->find('article[class=has-post-thumbnail]');

	//Hallando un Rand de todos los Posts encontrados
	$randPost = rand(0,sizeof($dat));

	//Bucando la clase 'has-post-thumbnail' uno en especifico con el Rand hallado
	$dat = $html->find('article[class=has-post-thumbnail]',$randPost-1);

	//Hallando el url del cual vamos a extrer todos los datos
	$link = $dat->find('h3 a',0);

	//Extraendo especificamente el attibuto la etiqueta <a>
	$url = $link->attr['href'];

	//Pagina final encontrada
	$html = file_get_html($url);
	$title=$html->find('div[class=mh-wrapper] h1',0)->innertext;
	$img=$html->find('div[class=mh-wrapper] img',0)->attr['src'];
	$size=$html->find('div[class=mh-wrapper] p[class=tbs]',1)->innertext;
	//$language=$html->find('div[class=mh-wrapper] p[class=tbs]',3);
	//$duration=$html->find('div[class=mh-wrapper] p[class=tbs]',5);
	//$instructor=$html->find('div[class=mh-wrapper] p[class=tbs]',7);
	$description=$html->find('div[class=mh-wrapper] div[class=desc] p',0)->innertext;
	$download=$html->find('div[class=mh-wrapper] a[class=links]',1)->attr['href'];
	
	//Contando los registros Repetidos columna like 'title'
	$stm = $pdo->prepare("select count(*) from content_vid where title like '$title';");
	$stm->execute();
	//Encargad de ver si se encontraron columnas
	if ($stm->fetchColumn() > 0) {
		//Refresca la pagina si existe elementos repetidos
		header("refresh:1;url=".$_SERVER['PHP_SELF']);
	}else{
		$imagen = file_get_contents($img);
		file_put_contents('../imagenes/tmp/'.md5($title).'.png', $imagen);
		?>
		<form action="../51c231fc1185f233036fd7b82c135656/" method="post" >
			<input name='title' type='text' value='<?=htmlspecialchars_decode(trim($title))?>'/>
			<input name='size' type='text' value='<?=trim($size)?>'/>
			<input name='description' type='text' value='<?=htmlspecialchars_decode(trim($description))?>'/>
			<input style="color: blue" type="submit" value="Submit" onclick="" name="go">
		</form>
		<a href="<?=$download?>" target="_blank"><?=$download?></a>
		<img src="../imagenes/tmp/<?=md5($title)?>.png">
	<?php		
	}
	echo "Hola";
}


function rmDir_rf($carpeta){
	foreach(glob($carpeta . "/*") as $archivos_carpeta){             
        if (is_dir($archivos_carpeta)){
          rmDir_rf($archivos_carpeta);
        } else {
        unlink($archivos_carpeta);
        }
      }
      rmdir($carpeta);
     }
	

	
	

	//Agregando a  nuestra base de datos
	//$sql = "insert into scraping values(NULL, '$title->innertext', '$img', '$size->innertext', '$language->innertext', '$duration->innertext', '$instructor->innertext', '$description->innertext', '$url', '$download');";
	//$stm = $pdo->prepare($sql);
	//$stm->execute(array());

	//Ya tendriamos los datos en nuestra base de datos de manera dinamica sin mucho esfuerzo 
	//La pagina de donde extraje todos sus datos es https://cursosmegaup.bid/
?>
<script type="text/javascript">
	function update(){
		location.reload();
	}
</script>

<style type="text/css">
	input{
		width: 100%;
	}
	a{
		font-size: 20px;
	}
</style>


<?php
require_once("../conn.php");
if (isset($_POST['id']) and isset($_POST['title']) and isset($_POST['description']) and isset($_POST['type']) and isset($_POST['category']) and isset($_POST['password']) and isset($_POST['size']) and isset($_POST['url']) and  isset($_POST['imagen'])) {
		if(basename($_FILES['imagen']['name'])<>''){
			//if (file_exists('../imagenes/'.$_POST['chgimage']))
		//	unlink('../imagenes/'.$_POST['chgimage']);
		$nmPhoto=submitPhoto("../imagenes/");
		$sql ="update content".$_POST['type']." set title = '".$_POST['title']."', description='".$_POST['description']."', type='".$_POST['type']."', category = '".$_POST['category']."', password = '".$_POST['password']."', size='".$_POST['size']."', all_links='".$_POST['url']."',image='$nmPhoto' where id=".$_POST['id'];
		$h=$pdo->prepare($sql);
		$h->execute(array());	
	}else{
			$sql ="update content".$_POST['type']." set title = '".$_POST['title']."', description='".$_POST['description']."', type='".$_POST['type']."', category = '".$_POST['category']."', password = '".$_POST['password']."', size='".$_POST['size']."', all_links='".$_POST['url']."' where id=".$_POST['id'];
		$h=$pdo->prepare($sql);
		$h->execute(array());
	}
	$del="delete from links".$_POST['type']." where id_content=".$_POST['id'];
	$h=$pdo->prepare($del);
	$h->execute(array());
	foreach (convertToArrayBy($_POST['url']) as $key => $value) {
			$query="insert into links_vid(id_content, link) values(".$_POST['id'].", '$value')";
		$h=$pdo->prepare($query);
		$h->execute(array());
	}
	header('Location: ../coments');
}
else{
		echo "Error al actualizar los datos";
}
function convertToArrayBy($string){
			$string=trim($string);
		$len = strlen($string);
		$fin = 0;	
		$indexArr = 0;
		$arr[] = array();
		for ($j=0; $j <$len; $j++) { 
				$fin=0;
			for ($i=0; $i < strlen($string); $i++) { 
					if(substr($string, $i,1)==','){
						$arr[$indexArr++] = trim(substr($string, 0,$fin));
					$string = substr($string, ($fin+1));
					break;
				}else{
						$fin++;
				}
			}
		}
		$arr[$indexArr] = trim($string);
		return $arr;
	}
function submitPhoto($path){
		$nmType=basename($_FILES['imagen']['type']);
	if($nmType=="jpeg" or $nmType=="gif"or $nmType=="png"){
		switch (basename($_FILES['imagen']['type'])) {
			case 'jpeg':
			$nmFile = md5(basename($_FILES['imagen']['name'])).'.jpg';
			break;
		case 'png':
			$nmFile = md5(basename($_FILES['imagen']['name'])).'.png';
			break;
		case 'gif':
			$nmFile = md5(basename($_FILES['imagen']['name'])).'.gif';
			break;
		default:
			break;
		}
		if(move_uploaded_file($_FILES['imagen']['tmp_name'], $path.$nmFile)) {
				echo "<script>alert('La imagén se subio exitosamente')</script>";
			return $nmFile;
		}else{
				echo "<script>alert('Error al subir la imagén')</script>";
		}
	}
	else{
			echo "<script>alert('Tipo de archivo no admitida')</script>";	
	}
}

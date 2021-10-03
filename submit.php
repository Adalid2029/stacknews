<?php
	require_once('conn.php');
	$d=returnStateID($_POST['type'],$pdo);
	$hoy = returnDate();
	$titulo = $_POST['title'];
	$descripcion = $_POST['description'];
	$categoria = $_POST['category'];
	$contrasena = $_POST['password'];
	$peso = $_POST['size'].' '.$_POST['sizeDat'];
	$string=$_POST['url'];
	
	$nmPhoto=submitPhoto("imagenes/");
	if ($nmPhoto<>'') {
		$sql = "insert into content_vid(id,title,description,category,id_comentary,id_link,password,size,image,hire_date,all_links)values($d,'$titulo','$descripcion','$categoria',$d,$d,'$contrasena','$peso','$nmPhoto','$hoy','$string');";
		echo $sql;
		$statement = $pdo->prepare($sql);
		if ($statement == false) {
			print_r($statement->errorInfo());
			die ('Erreur prepare');
		}
		if ($statement->execute(array()) == false) {
			print_r($statement->errorInfo());
	 		die ('Erreur execute');
		}

		
		foreach (convertToArrayBy($string) as $key => $value) {
			$sql ="INSERT INTO links_vid(id_content, link) values($d,'$value')";
			$statement = $pdo->prepare($sql);
			$statement->execute(array());
			echo $sql;
		}
		header('Location: ./51c231fc1185f233036fd7b82c135656/');

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
					$arr[$indexArr++] = substr($string, 0,$fin);
					$string = substr($string, ($fin+1));
					break;
				}else{
					$fin++;
				}
			}
		}
		$arr[$indexArr] = $string;
		return $arr;
	}
	function submitPhoto($path){
			$nmType=basename($_FILES['imagen']['type']);
			if($nmType=="jpeg" or $nmType=="gif"or $nmType=="png"){
				switch (basename($_FILES['imagen']['type'])) {
				case 'jpeg':
					$nmFile = md5(basename($_FILES['imagen']['tmp_name'])).'.jpg';
					break;
				case 'png':
					$nmFile = md5(basename($_FILES['imagen']['tmp_name'])).'.png';
					break;
				case 'gif':
					$nmFile = md5(basename($_FILES['imagen']['tmp_name'])).'.gif';
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
	function returnDate(){
		$hoy = getdate();
		$hoy = $hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday'];
		return $hoy;
	}
	function returnStateID($type,$pdo){
		$sql = 'select id from content'.$type;
		$statement = $pdo->prepare($sql);
		$statement->execute(array());
		$result = $statement->fetchAll();
		foreach ($result as $rs) {
			$d = $rs['id'];
		} 
		$d=$d+1;
		return $d;
	}
		
?>
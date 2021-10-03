<?php
	require_once('conn.php');
	$d=returnStateID($_POST['type'],$pdo);
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
	$titulo = $_POST['title'];
	$descripcion = $_POST['description'];
	$categoria = $_POST['category'];
	$contrasena = $_POST['password'];
	$peso = $_POST['size'].' '.$_POST['sizeDat'];
	$imagen = basename($_FILES['imagen']['name']);
	$string=$_POST['url'];
	$hoy = returnDate();
	

	$sql = "insert into content_pel(id,title,description,category,id_comentary,id_link,password,size,image,hire_date,all_links)
	values($d,'$titulo','$descripcion','$categoria',$d,$d,'$contrasena','$peso','$imagen','$hoy','$string');";
	$statement = $pdo->prepare($sql);
	$statement->execute(array());
	/*Desde aqui viene insercion de Urls*/
	
	$string=trim($string);
	$len = strlen($string);
	$result = substr($string, 0,1);
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
	foreach ($arr as $key) {
		$sql ="INSERT INTO links_pel(id_links, link) values($d,'$key')";
		$statement = $pdo->prepare($sql);
		$statement->execute(array());
	}
	

	$target_path = "imagenes/";
	$target_path = $target_path . basename( $_FILES['imagen']['name']); 
	if(move_uploaded_file($_FILES['imagen']['tmp_name'], $target_path)) {
	} else{
	}
	header('Location: ./51c231fc1185f233036fd7b82c135656/pel.html');

	function returnDate(){
		$hoy = getdate();
		$hoy = $hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday'];
		return $hoy;
	}
?>
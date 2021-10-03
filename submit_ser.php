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
	$content = $_POST['content'];
	$imagen = basename($_FILES['imagen']['name']);
	$hoy = returnDate();
	

	$sql = "insert into content_ser(title,description,content,image,hire_date,id_comentary)
	values('$titulo','$descripcion','$content','$imagen','$hoy',$d);";
	
	$statement = $pdo->prepare($sql);
	$statement->execute(array());		

	$target_path = "imagenes/";
	$target_path = $target_path . basename( $_FILES['imagen']['name']); 
	if(move_uploaded_file($_FILES['imagen']['tmp_name'], $target_path)) {
	} else{
	}
	header('Location: ./51c231fc1185f233036fd7b82c135656/ser.html');
	function returnDate(){
		$hoy = getdate();
		$hoy = $hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday'];
		return $hoy;
	}	
?>
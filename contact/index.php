<?php
require_once('../conn.php');

if (isset($_POST['id'])and isset($_POST['type'])and isset($_POST['email'])and isset($_POST['comentario'])) {
			$date=returnDate();
			insertComentary($_POST['type'],$_POST['id'], $_POST['email'], $_POST['comentario'], $pdo,$date);
			if ($_POST['type']=='_ser') {
				header ('Location: ../series/description.php?id='.$_POST['id'].'&type='.$_POST['type']);	
			}else{
				header ('Location: ../description/index.php?id='.$_POST['id'].'&type='.$_POST['type']);
			}
}else{
	header('Location: ../description/err.html');
}

function insertComentary($type, $id, $email, $comentario,$pdo,$date){
	$sql="insert into comentary (id_comentary,email,coments,type,hire_date)values($id,'$email','$comentario','$type', '$date')";
	$rec = $pdo->prepare($sql);
	$rec->execute(array());
}

function returnDate(){
		$hoy = getdate();
		$hoy = $hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday'];
		return $hoy;
}

?>
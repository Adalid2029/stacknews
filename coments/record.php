<?php
require_once("../conn.php");

/*Con esto hacemos una consulta a MySql*/
$s = $pdo->prepare("select * from links");
$s->execute(array());
$s=$s->fetchAll();
$dat="";
for ($i=1; $i <=count($s) ; $i++) {
	$sql= "select * from links where id_content=".$i;
	$sta = $pdo->prepare($sql);
	$sta->execute(array());
	$sta=$sta->fetchAll();

	foreach ($sta as $key => $value) {
		if($key+1<count($sta)){
			$dat=$dat.$value['link'].',';
		}else{
			$dat=$dat.$value['link'];
		}
	}
	
	$sql= "update content set all_links='$dat' where id=".$i.";";
	echo $sql;
	$sta = $pdo->prepare($sql);
	$sta->execute(array());
	$dat="";
}

$s = $pdo->prepare("select * from links_pel");
$s->execute(array());
$s=$s->fetchAll();
$dat="";
for ($i=1; $i <=count($s) ; $i++) {
	$sql= "select * from links_pel where id_content=".$i;
	$sta = $pdo->prepare($sql);
	$sta->execute(array());
	$sta=$sta->fetchAll();

	foreach ($sta as $key => $value) {
		if($key+1<count($sta)){
			$dat=$dat.$value['link'].',';
		}else{
			$dat=$dat.$value['link'];
		}
	}
	
	$sql= "update content_pel set all_links='$dat' where id=".$i.";";
	echo $sql;
	$sta = $pdo->prepare($sql);
	$sta->execute(array());
	$dat="";
}
?>
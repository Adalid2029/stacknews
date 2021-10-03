<?php
require_once("../conn.php");
$edit = new edit();
if (isset($_GET['type']) and isset($_GET['id']))
	$dat = $edit->selectedById($pdo, $_GET['id'], $_GET['type']);
else
	$dat = $edit->returnAllContent($pdo);

class edit
{
	function returnAllContent($pdo)
	{
		$sta = $pdo->prepare("select * from content_vid");
		$sta->execute(array());
		$sta = $sta->fetchAll();
		return $sta;
	}
	function selectedById($pdo, $id, $type)
	{
		$sta = $pdo->prepare("select * from content" . $type . " where id=" . $id . ";");
		$sta->execute(array());
		$sta = $sta->fetchAll();
		return $sta;
	}

	//Trae las categorias de VideoTutoriales
	function returnCategoryVid($dat, $pdo)
	{
		//Seleccionamos las categorias diferentes de $dat
		$stm = $pdo->prepare("select category from category_vid where category <> '$dat'");
		$stm->execute();
		//Creamos el string a retornarse
		$frmtdStr = "<option>$dat</option>";
		foreach ($stm->fetchAll() as $key => $value) {
			$frmtdStr = $frmtdStr . "<option>" . $value['category'] . "</option>";
		}
		return $frmtdStr;
	}
}
?>
<!DOCTYPE html>
<html>

<head>
	<title></title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../css-materialize/style.css">
	<link rel="stylesheet" type="text/css" href="../css-materialize/materialize.min.css">
</head>

<body>
	<h3 class="header" style="padding-top: 0;margin-top: 0">edited</h3>
	<div class="">
		<form action="#" method="post" enctype="multipart/form-data" id="_form">
			<?php foreach ($dat as $key => $value) : ?>
				<div class="row">
					<div class="col m9 s12">
						<ul class="collapsible expandable">
							<li>
								<div class="collapsible-header" onclick="reloadLinks(<?= $value['id_link'] ?>)">
									<div class="row">
										<div class="col m2"><a href="../description/index.php?id=<?= $value['id'] ?>&type=_vid" target="_blank"><?= $value['id'] ?></a></div>
										<div class="col m4"><?= $value['title'] ?></div>
										<div class="col m2">
											<select class="browser-default" name="category" required>
												<?= $edit->returnCategoryVid($value['category'], $pdo) ?>
											</select>
										</div>
										<div class="col m2"><?= $value['hire_date'] ?></div>
									</div>
								</div>
								<div class="collapsible-body">
									<input type="text" name="title" required="" value="<?= $value['title'] ?>">
									<div class="row">
										<div class="input-field col s12">
											<textarea name="description" class="materialize-textarea font-min"><?= $value['description'] ?></textarea>
											<label for="textarea1">description</label>
										</div>
									</div>
									<div class="col s6">
										<label for="textarea1">password</label>
										<input type="text" name="password" required="" value="<?= $value['password'] ?>">
									</div>
									<div class="col s6">
										<label>size</label>
										<input type="text" name="size" required="" value="<?= $value['size'] ?>">
									</div>
									<div class="col s12">
										<table class="striped responsive-table">
											<thead>
												<tr>
													<th>meg</th>
													<th>cut</th>
													<th>del</th>
												</tr>
											</thead>
											<tbody id="<?= $value['id'] ?>">

											</tbody>
										</table>
									</div>
									<div class="row">
										<div class="col s12">
											<div class="file-field input-field">
												<div class="btn">
													<span>File</span>
													<input type="file">
												</div>
												<div class="file-path-wrapper">
													<input class="file-path validate" type="text" name="imagen" required="" value="<?= $value['image'] ?>">
												</div>
											</div>
										</div>
										<div class="col s3">
											<div class="file-field input-field"></div>
										</div>
									</div>
								</div>
								<div id="options" class="scrollspy section"></div>
							</li>
						</ul>
					</div>
					<button class="col m3 s12 btn waves-effect waves-light" type="submit">Submit<i class="material-icons right"><?= $value['id'] ?></i></button>
				</div>
			<?php endforeach ?>
		</form>
	</div>
	<script type="text/javascript" src="../css-materialize/materialize.min.js"></script>
	<script type="text/javascript">
		function deleteItem(id) {
			$('#' + id + 'tr').html('');
		}
		//Metodo para recuperar todos los links de un id
		function reloadLinks(id) {
			$.ajax({
					url: '../show.php',
					type: 'GET',
					//dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
					data: {
						param1: 'getLinksById',
						param2: id
					},
				})
				.done(function() {
					console.log("success");
				})
				.fail(function() {
					console.log("error");
				})
				.always(function(ww) {
					$('#' + id).html(ww);
					console.log("complete");
				});
		}

		function addItem() {
			var t = '<tr><td><textarea></textarea></td><td><textarea></textarea></td><td><center><a class="btn-floating btn-small waves-effect waves-light red"><i class="material-icons">x</i></a></center></td></tr>';
			$('#1').append(t);

		}
		document.addEventListener('DOMContentLoaded', function() {
			var elems = document.querySelectorAll('.collapsible');
			var instances = M.Collapsible.init(elems, options);
		});
	</script>
	<script type="text/javascript" src="../js/jquery-1.9.1.min.js"></script>
</body>

</html>
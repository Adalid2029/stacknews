<!DOCTYPE html>
<html lang="es">

<head>
	<title></title>
	<meta charset="utf-8">
</head>

<body>
	<?php
	if (isset($_POST['go'])) {
	?>
		<h3>Upload VideoTutoriales</h3><?= md5($_POST['title']) ?><b><?= $_POST['size'] ?></b>
		<form action="../submit.php" method="post" enctype="multipart/form-data" id="_form">
			<input class="_conf" type="text" name="title" required value="<?= $_POST['title'] ?>">
			<input class="_conf" type="text" name="description" required value="<?= $_POST['description'] ?>">
			<input type="hidden" name="type" value="_vid">
			<select name="category" required="">
				<option>Progr</option>
				<option>DataB</option>
				<option>DiWeb</option>
				<option>Redes</option>
			</select>
			<br>
			<input type="text" name="url" required="" placeholder="url" class="_conf" style="width: 100%">
			<br>
			<input type="text" name="password" required="" placeholder="password">
			<input class="_conf" type="text" name="size" value="<?= $_POST['size'] ?>" required>
			<select name="sizeDat" required="">
				<option>Kb</option>
				<option>Mb</option>
				<option>Gb</option>
			</select>
			<br>
			<input class="" type="file" name="imagen" accept="image/png, .jpeg, .jpg" required>
			<input class="_conf" type="submit">
		</form>
		<hr>
	<?php
	} else {
	?>
		<h3>Upload VideoTutoriales</h3>
		<form action="../submit.php" method="post" enctype="multipart/form-data" id="_form">
			<input class="_conf" type="text" name="title" required="" placeholder="Title">
			<input class="_conf" type="text" name="description" required="" placeholder="Description">
			<input type="hidden" name="type" value="_vid">
			<select name="category" required="">
				<option>Progr</option>
				<option>DataB</option>
				<option>DiWeb</option>
				<option>Redes</option>
			</select>
			<br>
			<input type="text" name="url" required="" placeholder="url" class="_conf" style="width: 100%">
			<br>
			<input type="text" name="password" required="" placeholder="password">
			<input class="_conf" type="text" name="size" required="" placeholder="size">
			<select name="sizeDat" required="">
				<option>Kb</option>
				<option>Mb</option>
				<option>Gb</option>
			</select>
			<br>
			<input class="" type="file" name="imagen" accept="image/png, .jpeg, .jpg" required>
			<input class="_conf" type="submit">
		</form>
		<hr>
	<?php
	} ?>

</body>
<style type="text/css">
	html,
	input,
	h3 {
		padding: 0;
		margin: 0;
		margin-bottom: 10px;
	}

	._conf {
		width: 150px;
	}
</style>

</html>
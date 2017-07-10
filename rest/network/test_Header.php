<?php // Proinf.net — 2017

	require_once "Header.php";

	$lines = array(
		"Uno dos tres",
		"Cuatro:Cinco seis siete",
		"Ocho nueve: Diez once",
		"Doce :Trece :Catorce",
		"Quince : Dieciseis"
	);

	$assoc = Header::linesToAssoc($lines);
	$text = Header::assocToText($assoc);


?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Test Header</title>
</head>
<body>
	<h1>Test Header</h1>

	<h2>Lines</h2>
	<pre><?php print_r($lines) ?></pre>

	<h2>Assoc</h2>
	<pre><?php print_r($assoc) ?></pre>

	<h2>Text</h2>
	<pre><?php echo $text; ?></pre>

</body>
</html>

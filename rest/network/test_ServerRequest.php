<?php // Proinf.net — 2017

	require_once "ServerRequest.php";
	$request = new ServerRequest();
	$request->setServer('test_Server.php');

?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Test ServerRequest</title>
</head>
<body>
	<h1>Test ServerRequest</h1>
	<pre><?php print_r($request->getAll()); ?></pre>
</body>
</html>

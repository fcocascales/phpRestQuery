<?php // Proinf.net — 2017

	require_once "Data.php";

	header("Content-Type: text/plain");
	echo "Test Data";

	function output($title, $input, $output) {
		$title = "=== $title ";
		$line = str_repeat("=", 50 - strlen($title));
		$line2 = str_repeat('-', 50);
		echo "\n\n$title$line\n";
		print_r($input);
		echo "\n$line2\n";
		print_r($output);
	}

	require_once "FormatJSON.php";
	$encoded = '{ "uno":["dos", "tres"], "cuatro":"cinco" }';
	$decoded = array( 'uno'=> array("dos", "tres"),	'cuatro'=>"cinco"	);
	$data = new Data(new FormatJSON());
	$data->setText($encoded);	output("JSON decoded", $encoded, $data->getData());
	$data->setData($decoded);	output("JSON encoded", $decoded, $data->getText());

	require_once "FormatXML.php";
	$encoded = '<uno dos="tres"><cuatro>cinco</cuatro></uno>';
	$decoded = array('uno'=>"dos", 'tres'=>"cuatro");
	$data->setFormat(new FormatXML());
	$data->setText($encoded);	output("XML decoded", $encoded, $data->getData());
	$data->setData($decoded);	output("XML encoded", $decoded, $data->getText());

	require_once "FormatURL.php";
	$encoded = 'first=value&arr[]=foo+bar&arr[]=baz';
	$decoded = array('foo'=>'bar', 'bar'=>array('var'=> 'foo'));
	$data->setFormat(new FormatURL());
	$data->setText($encoded);	output("URL decoded", $encoded, $data->getData());
	$data->setData($decoded);	output("URL encoded", $decoded, $data->getText());

	require_once "FormatText.php";
	$encoded = "uno\ndos";
	$decoded = array("uno", "dos");
	$data->setFormat(new FormatText());
	$data->setText($encoded);	output("TEXT decoded", $encoded, $data->getData());
	$data->setData($decoded);	output("TEXT encoded", $decoded, $data->getText());

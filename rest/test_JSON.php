<?php // Proinf.net — 2017

	/*
		Result desired:

		{
			"id": 1,
			"codigo": "ALFKI",
			"empresa": "Alfreds Futterkiste",
			"contacto": {
				"nombre": "Maria Anders",
				"cargo": "Representante de ventas"
			},
			"telefono": "030-0074321",
			"fax": "030-0076545",
			"domicilio": {
				"direccion": "Obere Str. 57",
				"ciudad": "Berlín",
				"region": null,
				"cp": 12209,
				"pais": "Alemania"
			}
		}
	*/

	$json1 = '{
    "id": 1,
    "codigo": "ALFKI",
    "empresa": "Alfreds Futterkiste",
    "contacto_nombre": "Maria Anders",
    "contacto_cargo": "Representante de ventas",
    "telefono": "030-0074321",
    "fax": "030-0076545",
    "domicilio_direccion": "Obere Str. 57",
    "domicilio_ciudad": "Berlín",
    "domicilio_region": null,
    "domicilio_cp": 12209,
    "domicilio_pais": "Alemania",
    "fecha_envio": "2017-04-30"
  }';
	$data1 = json_decode($json1, $assoc=true);
	$data2 = folderize_underscore($data1);
	$json2 = json_encode($data2, JSON_PRETTY_PRINT);

	function folderize_underscore($data) {
		$data2 = array();
		$count = array();
		foreach($data as $key=>$value) {
			if ($pos = strpos($key, '_')) {
				$key2 = substr($key, 0, $pos);
				if (!isset($count[$key2])) $count[$key2] = 1;
				else $count[$key2]++;
			}
		}
		foreach($data as $key=>$value) {
			if ($pos = strpos($key, '_')) {
				$key2 = substr($key, 0, $pos);
				$subkey = substr($key, $pos+1);
				if ($count[$key2] > 1) {
					if (!isset($data2[$key2])) $data2[$key2] = array();
					$data2[$key2][$subkey] = $value;
					continue;
				}
			}
			$data2[$key] = $value;
		}
		return $data2;
	}

 ?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Test JSON</title>
</head>
<body>
	<h1>Test JSON</h1>
	<h2>Folderize</h2>
	<h3>Input</h3>
	<pre><?php echo $json1 ?></pre>
	<h3>Output</h3>
	<pre><?php echo $json2 ?></pre>
</body>
</html>

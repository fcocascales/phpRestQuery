<?php // Proinf.net — 2017

	require_once "RestClientJSON.php";

	class TestClient extends RestClientJSON {
		public function buildRequest(): ClientRequest {
			$this->setServer('test_RestServer.php');
			$this->setUri('/uno/dos');
			$this->setQuery(array('abc'=>123, 'def'=>456));
			$this->setMethod('POST');
			$this->setData(array(
				'uno'=> "dos",
				'tres'=> array("cuatro", "cinco")
			));
			return $this->getRequest();
		}
	}

	$client = new TestClient();
	$request = $client->buildRequest();
	$response = $client->send();

?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Test RestClient</title>
</head>
<body>
	<h1>Test RestClient</h1>
	<h2>Request</h2>
	<pre><?php print_r($request->getAll()); ?></pre>
	<pre>URL=<?php echo $request->getURL(); ?></pre>
	<h2>Response</h2>
	<pre><?php print_r($response->getAll()); ?></pre>
</body>
</html>

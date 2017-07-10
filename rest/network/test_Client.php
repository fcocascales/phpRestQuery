<?php // Proinf.net — 2017

	//----------------------------------------------
	// TEST 1
	/**/
	require_once "AbstractClient.php";

	class TestClient extends AbstractClient {
		public $request;
		public $response;

		public function buildRequest(ClientRequest $request) {
			$request->setServer('test_Server.php');
			$request->setUri('/uno/dos');
			$request->setMethod('POST');
			$request->setMime('application/xml');
			$request->setQuery(array('abc'=>123, 'def'=>456));
			$request->setContent('0123456789ABCDEFGHIJKLMNÑOPQRSTUVWXYZ');
			$this->request = $request;
		}
		public function listenResponse(ClientResponse $response) {
			$this->response = $response;
		}
	}

	$client = new TestClient();
	$request = $client->request;
	$response = $client->response;
	/**/

	//----------------------------------------------
	// TEST 2
	/*
	require_once "Client.php";

	$request = new ClientRequest();
	$request->setServer('test_Server.php');
	$request->setUri('/uno/dos');
	$request->setMime('application/xml');
	$request->setMethod('POST');
	$request->setQuery(array('abc'=>123, 'def'=>456));
	$request->setContent('0123456789ABCDEFGHIJKLMNÑOPQRSTUVWXYZ');

	$response = Client::send($request);
	*/

?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Test Client</title>
</head>
<body>
	<h1>Test Client</h1>
	<h2>Request</h2>
	<pre><?php print_r($request->getAll()); ?></pre>
	<pre>URL=<?php echo $request->getURL(); ?></pre>
	<h2>Response</h2>
	<pre><?php print_r($response->getAll()); ?></pre>
</body>
</html>

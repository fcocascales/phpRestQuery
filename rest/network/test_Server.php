<?php // Proinf.net — 2017

	//----------------------------------------------
	// TEST 1
	/**/
	require_once "AbstractServer.php";

	class TestServer extends AbstractServer {
		public function process(ServerRequest $request, ServerResponse $response) {
			$json = json_encode($request->getAll()); //, JSON_PRETTY_PRINT);
			$response->setMime("application/json");
			$response->setCode(202);
			$response->setContent($json);
		}
	}
	new TestServer();
	/**/

	//----------------------------------------------
	// TEST 2
	/*
	require_once "Server.php";

	$request = new ServerRequest();
	$response = new ServerResponse();

	$json = json_encode($request->getAll()); //, JSON_PRETTY_PRINT);
	$response->setMime("application/json");
	$response->setCode(202);
	$response->setContent($json);

	Server::send($response);
	*/

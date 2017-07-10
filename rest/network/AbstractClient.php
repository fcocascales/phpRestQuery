<?php // Proinf.net — 2017

	require_once "Client.php";

	abstract class AbstractClient extends Client {

		public function __construct() {
			$request = new ClientRequest();
			$response = new ClientResponse();
			$this->buildRequest($request);
			$response = self::send($request);
			$this->listenResponse($response);
		}

		abstract public function buildRequest(ClientRequest $request);
		abstract public function listenResponse(ClientResponse $response);

	}

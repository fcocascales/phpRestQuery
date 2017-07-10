<?php // Proinf.net — 2017

	require_once "Server.php";

	abstract class AbstractServer extends Server {

		public function __construct() {
			$request = new ServerRequest();
			$response = new ServerResponse();
			$this->process($request, $response);
			self::send($response);
		}

		abstract public function process(ServerRequest $request, ServerResponse $response);

	}

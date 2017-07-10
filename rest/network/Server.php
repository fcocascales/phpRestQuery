<?php // Proinf.net — 2017

require_once "ServerRequest.php";
require_once "ServerResponse.php";

class Server {

	public static function send(ServerResponse $response) {
		http_response_code($response->getCode());
		header('Cache-Control: no-cache, must-revalidate');
		header('Pragma: no-cache');
		header("Content-Type: ".$response->getMime());
		echo $response->getContent();
	}

}

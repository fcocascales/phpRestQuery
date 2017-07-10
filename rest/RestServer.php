<?php // Proinf.net — 2017

	require_once "network/Server.php";
	require_once "format/FormatBuilder.php";

	class RestServer {

		private $format;
		private $request;
		private $response;

		//----------------------------------------
		// 1) CONSTRUCTOR

		public function __construct() {
			$this->request = new ServerRequest();
			$this->response = new ServerResponse();
			$this->format = FormatBuilder::fromMime($this->getMime());
			$this->init_response();
		}
		private function init_response() {
			$this->response->setCode(200);
			$this->response->setMime($this->format->mime());
			$this->response->setContent("");
		}

		//----------------------------------------
		// 2) GET REQUEST

		public function getRequest():ServerRequest { return $this->request; }

		public function getUri(int $index=-1):string { return $this->request->getUri($index); }
		public function getUriHistory(int $count):string { return $this->request->getUriHistory($count); }
		public function getQuery():array { return $this->request->getQuery(); }
		public function getQueryString():string { return $this->request->getQueryString(); }
		public function getMime():string { return $this->request->getMime(); }
		public function getMethod():string { return $this->request->getMethod(); }
		public function getContent():string { return $this->request->getContent(); }
		public function getData():array {
			$encoded = $this->getContent();
			$decoded = $this->format->decode($encoded);
			return $decoded;
		}

		//----------------------------------------
		// 3) SET RESPONSE

		public function setResponse(ServerResponse $response) { $this->response = $response; }

		public function setCode(int $integer) { $this->response->setCode($integer); }
		public function setMime(string $string) {
			$this->response->setMime($string);
			$this->format = FormatBuilder::fromMime($string);
		}
		public function setContent(string $string) { $this->response->setContent($string); }
		public function setData(array $decoded) {
			$encoded = $this->format->encode($decoded);
			$this->setContent($encoded);
		}

		//----------------------------------------
		// 4) SEND RESPONSE

		public function send() { Server::send($this->response); }

		//----------------------------------------
		// HELPERS

		public static function getBase(): string {
			$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'
				|| $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
			$domain = $_SERVER['HTTP_HOST'];
			$uri = dirname($_SERVER['REQUEST_URI']);
			$file = basename($_SERVER["SCRIPT_FILENAME"]);
			return "$protocol$domain$uri/$file";
		}

	}

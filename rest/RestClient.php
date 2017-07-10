<?php // Proinf.net — 2017

	require_once "network/Client.php";
	require_once "format/FormatBuilder.php";

	class RestClient {

		private $format ;
		private $request;
		private $response;

		//----------------------------------------
		// 1) CONSTRUCTOR

		public function __construct(Format $format) {
			$this->format = $format;
			$this->request = new ClientRequest();
			$this->response = new ClientResponse();
			$this->request->setMime($format->mime());
		}

		//----------------------------------------
		// 2) BUILD REQUEST

		public function setServer(string $string) { $this->request->setServer($string); }
		public function setUri(string $string) { $this->request->setUri($string); }
		public function setQuery(array $assoc) { $this->request->setQuery($assoc); }
		public function setQueryString(string $string) { $this->request->setQueryString($string); }
		public function setMethod(string $string) { $this->request->setMethod($string); }
		public function setMime(string $string) {
			$this->request->setMime($string);
			$this->format = FormatBuilder::fromMime($string);
		}
		public function setContent(string $string) { $this->request->setContent($string); }
		public function setData(array $decoded) {
			$encoded = $this->format->encode($decoded);
			$this->setContent($encoded);
		}

		//----------------------------------------
		// 3) SEND REQUEST

		public function send(): ClientResponse {
			$this->response = Client::send($this->request);
			return $this->response;
		}

		//----------------------------------------
		// 4) GET RESPONSE

		public function getCode():string { return $this->response->getCode(); }
		public function getMime():string { return $this->response->getMime(); }
		public function getContent():string { return $this->response->getContent(); }
		public function getData():array {
			$encoded = $this->getContent();
			$decoded = $this->format->decode($encoded);
			return $decoded;
		}

		//----------------------------------------
		// HELPERS

		public function getRequest():ClientRequest { return $this->request; }
		public function getResponse():ClientResponse { return $this->response; }
		public function getFormat():Format { return $this->format; }

		public function setRequest(ClientRequest $request) { $this->request = $request; }
		public function setFormat(Format $format) { $this->format = $format; }

	}

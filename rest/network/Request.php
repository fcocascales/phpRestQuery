<?php // Proinf.net — 2017

	require_once "Constants.php";

	/*
		Parent of
			ServerRequest and
			ClientRequest
	*/
	class Request {

		//---------------------------------------------
		// ATTRIBUTES

		protected $server = ''; // string "index.php"
		protected $uri = ''; // string "/clientes/1"
		protected $query = array(); // associative array
		protected $method = ''; // string "POST"
		protected $mime = ''; // string "application/json"
		protected $content = ''; // string (raw data)
		protected $header = array(); // assoc

		//---------------------------------------------
		// GETTERS

		public function getServer():string {
			return $this->server;
		}
		public function getUri(int $index=-1):string {
			if ($index < 0) return $this->uri;
			else {
				$uri = explode('/', $this->uri);
				if ($index < count($uri)) return trim($uri[$index]);
				else return "";
			}
		}
		public function getUriHistory(int $count):string {
			//  1 : first item
			//  2 : two first items
			// -1 : all except last item
			// -2 : all except two last items
			$items = explode('/', $this->uri);
			if ($count < 0) $count = count($items) + $count;
			$count = min($count, count($items));
			return implode('/', array_slice($items, 0, $count));
		}
		public function getQuery():array {
			return $this->query;
		}
		public function getQueryString():string {
			return http_build_query($this->query);
		}
		public function getMethod():string {
			return $this->method;
		}
		public function getMime():string {
			return $this->mime;
		}
		public function getContent():string {
			return $this->content;
		}
		public function getHeader():array {
			return $this->header;
		}

		public function getAll():array {
			return array(
				'server'=> $this->getServer(),
				'uri'=> $this->getUri(),
				'query'=> $this->getQueryString(),
				'method'=> $this->getMethod(),
				'mime'=> $this->getMime(),
				'content'=> $this->getContent(),
				'header'=> $this->getHeader(),
			);
		}

		//---------------------------------------------
		// SETTERS

		public function setServer(string $string) {
			$this->server = $string;
		}
		public function setUri(string $string) {
			$this->uri = $string;
		}
		public function setQuery(array $assoc) {
			$this->query = $assoc;
		}
		public function setQueryString(string $string) {
			parse_str($string, $this->query);
		}
		public function setMethod(string $string, bool $validate=false) {
			$string = strtoupper($string);
			if (!$validate || Constants::isValidMethod($string)) {
				$this->method = $string;
			}
		}
		public function setMime(string $string, bool $validate=false) {
			if (!$validate || Constants::isValidMime($string)) {
				$this->mime = $string;
			}
		}
		public function setContent(string $string) {
			$this->content = $string;
		}
		public function setHeader(array $assoc) {
			if (is_array($assoc)) {
				$this->header = $assoc;
			}
		}

	}

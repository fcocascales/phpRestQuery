<?php // Proinf.net — 2017

	require_once "Constants.php";

	/*
		Parent of
			ServerResponse and
			ClientResponse
	*/

	class Response {

		//---------------------------------------------
		// ATTRIBUTES

		protected $code = 0; // 200, 201, 202, 404
		protected $mime = ''; // string "application/json"
		protected $content = ''; // string (raw data)
		protected $header = array(); // assoc

		//---------------------------------------------
		// GETTERS

		public function getCode():int { return $this->code; }
		public function getMime():string { return $this->mime; }
		public function getContent():string { return $this->content; }
		public function getHeader():array { return $this->header; }

		public function getAll():array {
			return array(
				'code'=> $this->getCode(),
				'mime'=> $this->getMime(),
				'content'=> $this->getContent(),
				'header'=> $this->getHeader(),
			);
		}

		//---------------------------------------------
		// SETTERS

		public function setCode(int $integer, bool $validate=false) {
			if (!$validate || Constants::isValidCode($integer)) {
				$this->code = $integer;
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

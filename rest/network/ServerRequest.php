<?php // Proinf.net — 2017

	require_once "Request.php";

	class ServerRequest extends Request {

		public function __construct() {
			$this->setUri(self::get_uri());
			$this->setQuery(self::get_query());
			$this->setMethod(self::get_method());
			$this->setMime(self::get_mime());
			$this->setContent(self::get_content());
			$this->setHeader(self::get_header());
		}

		/*
			http://domain/index.php/xxx/yyy/zzz --> "xxx/yyy/zzz"
			http://domain/index.php/xxx/yyy/zzz?param1=123 --> "xxx/yyy/zzz"
			http://domain/index.php?param1=123 --> ""
		*/
		protected static function get_uri():string {
			$uri = trim($_SERVER['REQUEST_URI'], '/');
			$name = basename($_SERVER["SCRIPT_FILENAME"]); // $name = basename(__FILE__);
			$pos1 = strpos($uri, $name)+strlen($name);
			if ($pos1 !== false) $uri = substr($uri, $pos1);
			$pos2 = strrpos($uri, '?');
			if ($pos2 !== false) $uri = substr($uri, 0, $pos2);
			return trim($uri, '/');
		}


		/*
			Returns query params as asociative array
				http://domain/index.php/xxx/yyy/zzz?param1=123 --> array(param1=>123)
		*/
		protected static function get_query():array {
			parse_str($_SERVER['QUERY_STRING'], $query);
			return $query;
		}

		/*
		GET, PUT, POST, DELETE
		*/
		protected static function get_method():string {
			$method = $_SERVER['REQUEST_METHOD'];
			return $method;
		}

		/*
			text/plain, application/xml, application/json
		*/
		protected static function get_mime():string {
			$mime = $_SERVER['HTTP_ACCEPT'];
			return $mime;
		}

		/*
			Returns content
		*/
		protected static function get_content():string {
			$content = file_get_contents("php://input");
			////parse_str($contents, $output);
			return $content;
		}

		/*
		*/
		protected static function get_header():array {
			$header = apache_request_headers(); // associative array
			return $header;
		}

	}

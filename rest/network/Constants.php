<?php // Proinf.net — 2017

	class Constants {

		//---------------------------------------------
		// CONSTANTS

		const METHODS = array(
			"GET", // READ
			"POST", // CREATE
			"PUT", // SAVE
			"DELETE", // DELETE
		);
		const MIMES = array(
			'text/plain',
			'application/json',
			'application/xml',
			'application/x-www-form-urlencoded',
		);
		const CODES = array(
			100=> 'Continue',
      101=> 'Switching Protocols',
      200=> 'OK',
      201=> 'Created',
      202=> 'Accepted',
      203=> 'Non-Authoritative Information',
      204=> 'No Content',
      205=> 'Reset Content',
      206=> 'Partial Content',
      300=> 'Multiple Choices',
      301=> 'Moved Permanently',
      302=> 'Moved Temporarily',
      303=> 'See Other',
      304=> 'Not Modified',
      305=> 'Use Proxy',
      400=> 'Bad Request',
      401=> 'Unauthorized',
      402=> 'Payment Required',
      403=> 'Forbidden',
      404=> 'Not Found',
      405=> 'Method Not Allowed',
      406=> 'Not Acceptable',
      407=> 'Proxy Authentication Required',
      408=> 'Request Time-out',
      409=> 'Conflict',
      410=> 'Gone',
      411=> 'Length Required',
      412=> 'Precondition Failed',
      413=> 'Request Entity Too Large',
      414=> 'Request-URI Too Large',
      415=> 'Unsupported Media Type',
      500=> 'Internal Server Error',
      501=> 'Not Implemented',
      502=> 'Bad Gateway',
      503=> 'Service Unavailable',
      504=> 'Gateway Time-out',
      505=> 'HTTP Version not supported',
		);

		public static function isValidMethod(string $string):bool {
			return in_array($string, self::MIMES);
		}
		public static function isValidMime(string $string):bool {
			return in_array($string, self::MIMES);
		}
		public static function isValidCode(int $integer):bool {
			return in_array($integer, array_keys(self::CODES));
		}

		public static function getCodeMessage(int $code):string {
			if (array_key_exists($code, self::CODES)) {
				return self::CODES[$code];
			}
			return "";
		}

	}

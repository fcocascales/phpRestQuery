<?php // Proinf.net — 2017

require_once "Format.php";

class FormatJSON extends Format {

	public static function mime():string {
		return "application/json";
	}

	/*
		Input:
			array(
				array('uno'=>"dos", 'tres'=>"cuatro"),
				array('cinco'=>"seis")
			)
		Output:
			'[ { "uno":"dos", "tres":"cuatro" }, { "cinco":"seis" }]'
	*/
	public static function encode(array $data):string {
		$json = json_encode($data, JSON_NUMERIC_CHECK|JSON_PRETTY_PRINT);
		self::exception_if_error();
		return $json;
	}

	/*
		Input:
			'{ "uno":["dos", "tres"], "cuatro":"cinco" }'
		Output:
			array(
				'uno'=> array("dos", "tres"),
				'cuatro'=>"cinco"
			)
	*/
	public static function decode(string $json):array {
		$data = json_decode($json, $assoc=true);
		self::exception_if_error();
		return $data;
	}

	private static function exception_if_error() {
		/*$code = json_last_error();
		if ($code != JSON_ERROR_NONE) {
			throw new Exception(self::ERRORS[$code]);
		}*/
		$code = json_last_error();
		if ($code != JSON_ERROR_NONE) {
			throw new Exception("JSON $code: ".json_last_error_msg());
		}
	}

	const ERRORS = array(
		JSON_ERROR_NONE=> "JSON: No error has occurred",
		JSON_ERROR_DEPTH=> "JSON: The maximum stack depth has been exceeded",
		JSON_ERROR_STATE_MISMATCH=> "JSON: Invalid or malformed JSON",
		JSON_ERROR_CTRL_CHAR=> "JSON: Control character error, possibly incorrectly encoded",
		JSON_ERROR_SYNTAX=> "JSON: Syntax error",
		JSON_ERROR_UTF8=> "JSON: Malformed UTF-8 characters, possibly incorrectly encoded",
		JSON_ERROR_RECURSION=> "JSON: One or more recursive references in the value to be encoded",
		JSON_ERROR_INF_OR_NAN=> "JSON: One or more NAN or INF values in the value to be encoded",
		JSON_ERROR_UNSUPPORTED_TYPE=> "JSON: A value of a type that cannot be encoded was given",
		//JSON_ERROR_INVALID_PROPERTY_NAME=> "JSON: A property name that cannot be encoded was given 	PHP7",
		//JSON_ERROR_UTF16=> "JSON: Malformed UTF-16 characters, possibly incorrectly encoded PHP7",
	);

}

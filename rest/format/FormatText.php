<?php // Proinf.net — 2017

require_once "Format.php";

class FormatText extends Format {

	public static function mime():string {
		return "text/plain";
	}

	/*
		Input:
			array("uno", "dos")
		Output:
			"uno\ndos"
	*/
	public static function encode(array $lines):string {
		$text = implode("\n", $lines);
		return $text;
	}

	/*
		Input:
			"uno\ndos"
		Output:
			array("uno", "dos")
	*/
	public static function decode(string $text):array {
		$lines = explode("\n", $text);
		return $lines;
	}

}

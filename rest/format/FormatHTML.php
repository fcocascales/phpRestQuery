<?php // Proinf.net — 2017

require_once "Format.php";

class FormatHTML extends Format {

	public static function mime():string {
		return "text/html";
	}

	public static function encode(array $dom):string {
		$html = implode("\n", $dom);
		return $html;
	}

	public static function decode(string $html):array {
		$dom = explode("\n", $html);
		return $dom;
	}

}

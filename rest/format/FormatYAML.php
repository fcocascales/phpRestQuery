<?php // Proinf.net — 2017

require_once "Format.php";

class FormatYAML extends Format {

	public static function mime():string {
		return "text/x-yaml";
	}

	/*
	*/
	public static function encode(array $data):string {
		$yaml = yaml_emit($data);
		return $yaml;
	}

	/*
	*/
	public static function decode(string $yaml):array {
		$data = yaml_parse($yaml);
		if ($data === false) return array();
		else return $data;
	}





}

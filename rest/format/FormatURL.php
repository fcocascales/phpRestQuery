<?php // Proinf.net — 2017

require_once "Format.php";

class FormatURL extends Format {

	public static function mime():string {
		return "application/x-www-form-urlencoded";
	}

	/*
		Input:
			array(
			  'foo'=> 'bar',
			  'bar'=> array(
			    'var'=> 'foo',
			  )
			)
		Output:
			"foo=bar&bar[var]=foo"
	*/
	public static function encode(array $assoc):string {
		$query = http_build_query($assoc);
		return $query;
	}

	/*
		Input:
			"first=value&arr[]=foo+bar&arr[]=baz"
		Output:
			array(
				'first'=> 'value',
				'arr'=> array(
					0=> 'foo bar',
					1=> 'baz'
				)
			)
	*/
	public static function decode(string $query):array {
		parse_str($query, $assoc);
		return $assoc;
	}

}

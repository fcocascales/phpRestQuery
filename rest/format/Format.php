<?php // Proinf.net — 2017

	abstract class Format {

		abstract public static function mime():string;

		public static function header() {
			header('Cache-Control: no-cache, must-revalidate');
			header('Pragma: no-cache');
			header('Content-Type: '.self::mime());
			header('Accept: '.self::mime());
		}

		abstract public static function encode(array $decoded):string;
		abstract public static function decode(string $encoded):array;

	}

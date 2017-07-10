<?php // Proinf.net — 2017

	require_once "Format.php";

	class FormatBuilder {

		public static function fromMime(string $mime):Format {
			switch($mime) {
				case 'application/json':
					require_once "FormatJSON.php";
					return new FormatJSON();
				case 'application/xml':
					require_once "FormatXML.php";
					return new FormatXML();
				case 'text/x-yaml':
					require_once "FormatYAML.php";
					return new FormatYAML();
				case 'application/x-www-form-urlencoded':
					require_once "FormatURL.php";
					return new FormatURL();
				case 'text/html':
					require_once "FormatHTML.php";
					return new FormatHTML();
				case 'text/plain':
					require_once "FormatText.php";
					return new FormatText();
				default:
					return self::fromMime('application/json');
			}
		}

	}

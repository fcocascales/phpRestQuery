<?php

	class Header {

		public static function linesToAssoc(array $lines):array {
			$assoc = array();
			foreach($lines as $line) {
				$pos = strpos($line, ":");
				if ($pos === false) {
					$assoc[] = $line;
				}
				else {
					$key = trim(substr($line, 0, $pos));
					$value = trim(substr($line, $pos+1));
					$assoc[$key] = $value;
				}
			}
			return $assoc;
		}

		public static function assocToText(array $assoc):string {
			$text = "";
			foreach($assoc as $key=>$value) {
				if (!empty($text)) $text .= "\r\n";
				if (is_numeric($key)) $text .= $value;
				else $text .= "$key: $value";
			}
			return $text;
		}

		public static function getCode($header):int {
			$line = is_array($header)? $header[0] : $header;
			$pos = strpos($line, ' ');
			return intval(substr($line, $pos));
		}

		public static function getMime(array $assoc):string {
			if (!isset($assoc['Content-Type'])) return "";
			$value = $assoc['Content-Type'];
			if (empty($value)) return "";
			$items = explode(';', $value);
			return trim($items[0]);
		}

	}

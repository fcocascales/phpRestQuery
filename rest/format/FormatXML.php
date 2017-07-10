<?php // Proinf.net — 2017

require_once "Format.php";

class FormatXML extends Format {

	public static function mime():string {
		return "application/xml";
	}

	public static function encode(array $data):string {
		//return self::encode1($data);
		return self::encode2($data);
	}

	public static function decode(string $xml):array {
		//return self::decode1($xml);
		return self::decode2($xml);
	}

	//----------------------------------------------
	// ENCODE

	/*
		https://stackoverflow.com/questions/1397036/how-to-convert-array-to-simplexml

		$data = array (
			'bla' => 'blub',
			'foo' => 'bar',
			'another_array' => array (
				'stack' => 'overflow',
			),
		);
		echo XML::encode($data);

			<?xml version="1.0"?>
			<root>
				<blub>bla</blub>
				<bar>foo</bar>
				<overflow>stack</overflow>
			</root>
	*/
	private static function encode1($data) {
		$sxe = new SimpleXMLElement('<root/>');
		array_walk_recursive($data, array($sxe, 'addChild'));
		$xml = $sxe->asXML();
		return $xml;
	}

	/*
		https://stackoverflow.com/questions/1397036/how-to-convert-array-to-simplexml

		Array(
	  	['total_stud']=> 500
	  	[0] => Array(
	      [student] => Array(
	        [id] => 1
	        [name] => abc
	        [address] => Array(
	          [city]=>Pune
	          [zip]=>411006
	        )
	    	)
	    )
			[1] => Array(
	      [student] => Array(
          [id] => 2
          [name] => xyz
          [address] => Array(
            [city]=>Mumbai
            [zip]=>400906
          )
      	)
			)
		)

		<?xml version="1.0"?>
		<student_info>
	    <total_stud>500</total_stud>
	    <student>
        <id>1</id>
        <name>abc</name>
        <address>
          <city>Pune</city>
          <zip>411006</zip>
        </address>
	    </student>
	    <student>
        <id>1</id>
        <name>abc</name>
        <address>
          <city>Mumbai</city>
          <zip>400906</zip>
        </address>
	    </student>
		</student_info>
	*/
	private static function encode2($data) {
		if (!is_array($data)) return "";
		libxml_use_internal_errors(true);
		$sxe = new SimpleXMLElement('<?xml version="1.0"?><data></data>');
		self::encode2_recursive($data, $sxe); // convert array to xml
		//$result = $sxe->asXML('/file/path/name.xml'); // Save to file
		$xml = $sxe->asXML();
		self::exception_if_error();
		return $xml;
	}
	// function defination to convert array to xml
	private static function encode2_recursive($data, &$sxe) {
    foreach ($data as $key=>$value) {
      if (is_numeric($key)) {
        $key = 'item'.$key; //dealing with <0/>..<n/> issues
      }
      if (is_array($value)) {
        $subnode = $sxe->addChild($key);
        self::encode2_recursive($value, $subnode);
      } else {
        $sxe->addChild("$key", htmlspecialchars("$value"));
      }
   	}
 	}

	//----------------------------------------------
	// DECODE

	private static function decode1($xml) {
		$data = new SimpleXMLElement($xml);
		return $data;
	}
	private static function decode2($xml) {
		// https://stackoverflow.com/questions/6578832/how-to-convert-xml-into-array-in-php
		// https://secure.php.net/manual/es/function.simplexml-load-string.php
		libxml_use_internal_errors(true);
		$sxe = simplexml_load_string($xml, "SimpleXMLElement", LIBXML_NOCDATA);
		$data = json_decode(json_encode($sxe), $assoc=true);
		self::exception_if_error();
		return $data;
	}
	private static function exception_if_error() {
		$errors = array();
		self::inflate_XML_errors($errors);
		self::inflate_JSON_errors($errors);
		if (!empty($errors)) throw new Exception(implode('; ', $errors));
	}
	private static function inflate_XML_errors(&$errors) {
		foreach (libxml_get_errors() as $error) {
			switch ($error->level) {
        case LIBXML_ERR_WARNING: continue;
        case LIBXML_ERR_ERROR:
        case LIBXML_ERR_FATAL:
					$message = trim($error->message, "\n");
          $errors[] = "XML $error->code: $message [$error->line, $error->column]";
			}
		}
		libxml_clear_errors();
	}
	private static function inflate_JSON_errors(&$errors) {
		if (json_last_error() != JSON_ERROR_NONE) {
			$errors[] = "JSON $code: ".json_last_error_msg();
		}
	}

}

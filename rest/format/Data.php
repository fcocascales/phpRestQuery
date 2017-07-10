<?php // Proinf.net — 2017 

	require_once "Format.php";

	/*
		Example:
			header("Content-Type: text/plain");

			require_once "FormatJSON.php";
			$data = new Data(new FormatJSON());
			$data->setText('{"uno":"dos"}');
			print_r($data->getData());
			$data->setData(array('tres'=>"cuatro"));
			print_r($data->getText());

			require_once "FormatXML.php";
			$data->setFormat(new FormatXML());
			$data->setText('<uno dos="tres"><cuatro>cinco</cuatro></uno>');
			print_r($data->getData());
			$data->setData(array('uno'=>"dos", 'tres'=>"cuatro"));
			print_r($data->getText());
	*/
	class Data {

		protected $format = null;
		protected $data = "";
		protected $error = "";

		//---------------------------------------------
		// CONSTRUCTOR

		public function __construct(Format $format=null) {
			$this->format = $format;
		}

		//---------------------------------------------
		// GETTERS  & SETTERS

		public function getFormat():Format { return $this->format; }
		public function setFormat(Format $format) { $this->format = $format; }

		public function getError():string { return $this->error; }

		//---------------------------------------------
		// DATA

		public function setData(array $decoded) { $this->data = $decoded;	}
		public function getText():string { return $this->encode($this->data); }

		public function setText(string $encoded) { $this->data = $this->decode($encoded); }
		public function getData():array { return $this->data; }

		//---------------------------------------------
		// ENCODE & DECODE

		public function encode(array $decoded):string {
			// try {
				if (!empty($this->format)) {
					$encoded = $this->format::encode($decoded);
					return $encoded;
				}
				else return "";
			// }
			// catch (Exception $ex) {
			// 	$this->error = $ex->getMessage();
			// 	return null;
			// }
		}

		public function decode(string $encoded):array {
			// try {
				if (!empty($this->format)) {
					$decoded = $this->format::decode($encoded);
					return $decoded;
				}
				else return array();
			// }
			// catch (Exception $ex) {
			// 	$this->error = $ex->getMessage();
			// 	return null;
			// }
		}

	}

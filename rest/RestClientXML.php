<?php // Proinf.net — 2017

	require_once "RestClient.php";
	require_once "format/FormatXML.php";

	class RestClientXML extends RestClient {

		public function __construct() {
			parent::__construct(new FormatXML());
		}

	}

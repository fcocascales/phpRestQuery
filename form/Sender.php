<?php

require_once "../rest/RestClient.php";
require_once "../rest/format/FormatBuilder.php";

class Sender extends RestClient {

	public function __construct() {
		parent::__construct(FormatBuilder::fromMime('application/json'));
		$this->setServer('receiver.php');
		$this->setUri('clientes/1');
		$this->setQuery(array('abc'=>123, 'def'=>456));
		$this->setMethod('POST');
		$this->setData(array('id'=>101));
	}

	//----------------------------------------------
	// HELPERS

	public function request($assoc=null) {
		if (empty($assoc)) {
			if (!empty($_POST)) return $this->request($_POST);
			if (!empty($_GET)) return $this->request($_GET);
		}
		$this->setServer(isset($assoc['server'])? $assoc['server'] : "");
		$this->setUri(isset($assoc['uri'])? $assoc['uri'] : "");
		$this->setQueryString(isset($assoc['query'])? $assoc['query'] : "");
		$this->setMethod(isset($assoc['method'])? $assoc['method'] : "GET");
		$this->setMime(isset($assoc['mime'])? $assoc['mime'] : "application/json");
		$this->setContent(isset($assoc['content'])? $assoc['content'] : "");
		return $this->getRequest();
	}

	public function cookie() {
		$request = $this->getRequest();
		setcookie('server', $request->getServer());
		setcookie('uri', $request->getUri());
		setcookie('query', $request->getQueryString());
		setcookie('method', $request->getMethod());
		setcookie('mime', $request->getMime());
		setcookie('content', $request->getContent());
	}


}

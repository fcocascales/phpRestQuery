<?php

	require_once "../rest/RestServer.php";

	class TestServer extends RestServer {
		public function process() {
			$data = $this->getRequest()->getAll();
			//print_r($data);
			$this->setCode(200);
			$this->setData($data);
		}
	}
	$server = new TestServer();
	$server->process();
	$server->send();

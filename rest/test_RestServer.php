<?php // Proinf.net — 2017

	require_once "RestServer.php";

	class TestServer extends RestServer {
		public function process() {
			$data = $this->getRequest()->getAll();
			//print_r($data);
			$this->setCode(203);
			$this->setData($data);
		}
	}
	$server = new TestServer();
	$server->process();
	$server->send();

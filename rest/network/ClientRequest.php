<?php

	require_once "Request.php";
	require_once "URL.php";

	class ClientRequest extends Request {

		public function getURL():string {
			$url = URL::make($this->getServer(), $this->getUri(), $this->getQuery());
			return $url;
		}

	}

<?php // Proinf.net — 2017

	require_once "ClientRequest.php";
	require_once "ClientResponse.php";
	require_once "Header.php";

	class Client {

		/*
			https://secure.php.net/manual/es/context.php
				https://secure.php.net/manual/es/context.http.php

		*/
		public static function send(ClientRequest $request):ClientResponse {
			self::exception_if_error();
			$url = $request->getURL();
			////$content = http_build_query($data);
			$header = array(
				//'Content-Type'=> "application/x-www-form-urlencoded",
				'Content-Type'=> $request->getMime(),
				'Accept'=> $request->getMime(), // Desired response format
				'Content-Length'=> strlen($request->getContent()),
				//'Accept-language'=> "en",
				//'Authorization'=> "Basic ".base64_encode("$https_user:$https_password"),
				//'Connection'=> "close",
				//'Cookie'=> "foo=bar",
			);
			$request->setHeader($header);
			$options = array(
	      'http' => array(
	        'header' => Header::assocToText($header),
	        'method'  => $request->getMethod(),
	        'content' => $request->getContent(),
					//'timeout' => 60,
	      ),
	    );
			$context = stream_context_create($options);
	    $content = file_get_contents($url, false, $context);
			$header = Header::linesToAssoc($http_response_header);

			$response = new ClientResponse();
			$response->setContent($content);
			$response->setCode(Header::getCode($header)); // http_response_code()
			$response->setMime(Header::getMime($header));
			$response->setHeader($header);
			return $response;
	  }

		private static function exception_if_error() {
			set_error_handler(
				function($errno, $errstr, $errfile, $errline, array $errcontext) {
	    		// error was suppressed with the @-operator
	    		if (0 === error_reporting()) return false;
	    		throw new ErrorException($errstr, $errno, $severity=E_ERROR, $errfile, $errline);
				}
			);
			////restore_error_handler();
		}

	}

<?php
	require_once "Sender.php";
	$sender = new Sender();
	$request = $sender->request();
	if (!empty($_POST)) {
		$sender->cookie();
		try { $response = $sender->send(); }
		catch (Exception $ex) { $error = $ex; }
	}

?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Sender</title>
	<link rel="stylesheet" href="sender.css">
</head>
<body>
	<h1><!--a href="..">&larr;</a--> <strong>Sender</strong> &mdash; submit a REST query</h1>
	<section id="request" class="zone">
		<h2>Request</h2>
		<form  action="" method="post">
			<div>
				<label for="server">Server:</label>
				<input type="text" name="server" id="server"
					value="<?php echo htmlspecialchars($request->getServer()); ?>">
			</div>
			<div>
				<label for="uri">URI:</label>
				<input type="text" name="uri" id="uri"
					value="<?php echo htmlspecialchars($request->getUri()); ?>">
			</div>
			<div>
				<label for="query">Query:</label>
				<input type="text" name="query" id="query"
					value="<?php echo htmlspecialchars($request->getQueryString()); ?>">
			</div>
			<div>
				<span>
					<label for="method">Method:</label>
					<select name="method" id="method">
						<option></option>
						<?php
							$method = $request->getMethod();
							foreach(Constants::METHODS as $value) {
								$selected = $value == $method? " selected": "";
								echo "\t<option$selected>$value</option>\n";
							}
						?>
					</select>
				</span>
				<span>
					<label for="mime">MIME:</label>
					<select name="mime" id="mime">
						<option></option>
						<?php
							$mime = $request->getMime();
							foreach(Constants::MIMES as $value) {
								$selected = $value == $mime? " selected": "";
								echo "\t<option$selected>$value</option>\n";
							}
						?>
					</select>
				</span>
			</div>
			<div>
				<label for="content">Content:</label>
				<textarea name="content" id="content"><?php echo htmlspecialchars($request->getContent()); ?></textarea>
			</div>
			<div>
				<button>Send</button>
			</div>
		</form>
		<?php
			echo '<div><label>URL:</label> <p class="output">'.$request->getURL().'</p></div>';
			echo '<div><label>Header:</label> <pre class="output">'.htmlspecialchars(Header::assocToText($request->getHeader())).'</pre></div>';
		?>
	</section>

	<?php
		if (!empty($error)):
			echo '<section id="error" class="zone">';
			echo ' <h2>Error</h2>';
			echo ' <div><label>Code:</label> <p class="output">'.$error->getCode().'</p></div>';
			echo ' <div><label>Message:</label> <p class="output">'.htmlspecialchars($error->getMessage()).'</p></div>';
			echo ' <div><label>File:</label> <p class="output">'.htmlspecialchars($error->getFile()).'</p></div>';
			echo ' <div><label>Line:</label> <p class="output">'.htmlspecialchars($error->getLine()).'</p></div>';
			//echo ' <div><label>Trace:</label> <pre class="output">'; print_r($error->getTrace()); echo '</pre></div>';
			echo '</section>';
		endif;
	?>

	<?php
		if (!empty($response)):
			echo '<section id="response" class="zone">';
			echo ' <h2>Response</h2>';
			//echo '<div>'; print_r($response->getAll()); echo '</div>';
			echo ' <div>';
			echo '  <label>Code:</label> <span class="box output">'.$response->getCode().'</span>';
			echo '  <label>MIME:</label> <span class="box output">'.$response->getMime().'</span>';
			echo ' </div>';
			echo ' <div><label>Content:</label> <pre class="output">'.htmlspecialchars($response->getContent()).'</pre></div>';
			echo ' <div><label>Header:</label> <pre class="output">'.htmlspecialchars(Header::assocToText($response->getHeader())).'</pre></div>';
			echo '</section>';
		endif;
	?>

</body>
</html>

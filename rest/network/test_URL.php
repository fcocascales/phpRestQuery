<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Test URL</title>
	<style media="screen">
		.ok { color:green; }
		.ko { color:red; }
		var { color:#666; font-style:normal; }
	</style>
</head>
<body>
	<h1>Test URL</h1>
	<?php // Proinf.net — 2017

		require_once "URL.php";

		function fi2ot($func, $input1, $input2, $output, $test) {
			$ok = $output == $test? 'ok':'ko';
			$ref = $output == $test? '': " ≠ '$test'";
			echo "<li><strong>$func</strong>('<var>$input1</var>', '<var>$input2</var>') &rarr; <span class=\"$ok\">'$output'</span> $ref</li>\n";
		}
		function fiot($func, $input, $output, $test) {
			$ok = $output == $test? 'ok':'ko';
			$ref = $output == $test? '': " ≠ '$test'";
			echo "<li><strong>$func</strong>('<var>$input</var>') &rarr; <span class=\"$ok\">'$output'</span> $ref</li>\n";
		}
		function fot($func, $output, $test) {
			$ok = $output == $test? 'ok':'ko';
			$ref = $output == $test? '': " ≠ '$test'";
			echo "<li><strong>$func</strong>() &rarr; <span class=\"$ok\">'$output'</span> $ref</li>\n";
		}

		function testClassURL() {
			echo "<h2>class URL</h2><ul>";

			$protocol = URL::protocol(); //'http://';
			$domain = URL::domain(); //'probando.localhost';
			$directory = URL::directory(); //'/RestQuery/rest/network';
			$url = "$protocol$domain$directory"; //URL::protocol().URL::domain().$_SERVER['REQUEST_URI'];

			echo "<li>URL=$url</li>";

			fot('URL::protocol', URL::protocol(), $protocol);
			fot('URL::domain', URL::domain(), $domain);
			fot('URL::directory', URL::directory(), $directory);
			fiot('URL::get', 'FILE', URL::get('FILE'), "$url/FILE");

			fiot('URL::absolute', 'FILE', URL::absolute('FILE'), "$url/FILE");
			fiot('URL::absolute', 'directory/FILE', URL::absolute('directory/FILE'), "$url/directory/FILE");
			fiot('URL::absolute', '/directory/FILE', URL::absolute('/directory/FILE'), "$protocol$domain/directory/FILE");
			fiot('URL::absolute', 'http://domain/directory/FILE', URL::absolute('http://domain/directory/FILE'), 'http://domain/directory/FILE');
			fiot('URL::absolute', '//domain/directory/FILE', URL::absolute('//domain/directory/FILE'), '//domain/directory/FILE');
			fiot('URL::absolute', '../FOLDER/FILE', URL::absolute('../FOLDER/FILE'), "$protocol$domain".dirname($directory)."/FOLDER/FILE");
			fiot('URL::absolute', '../../FOLDER/FILE', URL::absolute('../../FOLDER/FILE'), "$protocol$domain".dirname(dirname($directory))."/FOLDER/FILE");
			fiot('URL::absolute', '../../FILE', URL::absolute('../../FILE'), "$protocol$domain".dirname(dirname($directory))."/FILE");
			fiot('URL::absolute', '../../../FILE', URL::absolute('../../../FILE'), "$protocol$domain".dirname(dirname(dirname($directory)))."/FILE");

			$func = 'URL::strip_parents';
			$in2 = '/dir1/dir2/dir3';
			$in1 = 'file'; $test = 'dir1/dir2/dir3/file';
			fi2ot($func, $in1, $in2, URL::strip_parents($in1, $in2), $test);
			$in1 = '../file'; $test = 'dir1/dir2/file';
			fi2ot($func, $in1, $in2, URL::strip_parents($in1, $in2), $test);
			$in1 = '../../file' ; $test = 'dir1/file';
			fi2ot($func, $in1, $in2, URL::strip_parents($in1, $in2), $test);
			$in1 = '../../../file' ; $test = 'file';
			fi2ot($func, $in1, $in2, URL::strip_parents($in1, $in2), $test);
			$in1 = '../../../../file' ; $test = 'file';
			fi2ot($func, $in1, $in2, URL::strip_parents($in1, $in2), $test);
			$in1 = '../folder/file'; $test = 'dir1/dir2/folder/file';
			fi2ot($func, $in1, $in2, URL::strip_parents($in1, $in2), $test);
			$in1 = '../../folder/file'; $test = 'dir1/folder/file';
			fi2ot($func, $in1, $in2, URL::strip_parents($in1, $in2), $test);
			$in1 = '/file'; $test = '/file';
			fi2ot($func, $in1, $in2, URL::strip_parents($in1, $in2), $test);
			$in1 = '/folder/file'; $test = '/folder/file';
			fi2ot($func, $in1, $in2, URL::strip_parents($in1, $in2), $test);

			echo "</ul>";
		}

		testClassURL();
	?>
</body>
</html>

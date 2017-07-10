<?php // Proinf.net — 2017

  function test_extract_uri(string $name, string $uri, string $reference) {

    $pos1 = strpos($uri, $name) + strlen($name);
    $result = substr($uri, $pos1);

    $pos2 = strrpos($result, '?');
    if ($pos2 !== false) $result = substr($result, 0, $pos2);
    $result = trim($result,'/');

    $msg = $result==$reference? '<span class="ok">OK</span>':'<span class="ko">ERROR</span>';
    echo "<p>name='$name'<br>URI='$uri'<br>pos1=$pos1, pos2=$pos2<br>result='$result' $msg</p>";
  }

  function test_history_uri(string $uri, int $count, string $reference) {
    $result = getUriHistory($uri, $count);
    $msg = $result==$reference? '<span class="ok">OK</span>':'<span class="ko">ERROR</span>';
    echo "<p>uri='$uri'<br>count='$count'<br>result='$result' $msg</p>";
  }

  function getUriHistory(string $uri, int $count):string {
    //  1 : first item
    //  2 : two first items
    // -1 : all except last item
    // -2 : all except two last items
    $items = explode('/', $uri);
    if ($count < 0) $count = count($items) + $count;
    $count = min($count, count($items));
    return implode('/', array_slice($items, 0, $count));
  }

?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Test URI</title>
  <style media="screen">
    .ok { color:lime; }
    .ko { color:red; font-weight:bold; }
  </style>
</head>
<body>
  <h1>Test URI</h1>

  <h2>Extract URI</h2>
  <?php
    $server = 'server';
    test_extract_uri($server, "$server/uno/dos", 'uno/dos');
    test_extract_uri($server, "$server/uno/dos?tres.cuatro", 'uno/dos');
    test_extract_uri($server, "$server/", '');
    test_extract_uri($server, "$server/?uno=dos", '');
    test_extract_uri($server, "$server?uno=dos" , '');
  ?>

  <h2>History URI</h2>
  <?php
    test_history_uri('uno/dos/tres', 4, 'uno/dos/tres');
    test_history_uri('uno/dos/tres', 3, 'uno/dos/tres');
    test_history_uri('uno/dos/tres', 2, 'uno/dos');
    test_history_uri('uno/dos/tres', 1, 'uno');
    test_history_uri('uno/dos/tres', 0, '');
    test_history_uri('uno/dos/tres', -1, 'uno/dos');
    test_history_uri('uno/dos/tres', -2, 'uno');
    test_history_uri('uno/dos/tres', -3, '');
    test_history_uri('uno', 2, 'uno');
    test_history_uri('uno', 1, 'uno');
    test_history_uri('uno', 0, '');
    test_history_uri('uno', -1, '');
    test_history_uri('', 1, '');
    test_history_uri('', 0, '');
    test_history_uri('', -1, '');
  ?>
</body>
</html>

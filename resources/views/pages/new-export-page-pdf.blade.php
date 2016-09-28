<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $page->name }}</title>

    <style>
        {!! $css !!}
    </style>
</head>
<body>
<?php

    print "<h1>" . $page->name . "</h1>";
    print "<div class='export-page-content'>" . $page->html . "</div>";

?>

</body>
</html>

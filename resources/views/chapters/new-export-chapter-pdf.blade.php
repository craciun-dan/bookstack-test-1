<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title><?php print $chapter->name; ?></title>

    <style>
        {!! $css !!}
    </style>

</head>
<body>

<?php

    print "<h1>" . $chapter->name . "</h1>";
    foreach($chapter->pages as $currentPage) {
        print "<h2>" . $currentPage->name . "</h2>";
        print "<div style='clear: left;'></div>";
        print "<div class='export-page-content'>" . $currentPage->html . "</div>";
    }

?>

</body>
</html>

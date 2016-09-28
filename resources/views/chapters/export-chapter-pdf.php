<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title><?php print $page->chapter->name ?></title>

    <style>
        {!! $css !!}
    </style>
    @include ('books/export-book-css')
</head>
<body>
<?php

    print "<h1>" . $page->chapter->name . "</h1>";
    foreach($page->chapter->pages as $currentPage) {
        print "<h2>" . $currentPage->name . "</h2>";
        print "<div style='clear: left;'></div>";
        print "<div class='export-page-content'>" . $currentPage->html . "</div>";
    }

?>

</body>
</html>

<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $page->book->name }}</title>

    <style>
        {!! $css !!}
    </style>
        <!-- TODO: get the correct relative path instead of absolute -->
        <?php include '/var/www/html/resources/views/pages/export-all-css.php'; ?>
</head>
<body>

<?php
foreach ($page->book->chapters as $chaplist) {
        print "<h1>" . $chaplist->name . "</h1>";
        foreach($chaplist->pages as $cchap) {
                print "<h2>" . $cchap->name . "</h2>";
                print "<div id='export-page-content'>" . $cchap->html . "</div>";
        }
}
?>

<hr><hr>

</body>
</html>

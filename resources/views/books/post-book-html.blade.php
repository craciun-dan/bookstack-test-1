<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $book->name }}</title>

    <style>
        {!! $css !!}
    </style>
    <style>
        @include ('books/new-export-book-css')
    </style>
</head>
<body>
<?php
if (count($book->chapters) > 0) {

    print "<ul class='ul-toc'>";
    foreach ($book->chapters as $currentChapter) {
        print "<li><a href='#" . $currentChapter->name . "'>" . $currentChapter->name . "</a></li>";
        if (count($currentChapter->pages) > 0) {
            print "<ul>";
            foreach($currentChapter->pages as $currentPage) {
                print "<li><a href='#" . $currentPage->name . "'>" . $currentPage->name . "</a></li>";
            }
            print "</ul>";
        }
    }
    print "</ul>";

    foreach ($book->chapters as $currentChapter) {
        print "<h1 id='" . $currentChapter->name . "'>" . $currentChapter->name . "</h1>";
        if (count($currentChapter->pages) > 0) {
            foreach($currentChapter->pages as $currentPage) {
                print "<h2 id='" . $currentPage->name . "'>" . $currentPage->name . "</h2>";
                print "<div style='clear: left;'></div>";
                print "<div class='export-page-content'>" . $currentPage->html . "</div>";
            }
        }
    }
}
?>

</body>
</html>

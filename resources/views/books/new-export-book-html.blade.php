<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $book->name }}</title>

    <style>
        {!! $css !!}
    </style>
    <style>
        @include('books/new-export-book-css')
    </style>
</head>
<body>

<?php
if (count($book->chapters) > 0) {

    print '<div id="div-export-toc">Table of Contents</div>';

    /* generate toc */
    $indexChapter = 1;
    $sum = 0;
    $sumChapters = 0;
    $openDiv = 0;
    $closeDiv = 0;
    print '<div class="div-column">' . "\n";
    $openDiv++;
    foreach ($book->chapters as $currentChapter) {
        $sum++;
        $sumChapters++;
        if ($sumChapters % 6 == 0) {
             if ($openDiv > $closeDiv) { print '</div>' . "\n"; $closeDiv++; }
             print '<div class="div-column">' . "\n";
             $openDiv++;
        }

        print "<ul><a href='#" . $currentChapter->name . "'>" . $indexChapter . ". " . $currentChapter->name . "</a>" . "\n";
        if (count($currentChapter->pages) > 0) {
            $indexPage = 1;
            foreach($currentChapter->pages as $currentPage) {
                $sum++;
                print "<li><a href='#" . $currentPage->name . "'>" . $indexChapter . "." . $indexPage . ". " . $currentPage->name . "</a></li>" . "\n";
                $indexPage++;
            }
        }
        print "</ul>";
        $indexChapter++;
    }
    if ($openDiv > $closeDiv) { print '</div>' . "\n"; $closeDiv++; }
    print '<div style="clear: both;"></div>';

    $indexChapter = 1;
    foreach ($book->chapters as $currentChapter) {
        print "<h1 id='" . $currentChapter->name . "'>" . $indexChapter . ". " . $currentChapter->name . "</h1>";
        if (count($currentChapter->pages) > 0) {
            $indexPage = 1;
            foreach($currentChapter->pages as $currentPage) {
                print "<h2 id='" . $currentPage->name . "'>" . $indexChapter . "." . $indexPage . ". " . $currentPage->name . "</h2>";
                print "<div style='clear: left;'></div>";
                print "<div class='export-page-content'>" . $currentPage->html . "</div>";
                $indexPage++;
            }
        }
        $indexChapter++;
    }

}
?>

</body>
</html>

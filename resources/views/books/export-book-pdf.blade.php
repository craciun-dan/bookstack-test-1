<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $page->book->name }}</title>

    <style>
        {!! $css !!}
    </style>
    @include ('books/export-book-css')
    <style>
        body {
            font-size: 15px;
            line-height: 1;
        }

        h1, h2, h3, h4, h5, h6 {
            line-height: 1;
        }

        table {
            max-width: 800px !important;
            font-size: 0.8em;
            width: auto !important;
        }

        table td {
            width: auto !important;
        }

        .page-content img.align-left, .page-content img.align-right  {
            float: none !important;
            clear: both;
            display: block;
        }
    </style>
</head>
<body>
<?php
//use BookStack\Repos;

foreach ($page->book->chapters as $currentChapter) {
        print "<h1>" . $currentChapter->name . "</h1>";

        foreach($currentChapter->pages as $currentPage) {
                print "<h2>" . $currentPage->name . "</h2>";
                print "<div style='clear: left;'></div>";

                print $currentPage->html;
                // print $currentPage->html; // cannot be rendered by dompdf
        }

}

?>

</body>
</html>

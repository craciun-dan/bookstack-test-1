<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $book->name }}</title>

    <style>
        {!! $css !!}
    </style>
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



/*
foreach ($book->chapters as $currentChapter) {
    print "<h1>" . $currentChapter->name . "</h1>";

    foreach($currentChapter->pages as $currentPage) {
        print "<h2>" . $currentPage->name . "</h2>";
        print "<div style='clear: left;'></div>";
        print $currentPage->html;
    }
}
*/

/*
    system("echo " . "<html><head></head><body> " . ">" . "/var/www/html/public/uploads/unifiedHtml.html");
    foreach ($book->chapters as $currentChapter) {
        system("echo " . "<h1 id='" . $currentChapter->name . "'>" . $currentChapter->name . "</h1>" . ">>" . "/var/www/html/public/uploads/unifiedHtml.html");
        if (count($currentChapter->pages) > 0) {
            foreach($currentChapter->pages as $currentPage) {
                system("echo " . "<h2 id='" . $currentPage->name . "'>" . $currentPage->name . "</h2>" .
                       ">>" . "/var/www/html/public/uploads/unifiedHtml.html");
                system("echo " . $currentPage->html . ">>" . "/var/www/html/public/uploads/unifiedHtml.html");
            }
        }
    }
    system("echo " .  "</body></html>" . ">>" . "/var/www/html/public/uploads/unifiedHtml.html");
*/

/*
    $unifiedHtml = "<html><head></head><body>";
    foreach ($book->chapters as $currentChapter) {
        $unifiedHtml .= "<h1 id='" . $currentChapter->name . "'>" . $currentChapter->name . "</h1>";
        if (count($currentChapter->pages) > 0) {
            foreach($currentChapter->pages as $currentPage) {
                $unifiedHtml .= "<h2 id='" . $currentPage->name . "'>" . $currentPage->name . "</h2>";
                $unifiedHtml .= "<div style='clear: left;'></div>";
                $unifiedHtml .= "<div class='export-page-content'>" . $currentPage->html . "</div>";
            }
        }
    }
    $unifiedHtml .= "</body></html>";

    $unifiedHtml = mb_convert_encoding($unifiedHtml, 'UTF-8', mb_detect_encoding($unifiedHtml));
    $unifiedFile = fopen("/var/www/html/public/uploads/unifiedHtml.html", "w") or info("Cannot open file for writing.");
//    fwrite($unifiedFile, $unifiedHtml);
    file_put_contents("/var/www/html/public/uploads/unifiedHtml.html", $unifiedHtml);
    fclose($unifiedFile);
*/
//    print $unifiedHtml;


    system("/opt/wkhtmltox/bin/wkhtmltopdf " .
           "/var/www/html/public/uploads/unifiedHtml.html " .
           "/var/www/html/public/uploads/unifiedOut.pdf");

?>

</body>
</html>

<?php namespace BookStack\Services;

use BookStack\Page;
use BookStack\Chapter;
use BookStack\Book;

system('echo Starting PDF convert...' . ' ' . '>' . ' ' . storage_path() . '/pdfconvert.log');

$cli = '/opt/wkhtmltox/bin/wkhtmltopdf' . ' ' .
       '--margin-bottom 12 --margin-left 4 --margin-right 4 --margin-top 8' . ' ' .
       '--footer-spacing 6 --footer-left "[title]" --footer-right "Page [page] of [topage]" --page-size Letter' . ' ' .
       '--title' . ' ' .
       '"' . $book->name . '"' . ' ' .
       'cover' . ' ' .
       '"' . public_path() . '"' . '/uploads/cd_cover_front.html' . ' ' .
//       'toc' . ' ' .
       storage_path() . '/' . $book->slug . '.html' . ' ' .
       storage_path() . '/' . $book->slug . '.pdf' . ' ' .
       '2>>' . ' ' . storage_path() . '/pdfconvert.log' . ' ' .
       '1>>' . ' ' . storage_path() . '/pdfconvert.log';

system('echo' . ' ' . $cli . ' ' . '>>' . ' ' . storage_path() . '/pdfconvert.log');

system($cli);

system('echo Finished PDF convert...' . ' ' . '>>' . ' ' . storage_path() . '/pdfconvert.log');

?>

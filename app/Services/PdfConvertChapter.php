<?php namespace BookStack\Services;

use BookStack\Page;
use BookStack\Chapter;
use BookStack\Book;

system('echo Starting PDF convert...' . ' ' . '>' . ' ' . storage_path() . '/pdfconvert.log');

$cli = '/opt/wkhtmltox/bin/wkhtmltopdf' . ' ' .
       '--title' . ' ' .
       '"' . $chapter->name . '"' . ' ' .
//       'cover' . ' ' .
//       '"' . public_path() . '"' . '/uploads/cd_cover_front.png' . ' ' .
       'toc' . ' ' .
       storage_path() . '/' . $chapter->slug . '.html' . ' ' .
       storage_path() . '/' . $chapter->slug . '.pdf' . ' ' .
       '2>>' . ' ' . storage_path() . '/pdfconvert.log' . ' ' .
       '1>>' . ' ' . storage_path() . '/pdfconvert.log';

system('echo' . ' ' . $cli . ' ' . '>>' . ' ' . storage_path() . '/pdfconvert.log');

system($cli);

system('echo Finished PDF convert...' . ' ' . '>>' . ' ' . storage_path() . '/pdfconvert.log');

?>

<?php namespace BookStack\Services;

use BookStack\Page;
use BookStack\Chapter;
use BookStack\Book;

class ExportService
{

    public function serviceExportFromPageToHtml (Page $page) {
        $cssContent = file_get_contents(public_path('/css/export-styles.css'));
        $pageHtml = view('pages/new-export-page-html', ['page' => $page, 'css' => $cssContent])->render();
        return $this->containHtml($pageHtml);
    }

    public function serviceExportFromChapterToHtml (Chapter $chapter) {
        $cssContent = file_get_contents(public_path('/css/export-styles.css'));
        $chapterHtml = view('chapters/new-export-chapter-html', ['chapter' => $chapter, 'css' => $cssContent])->render();
        return $this->containHtml($chapterHtml);
    }

    public function serviceExportFromBookToHtml (Book $book) {
        $cssContent = file_get_contents(public_path('/css/export-styles.css'));
        $bookHtml = view('books/new-export-book-html', ['book' => $book, 'css' => $cssContent])->render();
        return $this->containHtml($bookHtml);
    }

    public function serviceExportFromPageToPdf (Page $page) {
        $cssContent = file_get_contents(public_path('/css/export-styles.css'));
        $pageHtml = view('pages/new-export-page-pdf', ['page' => $page, 'css' => $cssContent])->render();
        $containedHtml = $this->containHtml($pageHtml);

        if (setting('pdfparser') == 'script') {
            $file = fopen(storage_path() . '/' . $page->slug . '.html', 'wb');
            fwrite($file, $containedHtml);
            fclose($file);

            include (base_path() . '/app/Services/PdfConvertPage.php');

            return null;
        } else {
            $pdf = \PDF::loadHTML($containedHtml);

            return $pdf->output();
        }

        return null;
    }

    public function serviceExportFromChapterToPdf (Chapter $chapter) {
        $cssContent = file_get_contents(public_path('/css/export-styles.css'));
        $chapterHtml = view('chapters/new-export-chapter-pdf', ['chapter' => $chapter, 'css' => $cssContent])->render();
        $containedHtml = $this->containHtml($chapterHtml);

        if (setting('pdfparser') == 'script') {
            $file = fopen(storage_path() . '/' . $chapter->slug . '.html', 'wb');
            fwrite($file, $containedHtml);
            fclose($file);

            include (base_path() . '/app/Services/PdfConvertChapter.php');

            return null;
        } else {
            $pdf = \PDF::loadHTML($containedHtml);

            return $pdf->output();
        }

        return null;
    }

    public function serviceExportFromBookToPdf (Book $book) {
        $cssContent = file_get_contents(public_path('/css/export-styles.css'));
        $bookHtml = view('books/new-export-book-html', ['book' => $book, 'css' => $cssContent])->render();
        $containedHtml = $this->containHtml($bookHtml);

        if (setting('pdfparser') == 'script') {
            $file = fopen(storage_path() . '/' . $book->slug . '.html', 'wb');
            fwrite($file, $containedHtml);
            fclose($file);

            include (base_path() . '/app/Services/PdfConvertBook.php');

            return null;
        } else {
            $pdf = \PDF::loadHTML($containedHtml);

            return $pdf->output();
        }

        return null;
    }

    /**
     * Convert a page to a self-contained HTML file.
     * Includes required CSS & image content. Images are base64 encoded into the HTML.
     * @param Page $page
     * @return mixed|string
     */
    public function pageToContainedHtml(Page $page)
    {
        $cssContent = file_get_contents(public_path('/css/export-styles.css'));
        $pageHtml = view('pages/export', ['page' => $page, 'css' => $cssContent])->render();
        return $this->containHtml($pageHtml);
    }

    /**
     * Convert a book to a self-contained HTML file.
     * Includes required CSS & image content. Images are base64 encoded into the HTML.
     * @param Page $page
     * @return mixed|string
     */
    public function pageToContainedBookHtml(Page $page)
    {
        $cssContent = file_get_contents(public_path('/css/export-styles.css'));
        $pageHtml = view('pages/export-all', ['page' => $page, 'css' => $cssContent])->render();
        return $this->containHtml($pageHtml);
    }

    /**
     * Convert a page to a pdf file.
     * @param Page $page
     * @return mixed|string
     */
    public function pageToPdf(Page $page)
    {
        $cssContent = file_get_contents(public_path('/css/export-styles.css'));
        $pageHtml = view('pages/pdf', ['page' => $page, 'css' => $cssContent])->render();
        $containedHtml = $this->containHtml($pageHtml);
        $pdf = \PDF::loadHTML($containedHtml);
        return $pdf->output();
    }

    public function bookToPdf(Page $page)
    {
        $cssContent = file_get_contents(public_path('/css/export-styles.css'));
        $pageHtml = view('books/export-book-pdf', ['page' => $page, 'css' => $cssContent])->render();
        $containedHtml = $this->containHtml($pageHtml);
        $pdf = \PDF::loadHTML($containedHtml);
        return $pdf->output();
    }

    /**
     * Convert a book to a self-contained HTML file.
     * Includes required CSS & image content. Images are base64 encoded into the HTML.
     * @param Page $page
     * @return mixed|string
     */
    public function fromBookToHtml(Page $page)
    {
        $cssContent = file_get_contents(public_path('/css/export-styles.css'));
        $pageHtml = view('books/export-book', ['page' => $page, 'css' => $cssContent])->render();
        return $this->containHtml($pageHtml);
    }

    public function fromChapterToHtml(Page $page)
    {
        $cssContent = file_get_contents(public_path('/css/export-styles.css'));
        $pageHtml = view('chapters/export-chapter', ['page' => $page, 'css' => $cssContent])->render();
        return $this->containHtml($pageHtml);
    }

    public function fromChapterToPdf(Page $page)
    {
        $cssContent = file_get_contents(public_path('/css/export-styles.css'));
        $pageHtml = view('chapters/export-chapter-pdf', ['page' => $page, 'css' => $cssContent])->render();
        $containedHtml = $this->containHtml($pageHtml);
        $pdf = \PDF::loadHTML($containedHtml);
        return $pdf->output();
    }

    /**
     * Bundle of the contents of a html file to be self-contained.
     * @param $htmlContent
     * @return mixed|string
     */
    protected function containHtml($htmlContent)
    {
        $imageTagsOutput = [];
        preg_match_all("/\<img.*src\=(\'|\")(.*?)(\'|\").*?\>/i", $htmlContent, $imageTagsOutput);

        // Replace image src with base64 encoded image strings
        if (isset($imageTagsOutput[0]) && count($imageTagsOutput[0]) > 0) {
            foreach ($imageTagsOutput[0] as $index => $imgMatch) {
                $oldImgString = $imgMatch;
                $srcString = $imageTagsOutput[2][$index];
                if (strpos(trim($srcString), 'http') !== 0) {
                    $pathString = public_path($srcString);
                } else {
                    $pathString = $srcString;
                }
//                if (file_exists($pathString)) {
                    $imageContent = file_get_contents($pathString);
                    $imageEncoded = 'data:image/' . pathinfo($pathString, PATHINFO_EXTENSION) . ';base64,' . base64_encode($imageContent);
                    $newImageString = str_replace($srcString, $imageEncoded, $oldImgString);
                    $htmlContent = str_replace($oldImgString, $newImageString, $htmlContent);
//                }
            }
        }

        $linksOutput = [];
        preg_match_all("/\<a.*href\=(\'|\")(.*?)(\'|\").*?\>/i", $htmlContent, $linksOutput);

        // Replace image src with base64 encoded image strings
        if (isset($linksOutput[0]) && count($linksOutput[0]) > 0) {
            foreach ($linksOutput[0] as $index => $linkMatch) {
                $oldLinkString = $linkMatch;
                $srcString = $linksOutput[2][$index];
                if (strpos(trim($srcString), 'http') !== 0) {
                    $newSrcString = url($srcString);
                    $newLinkString = str_replace($srcString, $newSrcString, $oldLinkString);
                    $htmlContent = str_replace($oldLinkString, $newLinkString, $htmlContent);
                }
            }
        }

        // Replace any relative links with system domain
        return $htmlContent;
    }

    /**
     * Converts the page contents into simple plain text.
     * This method filters any bad looking content to
     * provide a nice final output.
     * @param Page $page
     * @return mixed
     */
    public function pageToPlainText(Page $page)
    {
        $text = $page->text;
        // Replace multiple spaces with single spaces
        $text = preg_replace('/\ {2,}/', ' ', $text);
        // Reduce multiple horrid whitespace characters.
        $text = preg_replace('/(\x0A|\xA0|\x0A|\r|\n){2,}/su', "\n\n", $text);
        $text = html_entity_decode($text);
        // Add title
        $text = $page->name . "\n\n" . $text;
        return $text;
    }

    /**
     * Convert a page to a pdf file.
     * @param Page $page
     * @return mixed|string
     */
    public function fromBookToPdf(Page $page)
    {
        $cssContent = file_get_contents(public_path('/css/export-styles.css'));
        $pageHtml = view('pages/pdf', ['page' => $page, 'css' => $cssContent])->render();
        $containedHtml = $this->containHtml($pageHtml);
        $pdf = \PDF::loadHTML($containedHtml);
        return $pdf->output();
    }
}

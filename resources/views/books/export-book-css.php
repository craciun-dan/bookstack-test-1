<?php
echo '<!-- START CUSTOMIZABLE CSS FOR EXPORT -->
<style>
h1, h2, h3, h4, h5 {
	margin: 10px;
	margin-bottom: 18px;
	padding: 0px;
}

h1 {
	font-weight: bold;
	margin-top: 30px;
}

h2 {
	margin-left: 12px;
	margin-top: 20px;
}

p {
	margin: 0px;
}

.export-page-content {
	margin: 0px;
	margin-left: 20px;
}

/* h[1-3] numbering */
body { counter-reset: h1; }

h1 {
	counter-reset: h2;
}

h2 {
	counter-reset: h3;
}

h3 { counter-reset: h4; }

h1:before {
	counter-increment: h1; content: counter(h1) ". "
}

h2:before {
	counter-increment: h2; content: counter(h1) "." counter(h2) ". "
}

h3:before {
	counter-increment: h3; content: counter(h1) "." counter(h2) "." counter(h3) ". "
}

/* amazing pagination (new h1 on a new page, generated pdf sees it) - http://stackoverflow.com/questions/3341485/how-to-make-a-html-page-in-a4-paper-size-pages */
@page {
   size: 7in 9.25in;
   margin: 27mm 16mm 27mm 16mm;
}

h1 {
	page-break-before: always;
}

h2 {
	page-break-before: always;
}
</style>
<!-- END CUSTOMIZABLE CSS FOR EXPORT -->'
?>

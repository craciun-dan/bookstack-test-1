<div class="page {{$page->draft ? 'draft' : ''}} entity-list-item" data-entity-type="page" data-entity-id="{{$page->id}}">

<?php
$indexChapter = 1;
$indexPage = 1;
$listPages = 0;

if (setting('display-indexes')) {

if (isset($book) && count($book->chapters) > 0) {
    foreach($book->chapters as $currentChapter) {
        if ($page->chapter) {
            if ($currentChapter->id == $page->chapter->id) {
                foreach($currentChapter->pages as $currentPage) {
                    if ($currentPage->id == $page->id) {
                        print '<a href="' . $page->getUrl() . '" class="text-page">' . '<i class="zmdi zmdi-file-text"></i>' . 
                        $indexChapter . "." . $indexPage . ". " . $page->name . "</a>";
                        $listPages = 1; // don't print it twice
                        break;
                    }
                    $indexPage++;
                }
            }
        }
        $indexChapter++;
    }
}

}

if ($listPages == 0) {
    print '<a href="' . $page->getUrl() . '" class="text-page">' . '<i class="zmdi zmdi-file-text"></i>' . $page->name . '</a>';
}
?>

<!--
    @if ($listPages == 0)
        <a href="{{ $page->getUrl() }}" class="text-page"><i class="zmdi zmdi-file-text"></i>{{ $page->name }}</a>
    @endif
-->
    @if(isset($page->searchSnippet))
        <p class="text-muted">{!! $page->searchSnippet !!}</p>
    @else
        <p class="text-muted">{{ $page->getExcerpt() }}</p>
    @endif

    @if(isset($style) && $style === 'detailed')
        <div class="row meta text-muted text-small">
            <div class="col-md-6">
                Created {{$page->created_at->diffForHumans()}} @if($page->createdBy)by {{$page->createdBy->name}}@endif <br>
                Last updated {{ $page->updated_at->diffForHumans() }} @if($page->updatedBy)by {{$page->updatedBy->name}} @endif
            </div>
            <div class="col-md-6">
                <a class="text-book" href="{{ $page->book->getUrl() }}"><i class="zmdi zmdi-book"></i>{{ $page->book->getShortName(30) }}</a>
                <br>
                @if($page->chapter)
                    <a class="text-chapter" href="{{ $page->chapter->getUrl() }}"><i class="zmdi zmdi-collection-bookmark"></i>{{ $page->chapter->getShortName(30) }}</a>
                @else
                    <i class="zmdi zmdi-collection-bookmark"></i> Page is not in a chapter
                @endif
            </div>
        </div>
    @endif


</div>

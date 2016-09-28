<div class="chapter entity-list-item" data-entity-type="chapter" data-entity-id="{{$chapter->id}}">
        @if (isset($showPath) && $showPath)
            <a href="{{ $chapter->book->getUrl() }}" class="text-book">
                <i class="zmdi zmdi-book"></i>{{ $chapter->book->name }}
            </a>
            <span class="text-muted">&nbsp;&nbsp;&raquo;&nbsp;&nbsp;</span>
        @endif
        <a href="{{ $chapter->getUrl() }}" class="text-chapter">
          <i class="zmdi zmdi-collection-bookmark"></i>
<?php
if (setting('display-indexes')) {
    $indexChapter = 1;
    foreach($chapter->book->chapters as $currentChapter) {
        if ($currentChapter->id == $chapter->id) {
            print '<h1 class="h1-chapter-list">';
            print $indexChapter. ". " . $chapter->name;
            print "</h1>";
        }
        $indexChapter++;
    }
} else {
    $indexChapter = 1;
    foreach($chapter->book->chapters as $currentChapter) {
        if ($currentChapter->id == $chapter->id) {
            print '<h1 class="h1-chapter-list">';
            print $chapter->name;
            print "</h1>";
        }
        $indexChapter++;
    }
}
?>
        </a>
    @if(isset($chapter->searchSnippet))
        <p class="text-muted">{!! $chapter->searchSnippet !!}</p>
    @else
        <p class="text-muted">{{ $chapter->getExcerpt() }}</p>
    @endif

    @if(!isset($hidePages) && count($chapter->pages) > 0)
<!--        <p class="text-muted chapter-toggle"><i class="zmdi zmdi-caret-right"></i> <i class="zmdi zmdi-file-text"></i> <span>{{ count($chapter->pages) }} Pages</span></p> -->
<!--        <div class="inset-list"> -->

            <?php
                $totalChapters = count($chapter->book->chapters);
                $indexChapter = 1;
                foreach($chapter->book->chapters as $currentChapter) {
                    if ($currentChapter->id == $chapter->id) {
                        $indexPage = 1;
                        foreach($currentChapter->pages as $currentPage) {
                            if (setting('display-indexes')) {
                                print '<h2 class="h2-page-list"><a href="' . $currentPage->getUrl() . '" class="text-page"><i class="zmdi zmdi-file-text"></i>' . $indexChapter . "." . $indexPage . ". " . $currentPage->name . '</h2></a>';
                            } else {
                                print '<h2 class="h2-page-list"><a href="' . $currentPage->getUrl() . '" class="text-page"><i class="zmdi zmdi-file-text"></i>' . $currentPage->name . '</h2>';
                            }
                            $indexPage++;
                        }
                        break;
                    }
                    $indexChapter++;
                }
            ?>

<?php
/*
            @foreach($chapter->pages as $page)
                <h2 style="font-size: 100%;" class="@if($page->draft) draft @endif">
                    <a href="{{$page->getUrl()}}" class="text-page @if($page->draft) draft @endif"><i class="zmdi zmdi-file-text"></i>{{$page->name}}</a>
                </h2>
            @endforeach
*/
?>
<!--        </div> -->
    @endif
</div>

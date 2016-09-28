<div ng-non-bindable>

    <h1 id="bkmrk-page-title" class="float left">{{$chapter->name}}</h1>

    @if(count($chapter->pages) > 0)
        <div class="tag-display float right">
            <div class="heading primary-background-light">Page Tags</div>
            <table>
                @foreach($chapter->pages as $currentPage)
                    {{ $currentPage->html }}
                @endforeach
            </table>
        </div>
    @endif

    <div style="clear:left;"></div>

</div>

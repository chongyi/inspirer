<!-- 左边栏 -->
<div class="am-u-md-4">
    @if(isset($beforeColumn))
        @foreach($beforeColumn as $newColumn)
            @include($newColumn)
        @endforeach
    @endif
    <div class="insp-d-column">
        <div class="insp-d-header">
            <div class="insp-d-title">分类</div>
        </div>
        <div class="insp-d-body">
            <ul class="insp-d-column-list insp-d-column-list-inline">
                @forelse($categories as $category)
                    <li><a title="{{ $category->display_name }}" href="@if(!empty($category->name)){{ url('category', $category->name) }}@else{{ url('category', $category->id) }}@endif">{{ $category->display_name }}</a> <span class="am-badge am-round">{{ $category->articles->count() }}</span></li>
                @empty
                @endforelse
            </ul>
        </div>
    </div>
    <div class="insp-d-column">
        <div class="insp-d-header">
            <div class="insp-d-title">标签</div>
        </div>
        <div class="insp-d-body">
            <ul class="insp-d-column-list insp-d-column-list-inline">
                @forelse($tags as $tag)
                    <li><a title="{{ $tag->display_name }}" href="@if(!empty($tag->name)){{ url('tag', $tag->name) }}@else{{ url('tag', $tag->id) }}@endif">{{ $tag->display_name }}</a> <span class="am-badge am-round">{{ $tag->articles->count() }}</span></li>
                @empty
                @endforelse
            </ul>
        </div>
    </div>
    <div class="insp-d-column">
        <div class="insp-d-header">
            <div class="insp-d-title">归档</div>
        </div>
        <div class="insp-d-body">
            <ul class="insp-d-column-list">
                @foreach($archive as $dateMark)
                <li><a href="{{ route('show-archive-article-list', sscanf($dateMark->archive, "%d %d")) }}">{{ vsprintf("%s年%s月", sscanf($dateMark->archive, "%s %s")) }}</a> <span class="am-badge am-round">{{ $dateMark->count }}</span></li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="insp-d-column">
        <div class="insp-d-header">
            <div class="insp-d-title">友情链接</div>
        </div>
        <div class="insp-d-body">
            <ul class="insp-d-column-list insp-d-column-list-inline">
                <li><a target="_blank" href="https://wujunze.com/" title="吴钧泽博客">吴钧泽博客</a></li>
                <li><a target="_blank" href="http://laravelacademy.org/" title="laravel 学院">laravel 学院</a></li>
                <li><a target="_blank" href="http://www.biner.me/" title="宾呐·之谜">宾呐·之谜</a></li>
                <li><a target="_blank" href="http://www.nowamagic.net/" title="现代简明魔法">现代简明魔法</a></li>
                <li><a target="_blank" href="https://www.phphub.org" title="PHPHub 社区">PHPHub 社区</a></li>
                <li><a target="_blank" href="https://www.tanteng.me" title="Tanteng.me">Tanteng.me</a></li>
                <li><a target="_blank" href="http://www.gouguoyin.cn/" title="够过瘾">够过瘾</a></li>
                <li><a target="_blank" href="https://aicode.cc/" title="aicode">aicode</a></li>
            </ul>
        </div>
    </div>
</div>

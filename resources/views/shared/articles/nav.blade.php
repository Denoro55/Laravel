<div class="links">
    <a class="{{ (\Request::route()->getName() == 'articles.index') ? 'active' : '' }}" href="{{route('articles.index')}}">All</a>
    <a class="{{ (\Request::route()->getName() == 'articles.create') ? 'active' : '' }}" href="{{route('articles.create')}}">New</a>
</div>
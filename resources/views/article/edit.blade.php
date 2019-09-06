@extends('layouts.app')

@section('title', 'Create Article')

@section('nav')
    @include('shared.articles.nav')
@endsection

@section('content')
<div class="article-new">
    <div class="article-new__form">
        {{ Form::model($article, ['url' => route('articles.update', ['article' => $article->id]), 'method' => 'PATCH', 'class' => 'form']) }}
            @include('shared.articles.form')
            <div class="form__block">
                {{Form::submit('Update')}}
            </div>
        {{Form::close()}}
    </div>
    <div class="article-new__errors">
    </div>
</div>
@endsection
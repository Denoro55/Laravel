@extends('layouts.app')

@section('title', 'Article Info')

@section('nav')
    @include('shared.articles.nav')
@endsection

@section('content')

<div>
    <h5>{{$article->name}}</h5>
    <p>{{$article->body}}</p>
</div>

@endsection
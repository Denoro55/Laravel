@extends('layouts.app')

@section('title', 'Articles')

@section('nav')
    @include('shared.articles.nav')
@endsection

@section('header')

@endsection

@section('content')

    @if($flash)
    <div class="flash">
        <div class="alert alert-success" role="alert">
            {{$flash}}
        </div>
    </div>
    @endif
    <div class="articles">
        <table class="articles__table">
            <thead>
                <tr>
                    <td>
                        id
                    </td>
                    <td>
                        name
                    </td>
                    <td>
                        body
                    </td>
                    <td>
                        actions
                    </td>
                </tr>
            </thead>
            <tbody>
                @foreach($articles as $article)
                    <tr>
                        <td>{{$article->id}}</td>
                        <td><a href="{{route('articles.show', ['article'=>$article->id])}}">{{$article->name}}</a></td>
                        <td>{{$article->body}}</td>
                        <td>
                            <a data-confirm="Вы уверены?" data-method="delete" rel="nofollow" href="{{route('articles.destroy', ['article' => $article->id])}}" class="btn btn-danger">Delete</a>
                            <a href="{{route('articles.edit', ['article' => $article->id])}}" class="btn btn-success">Update</div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{$articles->links()}}
    </div>
@endsection
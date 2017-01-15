@extends('layout')
@section('title')
{{$article->title}}
@stop

@section('description')
{{$article->content}}
@stop

@section('content')
  <div class="row center-xs echo-article">
    <div class="col-xs-9">
      <header>
        <h1 class="echo-article__title">{{$article->title}}</h1>
      </header>
      <h2 class="echo-article__summary">
        {{$article->description}}
      </h2>
      <p class="echo-article__date">{{$article->created_at}}</p>

      <div class="article__content">
        {!!$article->content!!}
      </div>
      <div class="echo-article__publisher mbottom">
        Publié par le Cabinet Schmidt
      </div>
    </div>
  </div>
@stop

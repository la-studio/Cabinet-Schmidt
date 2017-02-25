@extends('layout')
@section('title')
{{$article->title}}
@stop

@section('description')
  @if(strlen($article->description) > 0)
    {{ $article->description }}
  @else
    {{ strip_tags($article->content) }}
  @endif
@stop

@section('content')
  <div class="row center-xs echo-article">
    <div class="cover" style="background-image: url({{$article->image}})">
    </div>
    <div class="col-xs-9">
      <header>
        <p class="previousPage"><a href="/actualites-cabinet">Retour aux actualités</a></p>
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

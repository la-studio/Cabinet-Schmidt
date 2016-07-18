@extends('layout')
@section('title')
{{$compacted_article->title}}
@stop

@section('description')
{{$compacted_article->summary}}
@stop

@section('robots')
<meta name="robots" content="noindex">
@stop

@section('content')
  <div class="row center-xs echo-article">
    <div class="col-xs-9">
      <header>
        <h1 class="echo-article__title">{{$compacted_article->title}}</h1>
        <h2 class="echo-article__summary">{{$compacted_article->summary}}</h2>
      </header>
      <p class="echo-article__date">{{$compacted_article->created_at}}</p>
      <div class="echo-article__content">
        {{$compacted_article->content}}
      </div>
      @if(count($compacted_article->table_html)>0)
      <div class="echo-article__table">{{$compacted_article->table_html}}</div>
      @endif
      <div class="echo-article__author">
        {{$compacted_article->auteur}}
      </div>
      <div class="echo-article__publisher">
        Publié par les Echos Publishing
      </div>
      @if(count($compacted_article->references)>0)
      <nav class="row start-xs echo-article__links">
        <h3>Liens de référence : </h3>
        @foreach ($compacted_article->references as $link)
          <span><a href="{{$link->link}}">{{$link->label}}</a></span>
        @endforeach
      </nav>
      @endif
      <div class="row center-xs echo-article__suggestions">
        <h3 class="col-xs-12">D'autres articles des Echos Publishing</h3>
        @foreach($result as $suggestion)
        <div class="col-md col-sm-6 col-xs-12 suggestion">
          <div class="row wrapper">
            <span class="col-xs-12 suggestion__cover"><a href="/chiffres-utiles/{{$suggestion->slug}}" rel="nofollow" style="background-image:url('{{$suggestion->image}}')"></a></span>
            <a href="/chiffres-utiles/{{$suggestion->slug}}" class="col-xs-12 suggestion__caption" rel="nofollow">{{$suggestion->title}}</a>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
@stop

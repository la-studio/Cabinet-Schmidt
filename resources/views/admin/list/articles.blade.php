@extends('admin.dashboard-layout')
@section('content')
<div class="row center-xs articles-list">
  @foreach ($articles as $article)
    <div class="col-sm-6 article">
      <div class="row center-xs middle-xs wrapper">
        <div class="col-xs">
          <p class="article__title">Titre : {{$article->title}}</p>
          <p class="article__content">Contenu : {{$article->description}}</p>
        </div>
      </div>
      <form class="row center-xs article__form" action="/admin/article/delete/{{$article->id}}" method="post">
        {{ method_field('DELETE') }}
        {{csrf_field()}}
        <a class="edit" href="/admin/article/edit/{{$article->id}}"><span>Éditer</span></a>
        <input type="submit" class="delete" value="Supprimer"/>
      </form>
    </div>
  @endforeach
</div>
  <a href="/admin/article/create" class="row center-xs article-add"><span>Ajouter un article</span></a>
@stop

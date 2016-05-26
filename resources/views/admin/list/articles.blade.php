@extends('admin.dashboard-layout')
@section('content')
<div class="row center-xs articles-list">
  @foreach ($articles as $article)
    <div class="col-sm-6 article">
      <div class="row center-xs middle-xs rowfix wrapper">
        <div class="col-xs">
          <p>{{$article->title}}</p>
          <p>{{$article->content}}</p>
          <form action="/admin/article/delete/{{$article->id}}" method="post">
            {{ method_field('DELETE') }}
            {{csrf_field()}}
            <button type="submit" name="button">Delete</button>
          </form>
          <a href="/admin/article/edit/{{$article->id}}"><span>Edit</span></a>
        </div>
      </div>
    </div>
  @endforeach
  <a href="/admin/article/create" class="article-add"><span>Ajouter un article</span></a>
</div>
@stop

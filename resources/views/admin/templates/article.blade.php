@extends('admin.dashboard-layout')
@section('content')
  <div class="row center-xs article">
    <div class="col-xs">
      <form class="row center-xs" method="post" action="/admin/article/update/{{$article->id}}">
        {{ method_field('PATCH') }}
        {{csrf_field()}}
        <div class="row center-xs">
          <input type="text" name="title" value="{{$article->title}}">
        </div>
        <div class="row center-xs">
          <input type="text" name="content" value="{{$article->content}}">
        </div>
        <button type="submit" name="button">Enregistrer</button>
      </form>
    </div>
  </div>
@stop

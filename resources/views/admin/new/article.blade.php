@extends('admin.dashboard-layout')
@section('content')
  <div class="article-create">
    <form class="row center-xs" action="/admin/article/store" method="post">
      {{csrf_field()}}
      <div class="col-xs">
        <div class="article-create__field">
          <input type="text" name="title" placeholder="Title de l'article"/>
        </div>
        <div class="article-create__field">
          <textarea type="text" name="content" placeholder="Contenu de l'article"></textarea>
        </div>
        <button type="submit" role="button">Enregistrer</button>
      </div>
    </form>
  </div>
@stop

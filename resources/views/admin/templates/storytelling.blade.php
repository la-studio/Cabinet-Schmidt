@extends('admin.dashboard-layout')
@section('content')
  <div class="row story">
    <div class="col-xs">
      <div class="row center-xs story__cover" style="background-image: url('{{$slide->cover}}')"></div>
      <form class="row center-xs story__form" method="post" enctype="multipart/form-data" accept-charset="UTF-8" action="/admin/storytelling/update/{{$slide->id}}">
        <div class="col-xs">
          {{ method_field('PUT') }}
          {{csrf_field()}}
          <div class="row center-xs story__field">
            <div class="col-md-8 col-sm-10 col-xs-12">
              <span>Changer de couverture</span>
              <input type="file" class="file-input" name="photo"/>
            </div>
          </div>
          <div class="row center-xs story__field">
            <div class="col-md-8 col-sm-10 col-xs-12">
              <span>Changer de titre</span>
              <input type="text" name="title" value="{{$slide->title}}"/>
            </div>
          </div>
          <div class="row center-xs story__field">
            <div class="col-md-8 col-sm-10 col-xs-12">
              <span>Changer le résumé</span>
              {{-- <input type="text" name="summary" value="{{$slide->summary}}"/> --}}
              <textarea name="summary">{{$slide->summary}}</textarea>
            </div>
          </div>
          <div class="row center-xs story__field">
            <input type="text" class="to_add"/>
            <span class="add">Ajouter</span>
          </div>
          <ul class="row list">
            @foreach ($slide->list_item as $item)
            <li class="list__item"><span>{{$item->name}}</span><span class="delete"><i class="material-icons">clear</i></span></li>
            @endforeach
          </ul>
          @foreach ($slide->list_item as $item)
          <input type="hidden" name="item[]" value="{{$item->name}}">
          @endforeach
          <input type="submit" class="story__save" value="Enregistrer">
        </div>
      </form>
    </div>
  </div>
@stop

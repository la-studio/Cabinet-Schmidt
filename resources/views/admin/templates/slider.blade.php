@extends('admin.dashboard-layout')
@section('content')
  <div class="row slide">
    <div class="col-xs">
      <div class="row center-xs slide__cover" style="background-image: url('{{$slide->cover}}')"></div>
      <form class="row center-xs slide__form" method="post" enctype="multipart/form-data" accept-charset="UTF-8" action="/admin/slider/update/{{$slide->id}}">
        <div class="col-xs">
          {{ method_field('PATCH') }}
          {{csrf_field()}}
          <label class="row center-xs">
          Changer de photo
            <input type="file" name="photo"/>
          </label>
          <label class="row center-xs">
          Changer le titre
            <input type="text" name="title" value="{{$slide->title}}"/>
          </label>
          <label class="row center-xs">
          Changer le nom du bouton
            <input type="text" name="title" value="{{$slide->button_name}}"/>
          </label>
          <label class="row center-xs">
          Changer le lien du bouton (mettre une ancre ou bien l'url suivant le nom de domaine)
            <input type="text" name="title" value="{{$slide->button_name}}"/>
          </label>
          <label class="row center-xs">
          Changer la description
            <textarea type="text" name="description">{{$slide->description}}</textarea>
          </label>
          <button type="submit" name="button">Enregistrer</button>
        </div>
      </form>
    </div>
  </div>
@stop

@extends('admin.dashboard-layout')
@section('content')
  <div class="row slide">
    <div class="col-xs">
      <div class="row center-xs slide__cover" style="background-image: url('{{$slide->cover}}')"></div>
      <form class="row center-xs slide__form" method="post" enctype="multipart/form-data" accept-charset="UTF-8" action="/admin/slider/update/{{$slide->id}}">
        <div class="col-xs">
          {{ method_field('PATCH') }}
          {{csrf_field()}}
          <div class="row center-xs slide__field">
            <div class="col-md-8 col-sm-10 col-xs-12">
              <span>Changer de couverture</span>
              <input type="file" class="file-input" name="photo"/>
            </div>
          </div>
          <div class="row center-xs slide__field">
            <div class="col-md-8 col-sm-10 col-xs-12">
              <span>Changer de titre</span>
              <input type="text" name="title" value="{{$slide->title}}"/>
            </div>
          </div>
          <div class="row center-xs slide__field">
            <div class="col-md-8 col-sm-10 col-xs-12">
              <span>Changer le nom du bouton</span>
              <input type="text" name="title" value="{{$slide->button_name}}"/>
            </div>
          </div>
          <div class="row center-xs slide__field">
            <div class="col-md-8 col-sm-10 col-xs-12">
              <span>Changer le lien du bouton</span>
              <input type="text" name="title" value="{{$slide->button_link}}"/>
            </div>
          </div>
          <div class="row center-xs slide__field">
            <div class="col-md-8 col-sm-10 col-xs-12">
              <span>Changer la description</span>
              <input type="text" name="title" value="{{$slide->description}}"/>
            </div>
          </div>
          <input type="submit" class="competence__save" value="Enregistrer"/>
        </div>
      </form>
    </div>
  </div>
@stop

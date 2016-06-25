@extends('admin.dashboard-layout')
@section('content')
  <div class="row partenaire">
    <div class="col-xs">
      <div class="row center-xs partenaire__logo">
        <img src="{{$partenaire->logo}}" alt>
      </div>
      <form class="row center-xs" method="post" enctype="multipart/form-data" accept-charset="UTF-8" action="/admin/partenaire/update/{{$partenaire->id}}">
        {{ method_field('PATCH') }}
        {{csrf_field()}}
        <div class="col-xs">
          <div class="row center-xs partenaire__field">
            <div class="col-md-8 col-sm-10 col-xs-12">
              <span>Changer le logo du partenaire</span>
              <input type="file" name="photo"/>
            </div>
          </div>
          <div class="row center-xs partenaire__field">
            <div class="col-md-8 col-sm-10 col-xs-12">
              <span>Changer le nom du partenaire</span>
              <input type="text" name="name" value="{{$partenaire->name}}"/>
            </div>
          </div>
          <div class="row center-xs partenaire__field">
            <div class="col-md-8 col-sm-10 col-xs-12">
              <span>Changer le lien du partenaire</span>
              <input type="text" name="link" value="{{$partenaire->link}}"/>
            </div>
          </div>
          <div class="row center-xs partenaire__field">
            <div class="col-md-8 col-sm-10 col-xs-12">
              <span>Changer la description du partenaire</span>
              <textarea name="description">{{$partenaire->description}}</textarea>
            </div>
          </div>
          <div class="row center-xs partenaire__field">
            <div class="col-md-8 col-sm-10 col-xs-12">
              <span>Afficher sur la page Liens utiles</span>
              <input type="checkbox" name="enabled" @if($partenaire->enabled==1)checked @endif/>
            </div>
          </div>
          <input type="submit" class="partenaire__save" value="Enregistrer"/>
        </div>
      </form>
    </div>
  </div>
@stop

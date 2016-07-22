@extends('admin.dashboard-layout')
@section('content')
  <div class="row center-xs middle-xs competence">
    <div class="col-xs">
      <form class="row center-xs" method="post" action="/admin/competence/update/{{$competence->id}}">
        {{ method_field('PATCH') }}
        {{csrf_field()}}
        <div class="col-xs">
          <div class="row center-xs partenaire__field">
            <div class="col-md-8 col-sm-10 col-xs-12">
              <span>Compétence</span>
              <input class="large-field" type="text" name="title" value="{{$competence->title}}">
            </div>
          </div>
          <div class="row center-xs partenaire__field">
            <div class="col-md-8 col-sm-10 col-xs-12">
              <span>Slogan</span>
              <input class="large-field" type="text" name="label" value="{{$competence->label}}">
            </div>
          </div>
          <div class="row center-xs partenaire__field">
            <div class="col-md-8 col-sm-10 col-xs-12">
              <span>Description</span>
              <textarea id="cabinet-article" class="large-field text-field" name="description">{{$competence->description}}</textarea>
            </div>
          </div>
          <div class="row center-xs slide__field">
            <div class="col-md-8 col-sm-10 col-xs-12">
              <span></span>
              <div class="count">255 caratères restants</div>
            </div>
          </div>
          <input type="submit" class="competence__save" value="Enregistrer">
        </div>
      </form>
    </div>
  </div>
@stop

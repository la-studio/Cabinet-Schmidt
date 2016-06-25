@extends('admin.dashboard-layout')
@section('content')
  <div class="row center-xs temoignage">
    <div class="col-xs">
      <div class="row center-xs temoignage__logo">
        <img src="{{$temoignage->logo}}" alt="" />
      </div>
      <form class="row center-xs" method="post" enctype="multipart/form-data" accept-charset="UTF-8" action="/admin/temoignage/update/{{$temoignage->id}}">
        {{ method_field('PATCH') }}
        {{csrf_field()}}
        <div class="col-xs">
          <div class="row center-xs temoignage__field">
            <div class="col-md-8 col-sm-10 col-xs-12">
              <span>Changer le logo</span>
              <input type="file" name="photo" value="Changer de photo"/>
            </div>
          </div>
          <div class="row center-xs temoignage__field">
            <div class="col-md-8 col-sm-10 col-xs-12">
              <span>Changer le témoignage</span>
              <input type="text" name="content" value="{{$temoignage->content}}">
            </div>
          </div>
          <div class="row center-xs temoignage__field">
            <div class="col-md-8 col-sm-10 col-xs-12">
              <span>Changer le métier du témoin</span>
              <input type="text" name="person_job" value="{{$temoignage->person_job}}">
            </div>
          </div>
          <div class="row center-xs temoignage__field">
            <div class="col-md-8 col-sm-10 col-xs-12">
              <span>Changer l'identité du témoin</span>
              <input type="text" name="person_identity" value="{{$temoignage->person_identity}}">
            </div>
          </div>
          <input type="submit" class="temoignage__save" value="Enregistrer">
        </div>
      </form>
    </div>
  </div>
@stop

@extends('admin.dashboard-layout')
@section('content')
  <div class="row center-xs temoignage">
    <div class="col-xs">
      <form class="row center-xs" method="post" enctype="multipart/form-data" accept-charset="UTF-8" action="/admin/temoignage/update/{{$temoignage->id}}">
        {{ method_field('PATCH') }}
        {{csrf_field()}}
        <div class="col-xs">
          <div class="row center-xs">
            <img src="{{$temoignage->logo}}" alt="" />
          </div>
          <div class="row center-xs">
            <input type="file" name="photo" value="Changer de photo"/>
          </div>
          <div class="row center-xs">
            <input type="text" name="content" value="{{$temoignage->content}}">
          </div>
          <div class="row center-xs">
            <input type="text" name="content" value="{{$temoignage->person_job}}">
          </div>
          <div class="row center-xs">
            <input type="text" name="content" value="{{$temoignage->person_identity}}">
          </div>
          <button type="submit" name="button">Enregistrer</button>
        </div>
      </form>
    </div>
  </div>
@stop

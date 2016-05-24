@extends('admin.dashboard-layout')
@section('content')
  <div class="row partenaire">
    <div class="col-xs">
      <div class="row center-xs">
        <img src="{{$partenaire->logo}}" alt>
      </div>
      <form class="row center-xs" method="post" enctype="multipart/form-data" accept-charset="UTF-8" action="/admin/partenaire/update/{{$partenaire->id}}">
        {{ method_field('PATCH') }}
        {{csrf_field()}}
        <label>
        Changer de photo
        <input type="file" name="photo"/>
        </label>
        <button type="submit" name="button">Enregistrer</button>
      </form>
    </div>
  </div>
@stop

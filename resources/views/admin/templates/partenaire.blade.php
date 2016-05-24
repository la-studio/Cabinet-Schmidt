@extends('admin.dashboard-layout')
@section('content')
  <div class="row partenaire">
    <div class="col-xs">
      <div class="row center-xs">
        <img src="{{$partenaire->logo}}" alt>
      </div>
      <div class="row center-xs">
        <label>
        Changer de photo
        <input type="file" name="photo"/>
        </label>
      </div>
    </div>
  </div>
@stop

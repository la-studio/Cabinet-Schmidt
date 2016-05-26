@extends('admin.dashboard-layout')
@section('content')
  <div class="row center-xs competence">
    <div class="col-xs">
      <form class="row center-xs" method="post" action="/admin/competence/update/{{$competence->id}}">
        {{ method_field('PATCH') }}
        {{csrf_field()}}
        <div class="col-xs">
          <div class="row middle-xs center-xs">
            <span>Titre</span>
            <input type="text" name="title" value="{{$competence->title}}">
          </div>
          <div class="row middle-xs center-xs">
            <span>Slogan</span>
            <textarea name="label">{{$competence->label}}</textarea>
          </div>
          <div class="row middle-xs center-xs">
            <span>Description</span>
            <textarea name="description">{{$competence->description}}</textarea>
          </div>
          <button type="submit" name="button">Enregistrer</button>
        </div>
      </form>
    </div>
  </div>
@stop

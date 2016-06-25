@extends('admin.dashboard-layout')
@section('content')

  <div class="row competences-list">
  @foreach ($competences as $competence)
    <div class="col-sm-6 competences-item">
      <div class="row center-xs middle-xs wrapper">
        <div class="col-xs">
          <p class="title">{{$competence->title}}</p>
          <p class="description">{{$competence->description}}</p>
          <a href="/admin/competence/edit/{{$competence->id}}">
            <i class="material-icons">create</i>
            <span>Éditer</span>
          </a>
        </div>
      </div>
    </div>
  @endforeach
  </div>
@stop

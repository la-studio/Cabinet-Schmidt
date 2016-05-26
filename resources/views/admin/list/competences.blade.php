@extends('admin.dashboard-layout')
@section('content')
  @foreach ($competences as $competence)
    <div class="col-sm-6 competence-list">
      <div class="row center-xs middle-xs wrapper">
        <div class="col-xs">
          <p>{{$competence->title}}</p>
          <p>{{$competence->description}}</p>
          <a href="/admin/competence/edit/{{$competence->id}}"><span>Edit</span></a>
        </div>
      </div>
    </div>
  @endforeach
@stop

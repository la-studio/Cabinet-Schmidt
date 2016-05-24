@extends('admin.dashboard-layout')
@section('content')
<div class="rowfix row temoignages-list">
  <div class="col-xs">
    @foreach ($temoignages as $temoignage)
      <div class="row">
        <div class="col-xs">
          <div class="row">
            <span>{{$temoignage->title}}</span>
          </div>
          <div class="row">
            <span>{{$temoignage->content}}</span>
          </div>
          <div class="row">
            <span>{{$temoignage->person_identity}}</span>
          </div>
          <div class="row">
            <span>{{$temoignage->person_job}}</span>
          </div>
          <form class="row" action="/admin/temoignage/delete/{{$temoignage->id}}" method="post">
            {{ method_field('DELETE') }}
            {{csrf_field()}}
            <button type="submit" name="button">Delete</button>
          </form>
          <a href="/admin/temoignage/edit/{{$temoignage->id}}"><span>Edit</span></a>
        </div>
      </div>
    @endforeach
  </div>
</div>
@stop

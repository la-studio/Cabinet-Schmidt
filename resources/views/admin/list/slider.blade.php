@extends('admin.dashboard-layout')
@section('content')
<div class="rowfix row slider-list">
  <div class="col-xs">
  @foreach ($slider as $slide)
    <div class="row slide">
      <h2 class="col-xs-12">
        Slide {{$slide->index}}
      </h2>
      <div class="col-md-6 col-xs-12 slide__bg" style="background-image:url('{{$slide->cover}}')"></div>
      <div class="col-md-6 col-xs-12">
        <div class="row">
          <span>{{$slide->title}}</span>
        </div>
        <div class="row">
          <p>{{$slide->description}}</p>
        </div>
        <div class="row">
          <p>{{$slide->button_link}}</p>
        </div>
        <div class="row">
          <p>{{$slide->button_name}}</p>
        </div>
      </div>
    </div>
  @endforeach
  </div>
</div>
@stop

@extends('admin.dashboard-layout')
@section('content')
<div class="rowfix row slider-list">
  <div class="col-xs">
  @foreach ($slider as $slide)
    <div class="row slide">
      <div class="col-xs">
        <div class="row middle-xs slide__header">
          <h2>Slide {{$slide->index}}</h2>
          <span><a href="/admin/slide/edit/{{$slide->id}}"><i class="material-icons">create</i></a></span></a>
        </div>
        <div class="row slide__content">
          <a href="/admin/slide/edit/{{$slide->id}}" class="col-md-6 col-xs-12 slide__bg" style="background-image:url('{{$slide->cover}}')"></a>
          <div class="col-md-6 col-xs-12 properties">
            <div class="row properties__title">
              <span>{{$slide->title}}</span>
            </div>
            <div class="row properties__description">
              <p>{{$slide->description}}</p>
            </div>
            <div class="row properties__link-target">
              @if($slide->button_link!=='' && $slide->button_link!==null)
              <p>Le lien/L'ancre du bouton est : {{$slide->button_link}}</p>
              @else
                <p>Ce bouton n'a pas de lien. Il n'est donc pas visible sur le slider</p>
              @endif
            </div>
            <div class="row properties__button-name">
              <p>Le texte du bouton est : {{$slide->button_name}}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endforeach
  </div>
</div>
@stop

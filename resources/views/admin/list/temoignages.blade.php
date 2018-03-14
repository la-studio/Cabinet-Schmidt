@extends('admin.dashboard-layout')
@section('content')
<div class="row temoignages-list">
  @foreach ($temoignages as $temoignage)
    <div class="col-sm-6 col-xs-12 temoignage">
      <div class="row center-xs temoignage__image">
        <img src="{{$temoignage->logo}}" alt="" />
      </div>
      <div class="row center-xs" style="margin-top: 5px">
        <strong><span>{{$temoignage->person_identity}}</span></strong>
      </div>
      <div class="row center-xs temoignage__job" style="margin-bottom: 5px">
        <span>{{$temoignage->person_job}}</span>
      </div>
      <div class="row center-xs temoignage__content">
        <span>{{$temoignage->description}}</span>
      </div>
      <form class="row center-xs temoignage__form" action="/admin/temoignage/delete/{{$temoignage->id}}" method="post">
        {{ method_field('DELETE') }}
        {{csrf_field()}}
        <a class="edit" href="/admin/temoignage/edit/{{$temoignage->id}}"><span>Éditer</span></a>
        <input type="submit" class="delete" value="Supprimer">
      </form>
    </div>
  @endforeach
</div>
<a href="/admin/temoignage/create" class="row center-xs article-add"><span>Ajouter un témoignage</span></a>
@stop

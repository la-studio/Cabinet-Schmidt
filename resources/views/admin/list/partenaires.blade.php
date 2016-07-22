@extends('admin.dashboard-layout')
@section('content')
<div class="rowfix row partenaires-list">
  @foreach ($partenaires as $partenaire)
    <div href="/admin/partenaire/{{$partenaire->id}}" class="col-sm-6 article">
      <div class="row center-xs middle-xs rowfix wrapper">
        <div class="col-xs">
          <div class=""><img src="{{$partenaire->logo}}" alt></div>
          <p>{{$partenaire->description}}</p>
          <div class="row center-xs">
            <form class="delete-form" action="/admin/partenaire/delete/{{$partenaire->id}}" method="post">
              {{ method_field('DELETE')}}
              {{csrf_field()}}
              <a class="article__edit" href="/admin/partenaire/edit/{{$partenaire->id}}"><span>Éditer</span></a>
              <input type="submit" class="delete" value="Supprimer"/>
            </form>
          </div>
        </div>
      </div>
    </div>
  @endforeach
  <div class="col-xs-12 partenaire-add">
    <a href="/admin/partenaire/create"><span>Ajouter un partenaire</span></a>
  </div>
</div>
@stop

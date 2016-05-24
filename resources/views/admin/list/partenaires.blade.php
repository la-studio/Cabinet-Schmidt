@extends('admin.dashboard-layout')
@section('content')
<div class="rowfix row partenaires-list">
  @foreach ($partenaires as $partenaire)
    <div href="/admin/partenaire/{{$partenaire->id}}" class="col-sm-6 article">
      <div class="row center-xs middle-xs rowfix wrapper">
        <div class="col-xs">
          <img src="{{$partenaire->logo}}" alt>
          <form action="/admin/partenaire/delete/{{$partenaire->id}}" method="post">
            {{ method_field('DELETE') }}
            {{csrf_field()}}
            <button type="submit" name="button">Delete</button>
          </form>
          <a href="/admin/partenaire/edit/{{$partenaire->id}}"><span>Edit</span></a>
        </div>
      </div>
    </div>
  @endforeach
  <div class="col-xs-12 partenaire-add">
    <a href="/admin/partenaire/create"><span>Ajouter un partenaire</span></a>
  </div>
</div>
@stop

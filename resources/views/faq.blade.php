@extends('layout')
@section('title')
La FAQ des entrepreneurs
@stop

@section('description')
Question de la vie quotidienne ou problématiques d’entrepreneurs, recherchez les informations dont vous avez besoin : fiscal, patrimoine, juridique, social…
@stop

@section('content')
  <div class="row faq">
    <div class="col-xs">
      <div class="row center-xs search">
        <div class="col-xs-8">
          <div class="title">
            <h1>Trouvez la réponse à vos questions : déduction fiscale, impôts, salariat, immobilier, droits des sociétés, déclarations…</h1>
          </div>
          <div class="row between-xs search__head">
            <span class="search__label">Sélectionnez une rubrique</span>
            <span class="search__reload"><i class="material-icons">settings_backup_restore</i></span>
          </div>
          <div class="row search__bar">
            <div class="col-xs-12 search__current"></div>
            <div class="col-xs-12 search__progress"><div class="fill"></div></div>
            <ul class="col-xs-12 search__select">
              @foreach($request as $option)
                <li data-content="{{$option}}" class="option">{{$option}}</li>
              @endforeach
            </ul>
            <span class="col-xs search__next"><i class="material-icons">arrow_forward</i></span>
          </div>
        </div>
      </div>
      <div class="row center-xs list"></div>
      <div class="row center-xs buttons">
        <span class="buttons__full">Voir les autres résultats</span>
        <span class="buttons__search">Faire une nouvelle recherche</span>
      </div>
    </div>
  </div>
  <span class="loader"></span>
@stop

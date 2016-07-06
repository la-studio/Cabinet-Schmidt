@extends('layout')
@section('title')
Votre cabinet d’expertise comptable à Crolles
@stop

@section('description')
Cabinet d’expertise comptable à Crolles, entre Grenoble et Chambéry qui vous accompagne dans la création d’entreprise, la comptabilité, la tenue des comptes…
@stop

@section('content')
  <div class="row home"> {{-- children have col-xs-12 markup on their global wrapper. --}}
    @include('home.slider')
    @include('home.contact')
    @include('home.actus')
    @include('home.services')
    @if($temoignagesLen>0)
      @include('home.temoignages')
    @endif
    @if(count($count))
      @include('home.agenda')
    @else
      @include('home.agenda-empty')
    @endif
    @include('home.partenaires')
  </div>
@stop

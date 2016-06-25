@extends('layout')
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

@extends('layout')
@section('content')
  <div class="row home">
    @include('home.slider')
    @include('home.contact')
    @include('home.actus')
    @include('home.services')
  </div>
@stop

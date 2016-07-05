@extends('admin.dashboard-layout')
@section('content')
<div class="row center-xs middle-xs admin-home">
  <p>Bienvenue {{ Auth::user()->name }} ! Le panneau d'administration permet de gérer le contenu du site web</p>
</div>
@stop

@extends('admin.dashboard-layout')
@section('content')
  <div class="competence-create">
    <form class="row center-xs" action="/admin/competence/store" method="post">
      {{csrf_field()}}
      <div class="col-xs">
        <div class="competence-create__field">
          <input type="text" name="title" placeholder="Nom de la competence"/>
        </div>
        <div class="competence-create__field">
          <textarea name="label">Label</textarea>
        </div>
        <div class="competence-create__field">
          <textarea name="description">Description...</textarea>
        </div>
        <div class="competence-create__field">
          <input type="text" name="svg_template" placeholder="Chemin de la template"/>
        </div>
        <button type="submit" role="button">Enregistrer</button>
      </div>
    </form>
  </div>
@stop

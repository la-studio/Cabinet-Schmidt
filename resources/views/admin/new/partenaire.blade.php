@extends('admin.dashboard-layout')
@section('content')
  <div class="partenaire-create">
    <form class="row center-xs" action="/admin/partenaire/store" enctype="multipart/form-data" accept-charset="UTF-8" method="post">
      {{csrf_field()}}
      <div class="col-xs">
        <div class="partenaire-create__field">
          <input type="text" name="person_identity" placeholder="Nom du partenaire"/>
        </div>
        <div class="partenaire-create__field">
          <input type="text" name="person_identity" placeholder="Lien du partenaire"/>
        </div>
        <div class="partenaire-create__field">
          <label>
            Logo du partenaire
          <input type="file" name="photo"/>
          </label>
        </div>
        <button type="submit" role="button">Enregistrer</button>
      </div>
    </form>
  </div>
@stop

@extends('admin.dashboard-layout')
@section('content')
  <div class="temoignage-create">
    <form class="row center-xs" action="/admin/temoignage/store" enctype="multipart/form-data" accept-charset="UTF-8" method="post">
      {{csrf_field()}}
      <div class="col-xs">
        <div class="temoignage-create__field">
          <textarea type="text" name="content" placeholder="Contenu de l'article"></textarea>
        </div>
        <div class="temoignage-create__field">
          <input type="text" name="person_identity" placeholder="Nom de la personne"/>
        </div>
        <div class="temoignage-create__field">
          <input type="text" name="person_job" placeholder="Nom de l'entreprise"/>
        </div>
        <div class="temoignage-create__field">
          <input type="file" name="file"/>
        </div>
        <button type="submit" role="button">Enregistrer</button>
      </div>
    </form>
  </div>
@stop

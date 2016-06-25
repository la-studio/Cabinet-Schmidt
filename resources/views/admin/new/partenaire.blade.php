@extends('admin.dashboard-layout')
@section('content')
  <div class="partenaire-create">
    <form class="row center-xs" action="/admin/partenaire/store" enctype="multipart/form-data" accept-charset="UTF-8" method="post">
      {{csrf_field()}}
      <div class="col-xs">
        <div class="row center-xs partenaire-create__field">
          <div class="col-md-8 col-sm-10 col-xs-12">
            <span>Logo du partenaire</span>
            <input type="file" name="photo"/>
          </div>
        </div>
        <div class="row center-xs partenaire-create__field">
          <div class="col-md-8 col-sm-10 col-xs-12">
            <span>Nom du partenaire</span>
            <input type="text" name="name"/>
          </div>
        </div>
        <div class="row center-xs partenaire-create__field">
          <div class="col-md-8 col-sm-10 col-xs-12">
            <span>Lien du partenaire</span>
            <input type="text" name="link"/>
          </div>
        </div>
        <div class="row center-xs partenaire-create__field">
          <div class="col-md-8 col-sm-10 col-xs-12">
            <span>Description du partenaire</span>
            <textarea name="description"></textarea>
          </div>
        </div>
        <div class="row center-xs partenaire-create__field">
          <div class="col-md-8 col-sm-10 col-xs-12">
            <span>Afficher sur la page Liens utiles</span>
            <input type="checkbox" name="enabled"/>
          </div>
        </div>
        <input type="submit" class="partenaire-create__save" value="Enregistrer"/>
      </div>
    </form>
  </div>
@stop

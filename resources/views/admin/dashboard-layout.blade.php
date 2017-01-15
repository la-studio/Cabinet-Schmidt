<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="robots" content="noindex">
    <link rel="stylesheet" href="/css/tools.css" media="screen">
    <link rel="stylesheet" href="/css/app.css" media="screen">
    <title>Cabinet Schmidt - Dashboard</title>
  </head>
  <body>
    <div class="row admin">
      <div class="col-custom admin-menu">
        <div class="row admin-menu__logo">
          <a href="{{ URL::to('/admin/dashboard') }}">@include('admin.dashboard-logo')</a>
        </div>
        <nav class="row admin-menu__nav">
          <ul class="col-xs admin-menu__list">
            <li class="row admin-menu__item"><a href="{{ URL::to('/admin/articles') }}">Articles</a></li>
            <li class="row admin-menu__item"><a href="{{ URL::to('/admin/temoignages') }}">Témoignages</a></li>
            <li class="row admin-menu__item"><a href="{{ URL::to('/admin/partenaires') }}">Partenaires</a></li>
            <li class="row admin-menu__item"><a href="{{ URL::to('/admin/slider') }}">Slider</a></li>
            <li class="row admin-menu__item"><a href="{{ URL::to('/admin/competences') }}">Compétences</a></li>
            <li class="row admin-menu__item"><a href="{{ URL::to('/admin/storytelling') }}">Storytelling</a></li>
            <li class="row admin-menu__item"><a href="{{ URL::to('/admin/register') }}">Créer un compte</a></li>     

            {{-- Let disconnect as last-child. --}}
            <li class="row admin-menu__item"><i class="fa fa-power-off"></i><a href="{{ URL::to('/logout') }}">Déconnexion</a></li>
          </ul>
        </nav>
      </div>
      <div class="col-xs admin-content">
        @yield('content') {{-- the 1st child of admin-content has to have a row class. --}}
      </div>
    </div>
    <script   src="https://code.jquery.com/jquery-2.2.3.min.js"   integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo="   crossorigin="anonymous"></script>    
    <script src="/js/admin.js"></script>
    <script src="/vendor/ckeditor/ckeditor.js"></script>
    <script>

    CKEDITOR.replace( 'article-ckeditor', {
      filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
      filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
      filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
      filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
    });
    </script>
  </body>
</html>

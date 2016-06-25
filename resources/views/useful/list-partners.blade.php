@foreach ($partenaires_shown as $elem)
  <article class="col-sm-5 col-custom col-xs-12 partner">
    <div class="row middle-xs wrapper">
      <div class="col-xs">
        <div class="row partner__logo">
          <a href="http://{{$elem->link}}" class="link" target="_blank"><img src="{{$elem->logo}}" alt title="Logo de l'entreprise {{$elem->name}}" /></a>
        </div>
        <div class="row partner__description">
          <p>{{$elem->description}}</p>
        </div>
      </div>
    </div>
  </article>
@endforeach

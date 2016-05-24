@extends('layout')

@section('content')
  <div class="row contact">
    <div class="col-xs-12 contact__cover"></div>
    @include('home.contact')
    <div class="col-xs-12 contact__wrapper">
      <div class="row contact__map"></div>
      <form class="row center-xs form">
        <div class="col-xs">
          <header class="row form__head">
            <h2 class="center-xs row">Parlez nous de vous</h2>
            <h3 class="center-xs row">Nous vous répondrons dans les plus brefs délais</h3>
          </header>
          <div class="row center-xs form__content">
            <div class="col-md-11 col-xs-12">
              <div class="row between-xs middle-xs form__fields">
                <div class="col-sm-5 col-custom field">
                  <span class="input">
                    <input class="input__field " type="text"/>
                    <label class="input__label">
                      <span class="input__label-content">Nom & Prénom</span>
                    </label>
                    <span class="input__error">Ce champ est requis</span>
                  </span>
                </div>
                <div class="col-sm-5 col-custom field">
                  <span class="input">
                    <input class="input__field " type="text"/>
                    <label class="input__label">
                      <span class="input__label-content">Votre entreprise</span>
                    </label>
                    <span class="input__error">Ce champ est requis</span>
                  </span>
                </div>
                <div class="col-sm-5 col-custom field">
                  <span class="input">
                    <input class="input__field" type="email"/>
                    <label class="input__label">
                      <span class="input__label-content">Mail</span>
                    </label>
                    <span class="input__error">Ce champ est requis</span>
                  </span>
                </div>
                <div class="col-sm-5 col-custom field">
                  <span class="input">
                    <input class="input__field" type="text"/>
                    <label class="input__label">
                      <span class="input__label-content">Objet</span>
                    </label>
                    <span class="input__error">Ce champ est requis</span>
                  </span>
                </div>
              </div>
              <div class="row form__message">
                <div class="col-xs-12 col-custom field field--textarea">
                  <span class="input">
                    <textarea class="input__field input__field--textarea"></textarea>
                    <label class="input__label input__label--textarea">
                      <span class="input__label-content input__label-content--textarea">Votre message</span>
                    </label>
                  </span>
                </div>
              </div>
              <div class="row end-md center-xs form__button">
                <span>Envoyer</span>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
@stop
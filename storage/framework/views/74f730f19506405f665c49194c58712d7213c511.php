<?php $__env->startSection('content'); ?>
  <div class="row contact">
    <div class="col-xs-12 contact__cover"></div>
    <?php echo $__env->make('home.contact', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
                <?php echo e(csrf_field()); ?>

                <div class="col-sm-5 col-custom field">
                  <span class="input">
                    <input class="input__field" type="text" id="form-identity"/>
                    <label class="input__label">
                      <span class="input__label-content">Nom & Prénom</span>
                    </label>
                    <span class="input__error">Ce champ est requis</span>
                  </span>
                </div>
                <div class="col-sm-5 col-custom field">
                  <span class="input">
                    <input class="input__field " type="text" id="form-company"/>
                    <label class="input__label">
                      <span class="input__label-content">Votre entreprise</span>
                    </label>
                    <span class="input__error">Ce champ est requis</span>
                  </span>
                </div>
                <div class="col-sm-5 col-custom field">
                  <span class="input">
                    <input class="input__field" type="email" id="form-mail"/>
                    <label class="input__label">
                      <span class="input__label-content">Mail</span>
                    </label>
                    <span class="input__error">Ce champ est requis</span>
                  </span>
                </div>
                <div class="col-sm-5 col-custom field">
                  <span class="input">
                    <input class="input__field" type="text" id="form-purpose"/>
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
                    <textarea class="input__field input__field--textarea" id="form-message"></textarea>
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
        <div class="success success-color"><i class="material-icons">check_circle</i><span class="success__message">Le message a été envoyé avec succès !</span></div>
        <div class="fail fail-color"><span class="fail__message">Le message n'a pas pu être envoyé</span></div>
      </form>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
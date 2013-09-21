<?php $view->extend('::base.html.php'); ?>
<?php $view['slots']->start('include_css') ?>
<link rel="stylesheet" href="<?php echo $view['assets']->getUrl('css/general/contacto.css') ?>"/>
<?php $view['slots']->stop(); ?>

<div class="inner contacto">

    <h2>CONTACTO</h2>

    <?php if (isset($errors) && !empty($errors)): ?>
    <div class="alert alert-error">
        <?php foreach ($errors as $error): ?>
        <p><?=$view->escape($error);?></p>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <form class="form-horizontal" id="frmcontacto" name="frmcontacto" method="post" action="<?=$view['router']->generate('Contacto_Submit');?>">

        <fieldset>
            <legend>Envíanos tus comentarios, en breve nos pondremos en contacto.</legend>

            <div class="control-group">
                <label class="control-label" for="nombre">Nombre</label>

                <div class="controls">
                    <input id="nombre" placeholder="Ingresa tu nombre..." type="text" name="nombre" class="input-large validate[required]" />
                    <span rel="email" class="help-inline">* Necesario</span>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="email">E-Mail</label>

                <div class="controls">
                    <input id="email" type="email" placeholder="Ingresa tu correo..." name="email" class="input-large validate[required]" />
                    <span rel="email" class="help-inline">* Necesario</span>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="telefono">Teléfono</label>

                <div class="controls">
                    <input id="telefono" type="tel" placeholder="Ingresa tu teléfono..." name="telefono" class="input-large" />
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="mensaje">Mensaje</label>

                <div class="controls">
                    <textarea id="mensaje" name="mensaje" class="input-xxlarge validate[required]" placeholder="¿Qué mensaje deseas enviarnos?" rows="7" cols="45"></textarea>
                    <span rel="email" class="help-inline">* Necesario</span>
                </div>
            </div>

            <div class="form-actions buttons-area">
                <a class="btn" href="#"><i class="icon-remove"></i> Cancelar</a>
                <button type="submit" class="btn btn-primary"><i class="icon-ok-sign icon-white"></i> Enviar</button>
            </div>
        </fieldset>

    </form>
</div>
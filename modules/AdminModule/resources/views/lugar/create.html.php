<?php $view->extend('::admin.html.php'); ?>
<?php $view['slots']->start('include_css') ?>
<link rel="stylesheet" href="<?php echo $view['assets']->getUrl('admin/css/catalogos/marcas/index.css') ?>"/>
<?php $view['slots']->stop(); ?>

<div class="inner">

    <div class="breadcrumb">
        <a href="<?= $view['router']->generate('Admin_Index'); ?>">Admin</a> >>
        <a href="<?= $view['router']->generate('Admin_Lugares_Index'); ?>">Lugares</a> >>
        Agregar Lugar
    </div>

    <h2>Agregar Lugar</h2>

    <?php if (isset($errors) && !empty($errors)): ?>
        <div class="alert alert-error">
            <?php foreach ($errors as $error): ?>
                <p><?= $view->escape($error); ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form action="<?= $view['router']->generate('Admin_Lugares_Create'); ?>" method="post" class="form-horizontal"
          id="user-signup">

        <div class="control-group">
            <label class="control-label" for="nombre">Nombre <em>*</em></label>

            <div class="controls">
                <input type="text" class="input-xlarge validate[required]" id="nombre" name="nombre" value="">
                <span rel="nombre" class="help-inline"></span>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="name">Calle <em>*</em></label>

            <div class="controls">
                <input type="text" class="input-xlarge validate[required]" id="calle" name="calle" value="">
                <span rel="calle" class="help-inline"></span>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="name">Número <em>*</em></label>

            <div class="controls">
                <input type="text" class="input-xlarge validate[required]" id="numero" name="numero" value="">
                <span rel="numero" class="help-inline"></span>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="name">Colonia <em>*</em></label>

            <div class="controls">
                <input type="text" class="input-xlarge validate[required]" id="colonia" name="colonia" value="">
                <span rel="colonia" class="help-inline"></span>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="name">Ciudad <em>*</em></label>

            <div class="controls">
                <input type="text" class="input-xlarge validate[required]" id="ciudad" name="ciudad" value="">
                <span rel="ciudad" class="help-inline"></span>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="name">Estado <em>*</em></label>

            <div class="controls">
                <input type="text" class="input-xlarge validate[required]" id="estado" name="estado" value="">
                <span rel="estado" class="help-inline"></span>
            </div>
        </div>

        <input type="hidden" name="pais" id="pais" value="México">

        <div class="control-group">
            <label class="control-label" for="name">C.P. <em>*</em></label>

            <div class="controls">
                <input type="text" class="input-xlarge validate[required]" id="codigo_postal" name="codigo_postal" value="">
                <span rel="codigo_postal" class="help-inline"></span>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="name">C.P. <em>*</em></label>

            <div class="controls">
                <input type="text" class="input-xlarge validate[required]" id="codigo_postal" name="codigo_postal" value="">
                <span rel="codigo_postal" class="help-inline"></span>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="name">Tipo</label>

            <div class="controls">
                <select name="tipo" id="tipo">
                    <option value="centro de acopio">Centro de Acopio</option>
                    <option value="albergue">Albergue</option>
                    <option value="zona afectada">Zona Afectada</option>
                    <option value="otro">Otro</option>
                </select>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="name">Observaciones <em>*</em></label>

            <div class="controls">
                <textarea name="observaciones" id="observaciones" rows="5" cols="45" class="input-xxlarge"></textarea>
            </div>
        </div>

        <input id="created_at" name="created_at" type="hidden" value="<?= date('Y-m-d H:i:s'); ?>">
        <input id="modified_at" name="modified_at" type="hidden" value="<?= date('Y-m-d H:i:s'); ?>">

        <div class="form-actions buttons-area">
            <a href="<?= $view['router']->generate('Admin_Lugares_Index'); ?>" class="">Cancelar</a>
            <input type="submit" class="btn btn-large btn-step" data-goto-step="2" value="Aceptar">
        </div>

    </form>

</div>
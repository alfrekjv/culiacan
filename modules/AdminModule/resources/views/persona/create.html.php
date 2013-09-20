<?php $view->extend('::admin.html.php'); ?>
<?php $view['slots']->start('include_css') ?>
<link rel="stylesheet" href="<?php echo $view['assets']->getUrl('admin/css/catalogos/marcas/index.css') ?>"/>
<?php $view['slots']->stop(); ?>

<div class="inner">

    <div class="breadcrumb">
        <a href="<?= $view['router']->generate('Admin_Index'); ?>">Admin</a> >>
        <a href="<?= $view['router']->generate('Admin_Personas_Index'); ?>">Personas</a> >>
        Agregar Persona
    </div>

    <h2>Agregar Persona</h2>

    <?php if (isset($errors) && !empty($errors)): ?>
        <div class="alert alert-error">
            <?php foreach ($errors as $error): ?>
                <p><?= $view->escape($error); ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form action="<?= $view['router']->generate('Admin_Personas_Create'); ?>" method="post" class="form-horizontal"
          id="user-signup">

        <div class="control-group">
            <label class="control-label" for="nombre">Nombre <em>*</em></label>
            <div class="controls">
                <input type="text" class="input-xlarge validate[required]" id="nombre" name="nombre" value="">
                <span rel="nombre" class="help-inline"></span>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="apellidos">Apellidos <em>*</em></label>
            <div class="controls">
                <input type="text" class="input-xlarge validate[required]" id="apellidos" name="apellidos" value="">
                <span rel="apellidos" class="help-inline"></span>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="edad">Edad <em>*</em></label>
            <div class="controls">
                <input type="text" class="input-xlarge validate[required]" id="edad" name="edad" value="">
                <span rel="edad" class="help-inline"></span>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="status">Tipo <em>*</em></label>
            <div class="controls">
                <select name="status" id="status">
                    <option value="desaparecida">DESAPARECIDA</option>
                    <option value="encontrada">ENCONTRADA</option>
                    <option value="en albergue">EN ALBERGUE</option>
                </select>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="name">Observaciones </label>
            <div class="controls">
                <textarea name="observaciones" id="observaciones" rows="5" cols="45" class="input-xxlarge"></textarea>
            </div>
        </div>

        <input id="created_at" name="created_at" type="hidden" value="<?= date('Y-m-d H:i:s'); ?>">
        <input id="modified_at" name="modified_at" type="hidden" value="<?= date('Y-m-d H:i:s'); ?>">

        <div class="form-actions buttons-area">
            <a href="<?= $view['router']->generate('Admin_Personas_Index'); ?>" class="">Cancelar</a>
            <input type="submit" class="btn btn-large btn-step" data-goto-step="2" value="Aceptar">
        </div>

    </form>

</div>
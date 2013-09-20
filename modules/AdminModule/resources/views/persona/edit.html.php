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

    <h2>Editar Persona</h2>

    <?php if (isset($errors) && !empty($errors)): ?>
        <div class="alert alert-error">
            <?php foreach ($errors as $error): ?>
                <p><?= $view->escape($error); ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form action="<?= $view['router']->generate('Admin_Personas_Edit', array('id' => $id)); ?>" method="post" class="form-horizontal"
          id="user-signup">

        <div class="control-group">
            <label class="control-label" for="nombre">Nombre <em>*</em></label>

            <div class="controls">
                <input type="text" class="input-xlarge validate[required]" id="nombre" name="nombre" value="<?=$data->getNombre();?>">
                <span rel="nombre" class="help-inline"></span>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="apellidos">Apellidos <em>*</em></label>

            <div class="controls">
                <input type="text" class="input-xlarge validate[required]" id="apellidos" name="apellidos" value="<?=$data->getApellidos();?>">
                <span rel="apellidos" class="help-inline"></span>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="edad">Edad <em>*</em></label>

            <div class="controls">
                <input type="text" class="input-xlarge validate[required]" id="edad" name="edad" value="<?=$data->getEdad();?>">
                <span rel="edad" class="help-inline"></span>
            </div>
        </div>

         <div class="control-group">
            <label class="control-label" for="status">Tipo <em>*</em></label>
            <div class="controls">
                <select name="status" id="status">
                    <?php if ( $data->getStatus() == 'desaparecida' ): ?>
                        <option value="desaparecida" selected="selected">DESAPARECIDA</option>
                    <?php else: ?> 
                        <option value="desaparecida">DESAPARECIDA</option>
                    <?php endif ?>
                    <?php if ( $data->getStatus() == 'encontrada' ): ?>
                        <option value="encontrada" selected="selected">ENCONTRADA</option>
                    <?php else: ?> 
                        <option value="encontrada">ENCONTRADA</option>
                    <?php endif ?>
                    <?php if ( $data->getStatus() == 'en albergue' ): ?>
                        <option value="en albergue" selected="selected">EN ALBERGUE</option>
                    <?php else: ?> 
                        <option value="en albergue">EN ALBERGUE</option>
                    <?php endif ?>
                </select>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="name">Observaciones <em>*</em></label>

            <div class="controls">
                <textarea name="observaciones" id="observaciones" rows="5" cols="45" class="input-xxlarge"><?=$data->getObservaciones();?></textarea>
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
<?php $view->extend('::admin.html.php'); ?>
<?php $view['slots']->start('include_css') ?>
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
            <label class="control-label" for="name">Calle </label>

            <div class="controls">
                <input type="text" class="input-xlarge validate[required]" id="calle" name="calle" value="">
                <span rel="calle" class="help-inline"></span>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="name">Número </label>

            <div class="controls">
                <input type="text" class="input-xlarge validate[required]" id="numero" name="numero" value="">
                <span rel="numero" class="help-inline"></span>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="colonia">Colonia </label>

            <div class="controls">
                <select name="colonia" id="colonia">
                    <option value="none">Seleccione primero un municipio...</option>
                </select>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="name">Ciudad </label>

            <div class="controls">
                <select id="ciudad" name="ciudad" class="required">
                    <option value="none" selected="">Seleccione una ciudad...</option>
                    <?php foreach ($municipios as $nombre => $id) : ?>
                        <option value='<?=$id;?>'><?=utf8_encode($nombre);?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="estado">Estado </label>

            <div class="controls">
                <select id="estado" name="estado">
                    <option value="Sinaloa">Sinaloa</option>
                </select>
            </div>
        </div>

        <input type="hidden" name="pais" id="pais" value="México">

        <div class="control-group">
            <label class="control-label" for="name">C.P. </label>

            <div class="controls">
                <input type="text" class="input-xlarge validate[required]" id="codigo_postal" name="codigo_postal" value="">
                <span rel="codigo_postal" class="help-inline"></span>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="name">Mapa <em>*</em> <small>Selecciona el punto en el mapa</small></label>

            <div class="controls">
                <div id="map-canvas" style="height:400px;"></div>
            </div>
        </div>
        
        <div class="control-group hidden">
            <label class="control-label" for="name">Latitud <em>*</em></label>

            <div class="controls">
                <input type="text" class="input-xlarge validate[required]" id="lat" name="lat" value="">
                <span rel="lat" class="help-inline"></span>
            </div>
        </div>

        <div class="control-group hidden">
            <label class="control-label" for="name">Longitud <em>*</em></label>

            <div class="controls">
                <input type="text" class="input-xlarge validate[required]" id="lng" name="lng" value="">
                <span rel="lng" class="help-inline"></span>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="name">Tipo</label>

            <div class="controls">
                <select name="tipo" id="tipo">
                    <option value="centro de acopio">Centro de Acopio</option>
                    <option value="albergue">Albergue</option>
                    <option value="zona afectada">Zona Afectada</option>
                    <option value="zona evacuada">Zona Evacuada</option>
                    <option value="agua potable">Abast. de Agua Potable</option>
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


<?php $view['slots']->start('include_js_body'); ?>
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyA4-g0ztDzispF3WgqWkLIPNdSBOlYAZAc&sensor=false"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <script type="text/javascript" src="<?= $view['assets']->getUrl('js/lugar/create.js'); ?>"></script>
    
<?php $view['slots']->stop(); ?>
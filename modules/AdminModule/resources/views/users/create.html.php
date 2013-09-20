<?php $view->extend('::admin.html.php'); ?>

<?php $view['slots']->start('include_css') ?>
<!--<style type="text/css" href="--><?//= $view['assets']->getUrl('css/libs/jquery-ui-1.9.1.custom.min.css');?><!--"></style>-->
<style type="text/css">

</style>
<?php $view['slots']->stop(); ?>

<?php $view['slots']->start('include_js_body') ?>
<script src="<?= $view['assets']->getUrl('js/libs/jquery.validationEngine-en.js') ?>"></script>
<script src="<?= $view['assets']->getUrl('js/libs/jquery.validationEngine.js') ?>"></script>
<!--<script src="--><?//= $view['assets']->getUrl('js/libs/jquery-ui-1.9.1.custom.min.js') ?><!--"></script>-->
<script src="<?= $view['assets']->getUrl('js/libs/jquery.dataTables.min.js') ?>"></script>
<script src="<?= $view['assets']->getUrl('admin/js/manage-user.js') ?>"></script>
<?php $view['slots']->stop(); ?>


<?=$view->render('AdminModule:index:sidebar.html.php');?>

<div id="content" class="admin-user inner">
    
    <div id="content-header">
        <h1>User Management</h1>

    </div>

    <?php if (isset($errors) && !empty($errors)): ?>
    <div class="alert alert-error">
        <?php foreach ($errors as $error): ?>
        <p><?=$view->escape($error);?></p>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <div class="container-fluid">
        
        <div class="row-fluid">
            
            <div class="span12">

                <div id="create-user" class="widget-box">
                    <div class="widget-title">
                        <h5><i class="icon-align-justify icon-white"></i> Crear Usuario</h5>
                    </div>
                    <div class="widget-content">
                        <form action="<?=$view['router']->generate('Admin_User_Create_Submit');?>" method="post" class="form-horizontal" id="user-signup">
                
                            <div class="control-group">
                                <label class="control-label" for="formFirstName">Nombre/s <em>*</em></label>
                
                                <div class="controls">
                                    <input type="text" class="input-xlarge validate[required]" id="formFirstName" name="userFirstName" value="">
                                    <span rel="formFirstName" class="help-inline"></span>
                                </div>
                            </div>
                
                            <div class="control-group">
                                <label class="control-label" for="formLastName">Apellidos <em>*</em></label>
                
                                <div class="controls">
                                    <input type="text" class="input-xlarge validate[required]" id="formLastName" name="userLastName" value="">
                                    <span rel="formLastName" class="help-inline"></span>
                                </div>
                            </div>
                
                            <div class="control-group">
                                <label class="control-label" for="formEmail">Email <em>*</em></label>
                
                                <div class="controls">
                                    <input type="text" class="input-xlarge validate[required,custom[email], funcCall[validateTakenEmail]]" id="formEmail"
                                           name="userEmail" value="">
                                    <span rel="formEmail" class="help-inline"></span>
                                </div>
                            </div>
                
                            <div class="control-group">
                                <label class="control-label" for="formUsername">Usuario <em>*</em></label>
                
                                <div class="controls">
                                    <input type="text" class="input-xlarge validate[required, funcCall[validateTakenUsername]]" id="formUsername" name="userUsername" value="">
                                    <span rel="formUsername" class="help-inline"></span>
                                </div>
                            </div>
                
                            <div class="control-group">
                                <label class="control-label" for="formPassword">Password <em>*</em></label>
                
                                <div class="controls">
                                    <input type="password" class="input-xlarge validate[required]" id="formPassword"
                                           name="userPassword">
                                    <span rel="formPassword" class="help-inline"></span>
                                </div>
                            </div>
                
                            <div class="control-group">
                                <label class="control-label" for="formConfirmPassword">Confirmar Password <em>*</em></label>
                
                                <div class="controls">
                                    <input type="password" class="input-xlarge validate[required,equals[formPassword]]"
                                           id="formConfirmPassword" name="userConfirmPassword">
                                    <span rel="formPatientName" class="help-inline"></span>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="formLevel">Nivel <em>*</em></label>

                                <div class="controls">
                                    <select id="user_level_id" name="user_level_id">
                                        <option value="1">Admin</option>
                                        <option value="2">Colaborador</option>
                                        <option value="3" selected>Usuario</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-actions buttons-area">
                                <a href="<?=$view['router']->generate('Admin_Users_Index');?>" class="">Cancelar</a>
                                <input type="submit" class="btn btn-large btn-step" data-goto-step="2" value="Crear Usuario">
                            </div>
                            
                        </form>
                        
                    </div>
                </div>
                <!-- ./widget-box -->
                
            </div>
            
        </div>
        
    </div>
    
</div>

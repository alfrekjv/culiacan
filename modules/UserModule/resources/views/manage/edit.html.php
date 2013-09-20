<?php $view->extend('::base.html.php'); ?>

<?php $view['slots']->start('include_css') ?>
<link rel="stylesheet" href="<?php echo $view['assets']->getUrl('user/css/manage-edit.css') ?>" />
<link rel="stylesheet" href="<?php echo $view['assets']->getUrl('css/libs/datepicker.css') ?>" />
<?php $view['slots']->stop(); ?>

<?php $view['slots']->start('include_js_body') ?>
<script src="<?php echo $view['assets']->getUrl('js/libs/jquery.validationEngine-en.js') ?>"></script>
<script src="<?php echo $view['assets']->getUrl('js/libs/jquery.validationEngine.js') ?>"></script>
<script src="<?php echo $view['assets']->getUrl('js/libs/bootstrap-datepicker.js') ?>"></script>
<script src="<?php echo $view['assets']->getUrl('user/js/manage-edit.js') ?>"></script>
<?php $view['slots']->stop(); ?>

<section id="user-manage-edit-account" class="inner">
    
    <?php if(isset($errors) && !empty($errors)): ?>
    <div class="alert alert-error">
        <?php foreach($errors as $error): ?>
        <p><?=$view->escape($error);?></p>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
        
    <form action="<?=$view['router']->generate('User_Manage_Edit_Save', array('id' => $user->getID()));?>" method="post" class="form-horizontal">

        <legend>Editar Usuario</legend>

        <div class="control-group">
            <label class="control-label" for="formFirstName">First Name <em>*</em></label>
            <div class="controls">
                <input type="text" class="input-xlarge validate[required]" id="formFirstName" name="userFirstName" value="<?=$user->getFirstName();?>">
                <span rel="formFirstName" class="help-inline"></span>
            </div>
        </div>
        
        <div class="control-group">
            <label class="control-label" for="formLastName">Last Name <em>*</em></label>
            <div class="controls">
                <input type="text" class="input-xlarge validate[required]" id="formLastName" name="userLastName" value="<?=$user->getLastName();?>">
                <span rel="formLastName" class="help-inline"></span>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="formEmail">Email Address <em>*</em></label>
            <div class="controls">
                <input type="text" class="input-xlarge validate[required,custom[email]]" id="formEmail" name="userEmail" value="<?=$user->getEmail();?>">
                <span rel="formEmail" class="help-inline"></span>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="formUser">Usuario<em>*</em></label>
            <div class="controls">
                <input type="text" class="input-xlarge validate[required]" id="formUser" name="userUser" value="<?=$user->getUser();?>">
                <span rel="formUser" class="help-inline"></span>
            </div>
        </div>

        <div class="form-actions buttons-area">
            <input type="submit" class="step1 btn btn-large" value="Editar">
        </div>

    </form>

</section>



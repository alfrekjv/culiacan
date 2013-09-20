<?php $view->extend('::admin.html.php'); ?>

<?php $view['slots']->start('include_css') ?>
<link rel="stylesheet" href="<?php echo $view['assets']->getUrl('user/css/account.css') ?>"/>
<link rel="stylesheet" href="<?php echo $view['assets']->getUrl('user/css/account-edit.css') ?>"/>
<link rel="stylesheet" href="<?php echo $view['assets']->getUrl('css/libs/jquery-ui-1.9.1.custom.min.css') ?>"/>
<?php $view['slots']->stop(); ?>

<?php $view['slots']->start('include_js_body') ?>
<script src="<?php echo $view['assets']->getUrl('js/libs/jquery.validationEngine-en.js') ?>"></script>
<script src="<?php echo $view['assets']->getUrl('js/libs/jquery.validationEngine.js') ?>"></script>
<script src="<?php echo $view['assets']->getUrl('js/libs/jquery-ui-1.9.1.custom.min.js') ?>"></script>
<script src="<?php echo $view['assets']->getUrl('user/js/account-edit.js') ?>"></script>
<?php $view['slots']->stop(); ?>

<div class="well clearfix container inner">

    <?php include "sidebar.html.php"; ?>

    <section id="user-edit-account" class="">

        <?php if (isset($errors) && !empty($errors)): ?>
        <div class="alert alert-error">
            <?php foreach ($errors as $error): ?>
            <p><?=$view->escape($error);?></p>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <form action="<?=$view['router']->generate('User_Edit_Account_Save');?>" method="post" class="form-horizontal">

            <legend>Edit your account</legend>

            <div class="control-group">
                <label class="control-label" for="formFirstName">Nombre <em>*</em></label>

                <div class="controls">
                    <input type="text" class="input-xlarge validate[required]" id="formFirstName" name="userFirstName"
                           value="<?=$user->getFirstName();?>">
                    <span rel="formFirstName" class="help-inline"></span>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="formLastName">Apellido/s <em>*</em></label>

                <div class="controls">
                    <input type="text" class="input-xlarge validate[required]" id="formLastName" name="userLastName"
                           value="<?=$user->getLastName();?>">
                    <span rel="formLastName" class="help-inline"></span>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="userUsername">Usuario <em>*</em></label>

                <div class="controls">
                    <input type="text" class="input-xlarge validate[required]" id="userUsername"
                           name="userUsername" value="<?=$user->getUser();?>">
                    <span rel="userUsername" class="help-inline"></span>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="formEmail">Email <em>*</em></label>

                <div class="controls">
                    <input type="text" class="input-xlarge validate[required,custom[email]]" id="formEmail"
                           name="userEmail" value="<?=$user->getEmail();?>">
                    <span rel="formEmail" class="help-inline"></span>
                </div>
            </div>

            <div class="form-actions buttons-area">
                <input type="submit" class="step1 btn btn-primary" value="Guardar Cambios">
            </div>

        </form>

    </section>

</div>


<?php $view->extend('::admin.html.php'); ?>

<?php $view['slots']->start('include_css') ?>
<link rel="stylesheet" href="<?php echo $view['assets']->getUrl('user/css/account.css') ?>"/>
<link rel="stylesheet" href="<?php echo $view['assets']->getUrl('user/css/account-edit.css') ?>"/>
<?php $view['slots']->stop(); ?>

<?php $view['slots']->start('include_js_body') ?>
<script src="<?php echo $view['assets']->getUrl('js/libs/jquery.validationEngine-en.js') ?>"></script>
<script src="<?php echo $view['assets']->getUrl('js/libs/jquery.validationEngine.js') ?>"></script>
<script src="<?php echo $view['assets']->getUrl('user/js/account-edit.js') ?>"></script>
<?php $view['slots']->stop(); ?>

<div class="well container clearfix inner">

    <?php include "sidebar.html.php"; ?>

    <section id="account-edit-password" class="">

        <?php if (isset($errors) && !empty($errors)): ?>
        <div class="alert alert-error">
            <?php foreach ($errors as $error): ?>
            <p><?=$view->escape($error);?></p>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <form action="<?=$view['router']->generate('User_Edit_Password_Save');?>" method="post" class="form-horizontal">

            <legend>Edita tu Password</legend>

            <div class="control-group">
                <label class="control-label" for="userPassword">Password</label>

                <div class="controls">
                    <input type="password" class="input-xlarge validate[required]" id="userPassword"
                           name="userPassword">
                    <span rel="userPassword" class="help-inline"></span>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="userNewPassword">Password Nuevo</label>

                <div class="controls">
                    <input type="password" class="input-xlarge validate[required]" id="userNewPassword"
                           name="userNewPassword">
                    <span rel="userNewPassword" class="help-inline"></span>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="userConfirmNewPassword">Confirmar Password</label>

                <div class="controls">
                    <input type="password" class="input-xlarge validate[required,equals[userNewPassword]]"
                           id="userConfirmNewPassword" name="userConfirmNewPassword">
                    <span rel="userConfirmNewPassword" class="help-inline"></span>
                </div>
            </div>

            <div class="form-actions buttons-area">
                <input type="submit" class="btn btn-primary" value="Cambiar">
            </div>

        </form>

    </section>

</div>
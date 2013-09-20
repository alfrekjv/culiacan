<?php $view->extend('::admin.html.php'); ?>

<?php $view['slots']->start('include_css') ?>
<link rel="stylesheet" href="<?php echo $view['assets']->getUrl('user/css/login.css') ?>" />
<?php $view['slots']->stop(); ?>

<?php $view['slots']->start('include_js_body') ?>
<script src="<?php echo $view['assets']->getUrl('js/libs/jquery.validationEngine-en.js') ?>"></script>
<script src="<?php echo $view['assets']->getUrl('js/libs/jquery.validationEngine.js') ?>"></script>
<script src="<?php echo $view['assets']->getUrl('user/js/login.js') ?>"></script>
<?php $view['slots']->stop(); ?>

<section id="userlogin" class="inner">

    <?php if(isset($errors) && !empty($errors)): ?>
    <div class="alert alert-error">
        <?php foreach($errors as $error): ?>
        <p><?=$view->escape($error);?></p>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
    
    <form action="<?=$view['router']->generate('User_Login_Check');?>" method="post" class="form-horizontal">
        
        <legend>Iniciar Sesión</legend>
        
        <div class="control-group">
            <label class="control-label" for="user">Usuario <em>*</em></label>
            <div class="controls">
                <input type="text" class="input-xlarge validate[required]]" id="user" name="user">
                <span rel="user" class="help-inline"></span>
            </div>
        </div>
                
        <div class="control-group">
            <label class="control-label" for="password">Password <em>*</em></label>
            <div class="controls">
                <input type="password" class="input-xlarge validate[required]" id="password" name="password">
                <span rel="password" class="help-inline"></span>
            </div>
        </div>

        <div class="form-actions buttons-area">
            <input type="submit" class="btn btn-large" value="Entrar">
        </div>
        
    </form>
    
</section>

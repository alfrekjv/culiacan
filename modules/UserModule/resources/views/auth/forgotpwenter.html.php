<?php $view->extend('::base.html.php'); ?>

<?php $view['slots']->start('include_css') ?>
<link rel="stylesheet" href="<?php echo $view['assets']->getUrl('user/css/forgotpw.css') ?>" />
<?php $view['slots']->stop(); ?>

<?php $view['slots']->start('include_js_body') ?>
<script src="<?php echo $view['assets']->getUrl('js/libs/jquery.validationEngine-en.js') ?>"></script>
<script src="<?php echo $view['assets']->getUrl('js/libs/jquery.validationEngine.js') ?>"></script>
<script src="<?php echo $view['assets']->getUrl('user/js/forgotpw.js') ?>"></script>
<?php $view['slots']->stop(); ?>


<section id="user-forgot-password" class="content user-login clearfix well container">

    <form action="<?=$view['router']->generate('User_Forgot_Password_Save');?>" method="post" class="form-horizontal enter-password">
        
        <input type="hidden" class="csrf" name="csrf" value="<?php echo $csrf ?>">
        
        <legend>Change Password</legend>
        
        <div class="request">

            <div class="control-group">
                <label class="control-label" for="formPassword">Password <em>*</em></label>
                <div class="controls">
                    <input type="password" class="input-xlarge validate[required]" id="formPassword" name="password">
                    <span rel="formPassword" class="help-inline"></span>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="formConfirmPassword">Confirm Password <em>*</em></label>
                <div class="controls">
                    <input type="password" class="input-xlarge validate[required]" id="formConfirmPassword" name="confirm_password">
                    <span rel="formConfirmPassword" class="help-inline"></span>
                </div>
            </div>
            
            <div class="form-actions buttons-area">
                <input type="submit" class="btn btn-large" value="Save Password">
            </div>
            
        </div>
      
        <div class="success-section">
            <p>Your password has successfully been changed. Please use the form on your right to log in.</p>
        </div>
                                    
    </form>
    
</section>
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

    <form action="<?=$view['router']->generate('User_Forgot_Password_Send');?>" method="post" class="form-horizontal">
        
        <legend>Forgot your password?</legend>
        
        <div class="request">
            <p>Fill in your e-mail address and we'll send you a new one.</p>
               
            <div class="control-group">
                <label class="control-label" for="formEmail">Email Address <em>*</em></label>
                <div class="controls">
                    <input type="text" class="input-xlarge validate[required,custom[email]]" id="formEmail" name="email">
                    <span rel="formEmail" class="help-inline"></span>
                </div>
            </div>
            
            <div class="form-actions buttons-area">
                <input type="submit" class="btn btn-large" value="Request Password">
            </div>
            
        </div>


        <div class="success-section">
            <p>Your request has been received. You will receive an e-mail with instructions to change your password in the a few minutes.</p>
        </div>
    </form>
    
</section>
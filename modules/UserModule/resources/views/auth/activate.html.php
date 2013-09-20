<?php $view->extend('::base.html.php'); ?>

<?php $view['slots']->start('include_css') ?>
<link rel="stylesheet" href="<?php echo $view['assets']->getUrl('user/css/signup.css') ?>" />
<?php $view['slots']->stop(); ?>


<section class="content clearfix well container" id="user-activated">
        <h3>Account Activated</h3>
        <div class="text">
            <h4>Thank you for registering at Talentize</h4>
            <p>Your account has successfully been activated. We just emailed you some of your account information for future reference.</p>
            <p>Go right ahead and click Proceed to Login.</p>
            
            <p><a href="<?=$view['router']->generate('User_Login');?>" class="btn btn-large">Proceed to Login</a></p>
        </div>
</section>
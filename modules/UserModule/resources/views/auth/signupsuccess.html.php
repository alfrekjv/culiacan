<?php $view->extend('::base.html.php'); ?>

<?php $view['slots']->start('include_css') ?>
<link rel="stylesheet" href="<?php echo $view['assets']->getUrl('user/css/signup.css') ?>" />
<?php $view['slots']->stop(); ?>


<section class="content clearfix well">
    
    <div class="success">
        <p>Congratulations on creating your Talentize account.</p>
        <p>To verify your registration and to activate your account you will receive an e-mail from <a href="mailto:info@talentize.com" title="info@talentize.com">info@talentize.com</a>.</p>
        <p>In this e-mail you will find an activation link and the a step by step overview to complete the registration.</p>
    </div>
    
</section>
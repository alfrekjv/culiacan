<?php $view->extend('::admin.html.php'); ?>

<?php $view['slots']->start('include_css') ?>
<link rel="stylesheet" href="<?php echo $view['assets']->getUrl('user/css/account.css') ?>"/>
<?php $view['slots']->stop(); ?>

<div class="inner">

    <?php include "sidebar.html.php"; ?>

    <section id="view-account" class="user-login">

        <h3><?=$view->escape($user->getFullName());?></h3>

        <dl class="dl-horizontal">
            <dt>Email Address</dt>
            <dd><?=$view->escape($user->getEmail());?></dd>
        </dl>

        <div class="buttons">
            <a class="btn btn-large" href="<?=$view['router']->generate('User_Edit_Account');?>">Edit Account</a>
            <a class="btn btn-large" href="<?=$view['router']->generate('User_Edit_Password');?>">Edit Password</a>
        </div>
    </section>

</div>


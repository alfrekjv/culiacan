<?php $view->extend('::base.html.php'); ?>

<?php $view['slots']->start('include_css') ?>
<link href="<?=$view['assets']->getUrl('css/landing.css');?>" type="text/css" rel="stylesheet" />
<?php $view['slots']->stop(); ?>

<div class="homepage" id="homepage">

    <div id="map" class="map"></div>

    <aside class="sidebar">
        Sidebar
    </aside>
</div>

<?php $view['slots']->start('include_js_body'); ?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="<?=$view['assets']->getUrl('js/home.js');?>"></script>
<?php $view['slots']->stop(); ?>
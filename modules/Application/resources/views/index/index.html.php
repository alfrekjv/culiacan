<?php $view->extend('::base.html.php'); ?>

<?php $view['slots']->start('include_css') ?>
    <link href="<?= $view['assets']->getUrl('css/landing.css'); ?>" type="text/css" rel="stylesheet"/>
<?php $view['slots']->stop(); ?>


<div class="navbar navbar-inverse navbar-fixed-top hidden-md hidden-lg">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Culiacán</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="#"><span class="glyphicon glyphicon-home"></span> Centros de Acopio</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-user"></span> Albergues</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Zona Evacuadas</a></li>
            </ul>
        </div>
        <hr class="navbar-hr">
        <form class="form-persona" action="#" method="POST">
            <div class="form-group">
                <div class="input-group">
                    <input type="text" class="form-control input-lg" placeholder="Buscar una persona">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="container-fluid hidden-md hidden-lg">
    <div class="row">
        <div class="col-xs-12 col-sm-12">
            <div class="list-group">
                <a href="#" class="list-group-item active">
                    Cras justo odio
                </a>
                <a href="#" class="list-group-item">Dapibus ac facilisis in</a>
                <a href="#" class="list-group-item">Morbi leo risus</a>
                <a href="#" class="list-group-item">Porta ac consectetur ac</a>
                <a href="#" class="list-group-item">Vestibulum at eros</a>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div id="google-maps" class="col-xs-9 col-sm-9 col-md-9 col-lg-10">
            <div id="mapa-canvas" class="hidden-xs hidden-md"></div>
            <div id="btn-municipios" class="btn-group hidden-xs hidden-md">
                <button type="button" class="btn btn-primary btn-lg dropdown-toggle" data-toggle="dropdown">Culiacán
                    <span class="caret"></span></button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Ahome</a></li>
                    <li><a href="#">Angostura</a></li>
                    <li><a href="#">Badiraguato</a></li>
                    <li><a href="#">Concordia</a></li>
                    <li><a href="#">Cosalá</a></li>
                    <li class="active"><a href="#">Culiacán</a></li>
                    <li><a href="#">Choix</a></li>
                    <li><a href="#">Elota</a></li>
                    <li><a href="#">Escuinapa</a></li>
                    <li><a href="#">El Fuerte</a></li>
                    <li><a href="#">Mazatlán</a></li>
                    <li><a href="#">Mocorito</a></li>
                    <li><a href="#">Rosario</a></li>
                    <li><a href="#">Salvador Alvarado</a></li>
                    <li><a href="#">San Ignacio</a></li>
                    <li><a href="#">Sinaloa</a></li>
                    <li><a href="#">Navolato</a></li>
                </ul>
            </div>
        </div>
        <div id="sidebar" class="col-xs-3 col-sm-3 col-md-3 col-lg-2 hidden-xs">

            <form class="form-persona" action="#" method="POST">
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control input-lg" placeholder="Buscar una persona">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                    </div>
                </div>
            </form>

            <a class="twitter-timeline" href="https://twitter.com/search?q=%23culiacan" height="350"
               data-widget-id="381198995961307137">Tweets sobre "#culiacan"</a>
            <script>!function (d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
                    if (!d.getElementById(id)) {
                        js = d.createElement(s);
                        js.id = id;
                        js.src = p + "://platform.twitter.com/widgets.js";
                        fjs.parentNode.insertBefore(js, fjs);
                    }
                }(document, "script", "twitter-wjs");</script>

        </div>
    </div>
</div>

<div class="navbar navbar-banderas navbar-fixed-bottom hidden-xs hidden-md" style="bottom:71px">
    <ul class="nav nav-pills">
        <li><a href="#" data-tipo="centros"><span class="glyphicon glyphicon-home"></span> Centros de Acopio</a></li>
        <li><a href="#" data-tipo="albergues"><span class="glyphicon glyphicon-user"></span> Albergues</a></li>
        <li><a href="#" data-tipo="evacuadas"><span class="glyphicon glyphicon-log-in"></span> Zona Evacuadas</a></li>
    </ul>
</div>
<div class="navbar navbar-inverse navbar-emergencias navbar-fixed-bottom hidden-xs hidden-md">
    <h2 class="navbar-text"><b>EMERGENCIAS 066</b></h2>
</div>


<?php $view['slots']->start('include_js_body'); ?>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript" src="<?= $view['assets']->getUrl('js/home.js'); ?>"></script>
<?php $view['slots']->stop(); ?>
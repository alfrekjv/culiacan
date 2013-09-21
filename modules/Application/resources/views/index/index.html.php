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
                <button type="button" class="btn btn-primary btn-lg dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-map-marker"></span> <span class="text">Culiacán</span>
                <span class="caret"></span></button>
                <ul class="dropdown-menu" role="menu">
                    <li data-filtro="culiacan" class="active"><a href="#">Culiacán</a></li>
                    <li data-filtro="mazatlan"><a href="#">Mazatlán</a></li>
                    <li data-filtro="navolato"><a href="#">Navolato</a></li>
                </ul>
            </div>
        </div>
        <div id="sidebar" class="col-xs-3 col-sm-3 col-md-3 col-lg-2 hidden-xs">

            <form class="form-persona" action="#" method="POST">
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Buscar personas">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                    </div>
                </div>
            </form>

            <a class="twitter-timeline" href="https://twitter.com/search?q=%23culiacan" height="500"
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

<div class="navbar navbar-inverse navbar-banderas navbar-fixed-bottom hidden-xs hidden-md" style="bottom:53px">
    <ul class="nav nav-pills">
        <li><a href="#" data-tipo="centros"><span class="glyphicon glyphicon-home"></span> Centros de Acopio</a></li>
        <li><a href="#" data-tipo="albergues"><span class="glyphicon glyphicon-user"></span> Albergues</a></li>
        <li><a href="#" data-tipo="evacuadas"><span class="glyphicon glyphicon-log-in"></span> Zonas Evacuadas</a></li>
        <li><a href="#" data-tipo="afectadas"><span class="glyphicon glyphicon-log-in"></span> Zonas Afectadas</a></li>
        <li><a href="#" data-tipo="agua"><span class="glyphicon glyphicon-log-in"></span> Abast. de Agua Potable</a></li>
    </ul>
</div>

<div class="navbar navbar-inverse navbar-fixed-bottom">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex6-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><b><span class="glyphicon glyphicon-phone-alt"></span> EMERGENCIAS 066</b></a>
    </div>
    <div class="collapse navbar-collapse navbar-ex6-collapse">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#modal-directorio" data-toggle="modal">Directorio</a></li>
        <li><a href="">Donaciones</a></li>
      </ul>
    </div>
</div>

<div id="modal-directorio" class="modal fade" tabindex="-1" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <a class="close" data-dismiss="modal" aria-hidden="true" data-toggle="tooltip" data-placement="left" data-original-title="Cerrar ventana">&times;</a>
          <h2 class="modal-title">Directorio</h2>
        </div>
        <div class="modal-body" style="padding:10px">
            <ul id="list-directorio" class="list-inline text-center">
                <li><a href="http://culiacan.gob.mx/" target="_blank"><img src="<?=$view['assets']->getUrl('images/ayuntamiento-culiacan.png');?>" class="img-responsive" alt=""></a></li>
                <li><a href="http://cloudadmin.mx/" target="_blank"><img src="<?=$view['assets']->getUrl('images/cloudadmin.png');?>" class="img-responsive" alt=""></a></li>
                <li><a href="http://tomatovalley.net/" target="_blank"><img src="<?=$view['assets']->getUrl('images/tomato-valley.png');?>" class="img-responsive" alt=""></a></li>
            </ul>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-minus-sign"></span> Cerrar ventana</button>
        </div>
      </div>
    </div>
</div>


<?php $view['slots']->start('include_js_body'); ?>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript" src="<?= $view['assets']->getUrl('js/home.js'); ?>"></script>
<?php $view['slots']->stop(); ?>
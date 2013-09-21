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
                <button type="button" class="btn btn-primary btn-lg dropdown-toggle" data-toggle="dropdown"><span class="text">Culiacán</span>
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

<div class="navbar navbar-inverse navbar-banderas navbar-fixed-bottom hidden-xs hidden-md" style="bottom:62px">
    <ul class="nav nav-pills">
        <li><a href="#" data-tipo="centros"><span class="glyphicon glyphicon-home"></span> Centros de Acopio</a></li>
        <li><a href="#" data-tipo="albergues"><span class="glyphicon glyphicon-user"></span> Albergues</a></li>
        <li><a href="#" data-tipo="evacuadas"><span class="glyphicon glyphicon-log-in"></span> Zonas Evacuadas</a></li>
        <li><a href="#" data-tipo="afectadas"><span class="glyphicon glyphicon-log-in"></span> Zonas Afectadas</a></li>
    </ul>
</div>
<div class="navbar navbar-inverse navbar-emergencias navbar-fixed-bottom hidden-xs hidden-md">
    <h2 class="navbar-text"><b>EMERGENCIAS 066</b></h2>

    <div class="menu">
        <div class="nav">
            <a href="">Directorio</a> |
            <a href="">Donaciones</a> |
            <a href="#" id="btn-reportar-lugar">Reportar Lugar</a> |
            <a href="">Reportar Persona</a>
        </div>
    </div>
</div>


<?php $view['slots']->start('include_js_body'); ?>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript" src="<?= $view['assets']->getUrl('js/home.js'); ?>"></script>
<?php $view['slots']->stop(); ?>

<div id="modal-reportar-lugar" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header lead">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <span id="titulo">Reportar Lugar</span>
            </div>
            <div class="modal-body">
                <form id="form-reportar-lugar" name="form-reportar-lugar" action="#"  method="post">
                    <input id="status" name="status" type="hidden" value="2">
                    <div id="msj-error" class="alert" style="margin-top:-34px; display:none"></div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group" >
                                <label class="control-label" for="nombre">Nombre</label>
                                <input type="text" id="nombre" name="nombre" class="form-control"/>
                            </div>
                            <div class="form-group" >
                                <label class="control-label" for="calle">Calle</label>
                                <input type="text" id="calle" name="calle" class="form-control"/>
                            </div>
                            <div class="form-group" >
                                <label class="control-label" for="numero">Número</label>
                                <input type="text" id="numero" name="numero" class="form-control"/>
                            </div>
                            <div class="form-group" >
                                <label class="control-label" for="colonia">Colonia</label>
                                <input type="text" id="colonia" name="colonia" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" >
                                <label class="control-label" for="ciudad">Ciudad</label>
                                <input type="text" id="ciudad" name="ciudad" class="form-control"/>
                            </div>
                            <div class="form-group" >
                                <label class="control-label" for="estado">Estado</label>
                                <input type="text" id="estado" name="estado" class="form-control"/>
                            </div>
                            <div class="form-group" >
                                <label class="control-label" for="codigo_postal">C.P.</label>
                                <input type="text" id="codigo_postal" name="codigo_postal" class="form-control"/>
                            </div>
                            <div class="form-group" >
                                <label class="control-label" for="tipo">Tipo</label>
                                <select name="tipo" id="tipo" class="form-control">
                                    <option value="centro de acopio">Centro de Acopio</option>
                                    <option value="albergue">Albergue</option>
                                    <option value="zona afectada">Zona Afectada</option>
                                    <option value="zona evacuada">Zona Evacuada</option>
                                    <option value="otro">Otro</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="observaciones">Observaciones</label>
                            <textarea id="observaciones" name="observaciones" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <input id="created_at" name="created_at" type="hidden" value="<?= date('Y-m-d H:i:s'); ?>">
                    <input id="modified_at" name="modified_at" type="hidden" value="<?= date('Y-m-d H:i:s'); ?>">
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal" type="button">Cancelar</button>
                <button id="btn-guardar-reportar-lugar" name="btn-guardar-reportar-lugar" class="btn btn-primary" type="submit" data-loading-text="Espere..">Guardar</button>
            </div>
        </div>
    </div>
</div>
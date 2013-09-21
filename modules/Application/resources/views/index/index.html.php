<?php $view->extend('::base.html.php'); ?>

<?php $view['slots']->start('include_css') ?>
    <link href="<?= $view['assets']->getUrl('css/landing.css'); ?>" type="text/css" rel="stylesheet"/>
<?php $view['slots']->stop(); ?>
<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>
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
                <button type="button" class="btn btn-primary btn-municipios btn-lg dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-map-marker"></span> <span class="text">Culiacán</span>
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

<div class="navbar navbar-inverse navbar-banderas navbar-fixed-bottom hidden-xs hidden-md" style="bottom:49px">
    <div id="btn-tipo" class="btn-group" data-toggle="buttons">
        <a href="#" class="btn btn-default btn-lg" data-tipo="centros"><span class="glyphicon glyphicon-home"></span><input type="radio" name="options" id="option1"> Centros de Acopio</a>
        <a href="#" class="btn btn-default btn-lg" data-tipo="albergues"><span class="glyphicon glyphicon-user"></span><input type="radio" name="options" id="option2"> Albergues</a>
        <a href="#" class="btn btn-default btn-lg" data-tipo="evacuadas"><span class="glyphicon glyphicon-log-in"></span><input type="radio" name="options" id="option3"> Zonas Evacuadas</a>
        <a href="#" class="btn btn-default btn-lg" data-tipo="afectadas"><span class="glyphicon glyphicon-log-in"></span><input type="radio" name="options" id="option4"> Zonas Afectadas</a>
        <a href="#" class="btn btn-default btn-lg" data-tipo="agua"><span class="glyphicon glyphicon-log-in"></span><input type="radio" name="options" id="option5"> Abast. de Agua Potable</a>
    </div>
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
        <li><a href="#" id="btn-reportar-lugar">Reportar Lugar</a></li>
        <li><a href="">Reportar Persona</a></li>
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
        <div class="modal-body">
            <ul id="list-directorio" class="list-inline text-center">
                <li><a href="http://culiacan.gob.mx/" target="_blank"><img src="<?=$view['assets']->getUrl('images/ayuntamiento-culiacan.png');?>" class="img-responsive" alt=""></a></li>
                <li><a href="http://cloudadmin.mx/" target="_blank"><img src="<?=$view['assets']->getUrl('images/cloudadmin.png');?>" class="img-responsive" alt=""></a></li>
                <li><a href="http://tomatovalley.net/" target="_blank"><img src="<?=$view['assets']->getUrl('images/tomato-valley.png');?>" class="img-responsive" alt=""></a></li>
            </ul>

            <div class="creditos">
                <p>"La grandeza de un pueblo no se mide en su riqueza, si no en su capacidad de unirse para salir adelante en situaciones difíciles" -- A Juárez.</p>

                <p>Culiacán ha demostrado que es un pueblo muy unido y con mucho coraje ante situaciones tan adversas como la presente.</p>

                <p>Este proyecto es un homenaje para todas aquellas personas que han salido a las calles a ayudar, y sobre todo, a todas las familias que lamentablemente han tenido pérdidas inmesurables.</p>

                <p>Quiero agradecer a todas las personas que directa o indirectamente apoyaron para que este proyecto saliera a la luz en menos de 24 horas.</p>

                <p>Nuestro objetivo es centralizar la información para apoyar en las labores de rescate, limpieza y evacuación.</p>

                <h4 class="text-center" style="margin-bottom:0">Atentamente</h4>
                <h3 class="text-center" style="margin-top:0">Alfredo Juárez</h3>
            </div>

            <div class="contributors">
                <h4 >Colaboradores</h4>
                <ul class="list-inline" style="margin-bottom:0">
                    <li>Julián Quiñonez</li>
                    <li>Antonio Yee</li>
                    <li>Alonso Uribe</li>
                    <li>Jorge Pilotzi</li>
                </ul>
            </div>
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

<div id="modal-reportar-lugar" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a class="close" data-dismiss="modal" aria-hidden="true" data-toggle="tooltip" data-placement="left" data-original-title="Cerrar ventana">&times;</a>
                <h2 class="modal-title">Reportar Lugar</h2>
            </div>
            <div class="modal-body">
                <form id="form-reportar-lugar" name="form-reportar-lugar" action="#" method="post">
                    <input id="status" name="status" type="hidden" value="2">
                    <div id="msj-error" class="alert" style="display:none"></div>
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
                                    <option value="agua potable">Abst. de Agua Potable</option>
                                    <option value="otro">Otro</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <label class="control-label" for="observaciones">Observaciones</label>
                                <textarea id="observaciones" name="observaciones" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <input id="created_at" name="created_at" type="hidden" value="<?= date('Y-m-d H:i:s'); ?>">
                    <input id="modified_at" name="modified_at" type="hidden" value="<?= date('Y-m-d H:i:s'); ?>">
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal" type="button">Cancelar</button>
                <button id="btn-guardar-reportar-lugar" name="btn-guardar-reportar-lugar" class="btn btn-primary" type="submit" data-loading-text="Espere..">Enviar Reporte</button>
            </div>
        </div>
    </div>
</div>

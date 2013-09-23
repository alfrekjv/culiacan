<?php $view->extend('::base.html.php'); ?>

<?php $view['slots']->start('include_css') ?>
    <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet'>
    <link href="<?= $view['assets']->getUrl('css/landing.css'); ?>" type="text/css" rel="stylesheet"/>
<?php $view['slots']->stop(); ?>

    <div id="top-nav" class="navbar navbar-inverse navbar-fixed-top hidden-md hidden-lg">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-md-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Culiacán</a>
            </div>
            <div class="collapse navbar-collapse navbar-md-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#"><span class="glyphicon glyphicon-home"></span> Centros de Acopio</a>
                    </li>
                    <li>
                        <a href="#"><span class="glyphicon glyphicon-user"></span> Albergues</a>
                    </li>
                    <li>
                        <a href="#"><span class="glyphicon glyphicon-log-in"></span> Zona Evacuadas</a>
                    </li>
                    <li>
                        <a href="#"><span class="glyphicon glyphicon-log-in"></span> Zonas Afectadas</a>
                    </li>
                    <li>
                        <a href="#"><span class="glyphicon glyphicon-log-in"></span> Agua Potable</a>
                    </li>
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

    <div class="container-fluid">
        <div class="row">
            <div id="google-maps" class="col-xs-9 col-sm-9 col-md-9 col-lg-10">
                <div id="mapa-canvas" class="hidden-xs"></div>
                <div id="btn-municipios" class="btn-group hidden-xs">
                    <button type="button" class="btn btn-primary btn-municipios btn-lg dropdown-toggle"
                            data-toggle="dropdown">
                        <span class="glyphicon glyphicon-map-marker"></span>
                        <span class="text">Culiacán</span>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <?php foreach ($municipios as $row) : ?>
                            <li data-filtro="<?= $row->getMunicipio(); ?>"
                                class="<?= $row->getId() == 6 ? 'active' : ''; ?>">
                                <a href="#" data-lat="<?= $row->getLat(); ?>"
                                   data-lng="<?= $row->getLng(); ?>"><?= $row->getMunicipio(); ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div id="sidebar" class="col-xs-3 col-sm-3 col-md-3 col-lg-2 hidden-xs">
            <div class="social-share">
                <span class='st_sharethis_large' displayText='ShareThis'></span>
                <span class='st_facebook_large' displayText='Facebook'></span>
                <span class='st_twitter_large' displayText='Tweet'></span>
                <span class='st_email_large' displayText='Email'></span>
            </div>

                <form class="form-persona" action="#" method="POST">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Buscar personas">
                            <span class="input-group-addon btn">
                                <span class="glyphicon glyphicon-user"></span>
                            </span>
                        </div>
                    </div>
                </form>
                <a class="twitter-timeline" href="https://twitter.com/search?q=%23CuliacanEstaDePie" height="420"
                   data-widget-id="381198995961307137">Tweets sobre "#culiacanEstaDePie"</a>
                <script>!function (e, t, n) {
                        var r, i = e.getElementsByTagName(t)[0], s = /^http:/.test(e.location) ? "http" : "https";
                        if (!e.getElementById(n)) {
                            r = e.createElement(t);
                            r.id = n;
                            r.src = s + "://platform.twitter.com/widgets.js";
                            i.parentNode.insertBefore(r, i)
                        }
                    }(document, "script", "twitter-wjs")</script>
                    <a class="emergency" href="#"><b><span class="glyphicon glyphicon-phone-alt"></span> EMERGENCIAS 066</b></a>
            </div>
        </div>
    </div>

        <div id="btn-tipo" class="btn-group" data-toggle="buttons">
            <a href="#" class="btn btn-default btn-lg" data-tipo="centros">
                <span class="glyphicon glyphicon-home"></span><input type="radio" name="options"> Centros de Acopio
            </a>
            <a href="#" class="btn btn-default btn-lg" data-tipo="albergues">
                <span class="glyphicon glyphicon-user"></span><input type="radio" name="options"> Albergues
            </a>
            <a href="#" class="btn btn-default btn-lg" data-tipo="evacuadas">
                <span class="glyphicon glyphicon-log-in"></span><input type="radio" name="options"> Zonas Evacuadas
            </a>
            <a href="#" class="btn btn-default btn-lg" data-tipo="afectadas">
                <span class="glyphicon glyphicon-log-in"></span><input type="radio" name="options"> Zonas Afectadas
            </a>
            <a href="#" class="btn btn-default btn-lg" data-tipo="agua">
                <span class="glyphicon glyphicon-log-in"></span><input type="radio" name="options"> Agua
                Potable
            </a>
        </div>

    <footer>
        <div class="navbar navbar-inverse navbar-fixed-bottom">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-xs-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

            <div id="bottom-nav" class="collapse navbar-collapse navbar-xs-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="#" id="btn-reportar-lugar">Reportar Lugar</a>
                    </li>
                    <li>
                        <a href="#" class="reportarPersona">Reportar Persona</a>
                    </li>
                    <li>
                        <a href="#modal-donaciones" data-toggle="modal">Donaciones</a>
                    </li>

                    <li>
                        <a href="#modal-contacto" data-toggle="modal">Contacto</a>
                    </li>
                    <li>
                        <a href="#modal-directorio" data-toggle="modal">Directorio</a>
                    </li>
                </ul>
            </div>
        </div>
    </footer>

    <div id="modal-directorio" class="modal fade" tabindex="-1" aria-hidden="true" data-keyboard="false"
         data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <a class="close" data-dismiss="modal" aria-hidden="true" data-toggle="tooltip" data-placement="left"
                       data-original-title="Cerrar ventana">&times;</a>
                    <h4 class="modal-title">Directorio</h4>
                </div>
                <div class="modal-body">
                    <ul id="list-directorio" class="list-inline text-center">
                        <li>
                            <a href="http://culiacan.gob.mx/" target="_blank">
                                <img src="<?= $view['assets']->getUrl('images/ayuntamiento-culiacan.png'); ?>"
                                     class="img-responsive" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="http://cloudadmin.mx/" target="_blank">
                                <img src="<?= $view['assets']->getUrl('images/cloudadmin.png'); ?>"
                                     class="img-responsive" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="http://tomatovalley.net/" target="_blank">
                                <img src="<?= $view['assets']->getUrl('images/tomato-valley.png'); ?>"
                                     class="img-responsive" alt="">
                            </a>
                        </li>
                    </ul>
                    <div class="creditos">
                        <p>"La grandeza de un pueblo no se mide en su riqueza, si no en su capacidad de unirse para
                            salir adelante en situaciones difíciles" -- A Juárez.</p>

                        <p>Culiacán ha demostrado que es un pueblo muy unido y con mucho coraje ante situaciones tan
                            adversas como la presente.</p>

                        <p>Este proyecto es un homenaje para todas aquellas personas que han salido a las calles a
                            ayudar, y sobre todo, a todas las familias que lamentablemente han tenido pérdidas
                            inmesurables.</p>

                        <p>Quiero agradecer a todas las personas que directa o indirectamente apoyaron para que este
                            proyecto saliera a la luz en menos de 24 horas.</p>

                        <p>Nuestro objetivo es centralizar la información para apoyar en las labores de rescate,
                            limpieza y evacuación.</p>

                        <small>Gen 9:12-16</small>

                        <h5 class="text-center" style="margin-bottom:0">Atentamente</h5>
                        <h5 class="text-center" style="margin-top:0"><b>Alfredo Juárez</b></h5>
                    </div>
                    <div class="contributors">
                        <h4>Colaboradores</h4>
                        <ul class="list-inline" style="margin-bottom:0">
                            <li>Julián Quiñonez</li>
                            <li>Antonio Yee</li>
                            <li>Alonso Uribe</li>
                            <li>Luis Benítez</li>
                            <li>Jorge Pilotzi</li>
                            <li>Joel Rodelo</li>
                        </ul>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><span
                            class="glyphicon glyphicon-minus-sign"></span> Cerrar ventana
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="modal-donaciones" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Donaciones</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info text-center" style="margin-bottom:0">
                        <h4 style="margin:0">En construcción</h4>
                        Módulo para realizar donaciones a damnificados
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><span
                            class="glyphicon glyphicon-minus-sign"></span> Cerrar ventana
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="modal-reportar-lugar" class="modal fade" tabindex="-1" aria-hidden="true" data-keyboard="false"
         data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <a href="#" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar ventana">&times;</a>
                    <h4 class="modal-title">Reportar Lugar</h4>
                </div>
                <div class="modal-body">
                    <form id="form-reportar-lugar" name="form-reportar-lugar" action="#" method="post">
                        <input id="status" name="status" type="hidden" value="2">
                        <input id="created_at" name="created_at" type="hidden" value="<?= date('Y-m-d H:i:s'); ?>">
                        <input id="modified_at" name="modified_at" type="hidden" value="<?= date('Y-m-d H:i:s'); ?>">

                        <div id="msj-error" class="alert" style="display:none"></div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <label class="control-label" for="nombre">Nombre</label>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <label class="control-label" for="calle">Calle</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <input type="text" id="nombre" name="nombre" class="form-control" tabindex="1">
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <input type="text" id="calle" name="calle" class="form-control" tabindex="2">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <label class="control-label" for="numero">Número</label>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <label class="control-label" for="colonia">Colonia</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <input type="text" id="numero" name="numero" class="form-control" tabindex="3">
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <input type="text" id="colonia" name="colonia" class="form-control" tabindex="4">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <label class="control-label" for="ciudad">Ciudad</label>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <label class="control-label" for="estado">Estado</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <input type="text" id="ciudad" name="ciudad" class="form-control" tabindex="5">
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <input type="text" id="estado" name="estado" class="form-control" tabindex="6">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <label class="control-label" for="codigo_postal">C.P.</label>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <label class="control-label" for="tipo">Tipo</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <input type="text" id="codigo_postal" name="codigo_postal" class="form-control" tabindex="7">
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <select name="tipo" id="tipo" class="form-control" tabindex="8">
                                    <option value="centro de acopio">Centro de Acopio</option>
                                    <option value="albergue">Albergue</option>
                                    <option value="zona afectada">Zona Afectada</option>
                                    <option value="zona evacuada">Zona Evacuada</option>
                                    <option value="agua potable">Agua Potable</option>
                                    <option value="otro">Otro</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <label>Señala el punto en el mapa</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div id="lugarMap" style="height:250px;"></div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger pull-left" data-dismiss="modal" type="button" tabindex="11"><span
                            class="glyphicon glyphicon-minus-sign"></span> Cancelar
                    </button>
                    <button id="btn-guardar-reportar-lugar" name="btn-guardar-reportar-lugar" class="btn btn-success"
                            type="submit" data-loading-text="Espere.." tabindex="10"><span class="glyphicon glyphicon-ok-sign"></span>
                        Enviar Reporte
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="modal-contacto" class="modal fade" tabindex="-1" aria-hidden="true" data-keyboard="false"
         data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Formulario de Contacto</h4>
                </div>
                <div class="modal-body">
                    <form role="form" id="contact-form" name="contact-form">

                        <div id="mensaje-contacto"></div>

                        <div class="form-group">
                            <label for="nombre_contacto" class="control-label">Tu nombre</label>
                            <input type="text" class="form-control" id="nombre_contacto"
                                   placeholder="Escribe tu nombre completo" name="nombre_contacto" tabindex="12">
                        </div>
                        <div class="form-group">
                            <label for="correo_electronico" class="control-label">Correo Electrónico</label>
                            <input type="text" class="form-control" id="correo_electronico"
                                   placeholder="Ej: tucorreo@gmail.com" name="correo_electronico" tabindex="13">
                        </div>
                        <div class="form-group">
                            <label for="mensaje" class="control-label">Mensaje</label>
                            <textarea class="form-control" id="mensaje" name="mensaje" rows="3" tabindex="14"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal" tabindex="16"><span
                            class="glyphicon glyphicon-minus-sign"></span> Cancelar
                    </button>
                    <button type="button" class="btn btn-success sendEmail" tabindex="15"><span
                            class="glyphicon glyphicon-ok-sign"></span>
                        Enviar mensaje
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="modal-reportar-persona" class="modal fade" tabindex="-1" aria-hidden="true" data-keyboard="false"
         data-backdrop="static">
    </div>
<?php $view['slots']->start('include_js_body'); ?>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript" src="<?= $view['assets']->getUrl('js/home.js'); ?>"></script>

    <script type="text/javascript">var switchTo5x=true;</script>
    <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
    <script type="text/javascript">stLight.options({publisher: "ur-ade195a7-2dbe-babe-a95f-cb7ac5c1a700"});</script>

<?php $view['slots']->stop(); ?>
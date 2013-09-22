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
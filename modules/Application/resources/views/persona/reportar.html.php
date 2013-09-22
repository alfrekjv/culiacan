<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Reportar Persona</h4>
        </div>
        <div class="modal-body">
            <form role="form" id="reportar-persona-form" name="reportar-persona-form">

                <div id="mensaje-persona"></div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <label for="nombre_completo" class="control-label">Nombre</label>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <label for="correo_electronico" class="control-label">Apellidos</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <input type="text" class="form-control" id="nombre"
                               placeholder="Escribe su nombre" name="nombre" tabindex="17">
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <input type="text" class="form-control" id="apellidos"
                               placeholder="Escribe sus apellidos" name="apellidos" tabindex="18">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <label for="correo_electronico" class="control-label">Edad</label>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <label for="status" class="control-label">Status</label>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <input type="text" class="form-control" id="edad"
                                   placeholder="Escribe su edad" name="edad" tabindex="19">
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <select id="status" name="status" class="form-control" tabindex="20">
                                <option value="desaparecida">Desaparecida</option>
                                <option value="en albergue">En Albergue</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="mensaje" class="control-label">Observaciones</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <textarea class="form-control" id="observaciones" name="observaciones" rows="3"
                                      tabindex="21"></textarea>
                        </div>
                    </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal" tabindex="23"><span
                    class="glyphicon glyphicon-minus-sign"></span> Cancelar
            </button>
            <button type="button" class="btn btn-success reportarPersonaSubmit" tabindex="22"><span
                    class="glyphicon glyphicon-ok-sign"></span>
                Reportar
            </button>
        </div>
    </div>
</div>
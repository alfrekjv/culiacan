<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Reportar Persona</h4>
        </div>
        <div class="modal-body">
            <form role="form" id="reportar-persona-form" name="reportar-persona-form">

                <span class="alert-error"></span>

                <div class="form-group">
                    <label for="nombre_completo">Su Nombre</label>
                    <input type="text" class="form-control" id="nombre"
                           placeholder="Escribe su nombre" name="nombre">
                </div>

                <div class="form-group">
                    <label for="correo_electronico">Sus Apellidos</label>
                    <input type="text" class="form-control" id="apellidos"
                           placeholder="Escribe sus apellidos" name="apellidos">
                </div>

                <div class="form-group">
                    <label for="correo_electronico">Edad</label>
                    <input type="text" class="form-control" id="edad"
                           placeholder="Escribe su edad" name="edad">
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status">
                        <option value="desaparecida">Desaparecida</option>
                        <option value="en albergue">En Albergue</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="mensaje">Observaciones</label>
                    <textarea class="form-control" id="observaciones" name="observaciones" rows="3"></textarea>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><span
                    class="glyphicon glyphicon-minus-sign"></span> Cancelar
            </button>
            <button type="button" class="btn btn-success reportarPersonaSubmit"><span class="glyphicon glyphicon-ok-sign"></span>
                Reportar
            </button>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
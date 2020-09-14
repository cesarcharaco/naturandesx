<div class="offset-area">
        <div class="offset-close"><i class="ti-close"></i></div>
        <ul class="nav offset-menu-tab">
            <li><a class="active show" data-toggle="tab" href="#activity">Reportes</a></li>
            <li><a data-toggle="tab" href="#settings" class="">Ventas</a></li>
        </ul>
        <div class="offset-content tab-content">
            <div id="activity" class="tab-pane fade in active show">
                <center>
                    <div class="form-group">
                        <select name="tipo_usuario" class="form-control select2" required="">
                            <option selected disabled>Tipo de Usuario</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="usuario" class="form-control select2" required="">
                            <option selected disabled>Usuario</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="semana[]" multiple class="form-control select2" required="">
                            <option selected disabled>Semanas</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Generar</button>
                </center>
            </div>
            <div id="settings" class="tab-pane fade">
                <center>
                    <div class="form-group">
                        <select name="semana[]" multiple class="form-control select2" required="">
                            <option selected disabled>Semanas</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Generar</button>
                </center>
            </div>
        </div>
    </div>
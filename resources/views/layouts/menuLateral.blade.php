<!-- offset area start -->
<div class="offset-area">
    <div class="offset-close"><i class="ti-close"></i></div>
    <ul class="nav offset-menu-tab">
        <li><a class="active" data-toggle="tab" href="#settings">Settings</a></li>
    </ul>
    <div class="offset-content tab-content">
        <div id="settings" class="tab-pane fade in show active">
            <div class="offset-settings">
                <h4>Reportes</h4>
                <div class="settings-list">
                    <div class="s-settings">
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
                        <h4>Ventas</h4>
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
        </div>
    </div>
</div>
<!-- offset area end -->
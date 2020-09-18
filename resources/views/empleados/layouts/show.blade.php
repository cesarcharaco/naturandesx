<div class="VistaLateralEmpleados VerEmpleados" id="VerEmpleados" style="display: none;">
  <div class="card border shadow" style="
  background-image: url('{{ asset('img/blue-white.jpg') }}');
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  border-radius: 30px !important;">
    <div class="card-body">
      <center>
      	<div class="bg-primary" style="border-radius: 30px;">
        	<img src="{{ asset('img/favicon.png') }}" style="width: 250px;">
      	</div>
        <div class="form-group" style="">
          <div id="img_qr"></div>
        </div>
        <div class="card rounded">
          <div class="form-group">
            <h3 style="color: black !important;"><span id="nombres_carnet"></span> <span id="apellidos_carnet"></span></h3>
          </div>
          <div class="form-group">
            <h5 style="color: black !important;"><span id="email_carnet"></span></h5>
          </div>
          <div class="form-group">
            <h5 style="color: black !important;"><span id="rut_carnet"></span></h5>
          </div>
        </div>
      </center>
    </div>
  </div>
</div>
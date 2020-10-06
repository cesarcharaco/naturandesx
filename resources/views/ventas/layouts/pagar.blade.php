<div class="modal fade" id="pagar" role="dialog" >
    <div class="modal-dialog modal-default">
        <div class="modal-content border border-warning" style="border-radius: 20px !important;">
            <div class="modal-header shadow">
                <h4>Pagar ventas</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form action="{{ route('pagar_pendientes') }}" name="pagar_pendientes" method="POST">
                @csrf
                <div class="modal-body ">
                    <div id="cargando2" class="mt-2 mb-2" style="display: none;">
                      <center>
                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                      </center>
                    </div>
                    <div id="mostrarPagar"  style="display: none;">
                        <h5>¿Está realmente seguro de querer pagar un total de <strong>{{$no_cancelado}}</strong> bidones al repartidor <strong>{{$key->nombres}} {{$key->apellidos}} - {{$key->rut}}</strong>?</h5>
                    </div>
                </div>
                <div class="modal-footer">
                    <div style="float: left !important; justify-content: left !important;">
                        <button type="button" class="btn btn-default shadow" data-dismiss="modal" style="float: left !important;"><strong>Cancelar</strong></button>
                    </div>
                    <input type="hidden" name="id_repartidor" id="id_repartidorPagar" value="{{$id_repartidor}}">
                    <input type="hidden" name="desde" id="desdePagar" value="{{$desde}}">
                    <input type="hidden" name="hasta" id="hastaPagar" value="{{$hasta}}">
                    <button type="submit" class="btn btn-warning text-white shadow" style="float: right;"><strong>Pagar</strong></button>
                </div>                            
            </form>
        </div>
    </div>
</div>
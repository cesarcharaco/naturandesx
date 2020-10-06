<div class="modal fade" id="pagar" role="dialog" style="border-radius: 20px;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div id="cargando2" class="mt-2 mb-2" style="display: none;">
                  <center>
                    <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                  </center>
                </div>
                <div id="mostrarPagar"  style="display: none;">
                    <table class="table table-striped border border-orange" style="width: 100%; border-radius: 20px !important;">
                        <thead class="bg-primary">
                            <tr>
                                <th>Cliente</th>
                                <th>Fecha</th>
                                <th>Cantidad</th>
                                <th>Total a pagar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php 
                                $num=0;
                                $monto=0;
                            @endphp
                            @foreach($rep_ventas as $key)
                                @if($key->status != 'Cancelado')
                                  <tr id="filaP{{$num}}" style="display: none;" align="center">
                                    <td>{{$key->nombres}} {{$key->apellidos}}<br>{{$key->rut}}</td>
                                    <td>{{$key->created_at}}</td>
                                    <td><strong>Promoción</strong><br>
                                        Cant: <strong>{{$key->cantidad}}</strong>
                                    </td>
                                    <td>
                                        <strong>{{$key->monto_total}}.00$</strong>
                                    </td>
                                  </tr>
                                    @php
                                        $num++;
                                        $monto=$monto+$key->monto_total;
                                    @endphp
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-2" align="right">
                        Total a Pagar: <h2>{{$monto}}.00$</h2>
                    </div>
                    <center>
                        <button class="btn btn-warning text-white"><strong>Pagar</strong></button>
                    </center>
                </div>
            </div>                            
        </div>
    </div>
</div>
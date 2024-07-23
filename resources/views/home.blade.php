@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    <div class="card-body">
                        <div class="form-group">
                            {{ Form::label('orden_de_compra_id', 'Orden de compra') }}
                            <select id="orden_de_compra_id" name="orden_de_compra_id" class="form-control select2" placeholder="Numero de orden interna">
                                <option value="">Numero de orden interna</option>
                                @foreach ($ordenesDeCompra as $orden)
                                    <option value="{{ $orden->id }}">
                                        Int: {{ $orden->numeroOrdenInterna }} | Ext: {{ $orden->numeroOrden }} | {{ $clientes->firstWhere('id', $orden->cliente_id)->nombre }} | {{ $orden->descripcionTarea }}
                                    </option>
                                @endforeach
                            </select>
                            {!! $errors->first('orden_de_compra_id', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <table class="table table-bordered">
                            <tr> 
                                <th>Pedido N°</th>
                                <th>Cliente</th>
                                <th>Obra</th>
                            </tr>
                            <tr>
                                <td class="pedido-numero"></td>
                                <td id="cliente"></td>
                                <td id="obra"></td>
                            </tr>
                        </table>
                        
                        <table class="table table-bordered">
                            <tr>
                                <th>Importe Orden de Compra:</th>
                                <td class="importe"></td>
                            </tr>
                        </table>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Realidad de la Obra</th>
                                    <th>Gastado x rubro</th>
                                    <th>Presupuestado</th>
                                    <th>Diferencias</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Cargas Sociales</td>
                                    <td class="cargasSociales"></td>
                                    <td></td>
                                    <td></td>
                                    <td class="diferencia cargasSociales-diferencia"></td>
                                </tr>
                                <tr>
                                    <td>Mano de Obra</td>
                                    <td class="manoDeObra"></td>
                                    <td class="manoDeObra-gastado"></td>
                                    <td><input type="text" class="form-control presupuestado" data-rubro="manoDeObra"></td>
                                    <td class="diferencia manoDeObra-diferencia"></td>
                                </tr>
                                <tr>
                                    <td>Compras</td>
                                    <td class="compras"></td>
                                    <td class="compras-gastado"></td>
                                    <td><input type="text" class="form-control presupuestado" data-rubro="compras"></td>
                                    <td class="diferencia compras-diferencia"></td>
                                </tr>
                                <tr>
                                    <td>Gastos Generales</td>
                                    <td class="gastosGenerales"></td>
                                    <td class="sumaGastos-gastado"></td>
                                    <td><input type="text" class="form-control presupuestado" data-rubro="sumaGastos"></td>
                                    <td class="diferencia sumaGastos-diferencia"></td>
                                </tr>
                                <tr>
                                    <td>Energía</td>
                                    <td class="energia"></td>
                                    <td></td>
                                    <td></td>
                                    <td class="diferencia energia-diferencia"></td>
                                </tr>
                                <tr>
                                    <td>Gastos Bancarios</td>
                                    <td class="gastosBancarios"></td>
                                    <td></td>
                                    <td></td>
                                    <td class="diferencia gastosBancarios-diferencia"></td>
                                </tr>
                                <tr>
                                    <td>Ingresos Brutos</td>
                                    <td class="ingresosBrutos"></td>
                                    <td class="ingresosBrutos-gastado"></td>
                                    <td><input type="text" class="form-control presupuestado" data-rubro="ingresosBrutos"></td>
                                    <td class="diferencia ingresosBrutos-diferencia"></td>
                                </tr>
                                <tr>
                                    <td>Imps SHT</td>
                                    <td class="impsSHT"></td>
                                    <td class="impsSHT-gastado"></td>
                                    <td><input type="text" class="form-control presupuestado" data-rubro="impsSHT"></td>
                                    <td class="diferencia impsSHT-diferencia"></td>
                                </tr>
                                <tr>
                                    <td>Impuesto Cheque</td>
                                    <td class="impuestoCheque"></td>
                                    <td class="impuestoCheque-gastado"></td>
                                    <td><input type="text" class="form-control presupuestado" data-rubro="impuestoCheque"></td>
                                    <td class="diferencia impuestoCheque-diferencia"></td>
                                </tr>
                                <tr>
                                    <td>Total Gastado</td>
                                    <td class="totalGastado"></td>
                                    <td class="totalGastado-gastado"></td>
                                    <td><input type="text" class="form-control presupuestado" data-rubro="totalGastado"></td>
                                    <td class="diferencia totalGastado-diferencia"></td>
                                </tr>
                                <tr>
                                    <td>Saldo Primario</td>
                                    <td class="saldoPrimario"></td>
                                    <td class="saldoPrimario-gastado"></td>
                                    <td><input type="text" class="form-control presupuestado" data-rubro="saldoPrimario"></td>
                                    <td class="diferencia saldoPrimario-diferencia"></td>
                                </tr>
                                <tr>
                                    <td>Imp. Ganancias</td>
                                    <td class="impGanancias"></td>
                                    <td class="impGanancias-gastado"></td>
                                    <td><input type="text" class="form-control presupuestado" data-rubro="impGanancias"></td>
                                    <td class="diferencia impGanancias-diferencia"></td>
                                </tr>
                                <tr>
                                    <td>Rentabilidad</td>
                                    <td class="rentabilidad"></td>
                                    <td class="rentabilidad-gastado"></td>
                                    <td><input type="text" class="form-control presupuestado" data-rubro="rentabilidad"></td>
                                    <td class="diferencia rentabilidad-diferencia"></td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>O.C.N°</th>
                                    <th>Cotizado</th>
                                    <th>Rentabilidad Cotizado</th>
                                    <th>Importe Rentabilidad Previsto</th>
                                    <th>Rentabilidad Real</th>
                                    <th>Porcentaje Real</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="pedido-numero"></td>
                                    <td class="importe"></td>
                                    <td class="porcentaje-rentabilidad"></td>
                                    <td class="rentabilidad-prevista"></td>
                                    <td class="rentabilidad-diferencia"></td>
                                    <td class="porcentaje-real"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#orden_de_compra_id').change(function() {
                var ordenId = $(this).val();
                if (ordenId) {
                    $.ajax({
                        url: '/order-details/' + ordenId,
                        method: 'GET',
                        success: function(data) {
                            $('.pedido-numero').text(data.numeroOrdenInterna);
                            $('#cliente').text(data.cliente);
                            $('#obra').text(data.descripcionTarea);
                            $('.importe').text('$ ' + data.importeOrdenCompra);

                            // Actualizar valores gastados
                            $('.manoDeObra').text(data.manoDeObra);
                            $('.compras').text(data.compras);
                            $('.ingresosBrutos').text(data.ingresosBrutos);
                            $('.impsSHT').text(data.impsSHT);
                            $('.impuestoCheque').text(data.impuestoCheque);
                            $('.totalGastado').text(data.totalGastado);
                            $('.saldoPrimario').text(data.saldoPrimario);
                            $('.impGanancias').text(data.impGanancias);
                            $('.rentabilidad').text(data.rentabilidad);
                            $('.energia').text(data.energia);
                            $('.gastosGenerales').text(data.gastosGenerales);
                            $('.gastosBancarios').text(data.gastosBancarios);
                            $('.cargasSociales').text(data.cargasSociales);
                            $('.sumaGastos-gastado').text(data.sumaGastos);

                            // Actualizar valores de gastado en la clase correspondiente
                            $('.manoDeObra-gastado').text(data.cargasSocialesYmanoDeObra);
                            $('.compras-gastado').text(data.compras);
                            $('.ingresosBrutos-gastado').text(data.ingresosBrutos);
                            $('.impsSHT-gastado').text(data.impsSHT);
                            $('.impuestoCheque-gastado').text(data.impuestoCheque);
                            $('.totalGastado-gastado').text(data.totalGastado);
                            $('.saldoPrimario-gastado').text(data.saldoPrimario);
                            $('.impGanancias-gastado').text(data.impGanancias);
                            $('.rentabilidad-gastado').text(data.rentabilidad);

                            // Calcular diferencias iniciales
                            calcularDiferencias();

                            // Calcular rentabilidad y porcentajes
                            calcularRentabilidadYPorcentajes();
                        }
                    });
                }
            });

            // Recalcular diferencias cuando se cambia un valor presupuestado
            $('.presupuestado').on('input', function() {
                calcularDiferencias();
                calcularRentabilidadYPorcentajes();
            });

            function calcularDiferencias() {
                $('.presupuestado').each(function() {
                    var rubro = $(this).data('rubro');
                    var gastado =  parseFloat($('.' + rubro + '-gastado').text().replace(/,/g, '')) || 0;
                    var presupuestado = parseFloat($(this).val()) || 0;
                    var diferencia = -1 *(presupuestado - gastado);
                    $('.' + rubro + '-diferencia').text(diferencia.toFixed(2));
                });
            }

            function calcularRentabilidadYPorcentajes() {
                var importe = parseFloat($('.importe').text().replace(/,/g, '').replace('$', '')) || 0;
                var rentabilidad = parseFloat($('.rentabilidad').text().replace(/,/g, '')) || 0;

                var porcentajeRentabilidad = (rentabilidad / importe) * 100;
                $('.porcentaje-rentabilidad').text(porcentajeRentabilidad.toFixed(2) + '%');

                var rentabilidadPrevista = importe * (porcentajeRentabilidad / 100);
                $('.rentabilidad-prevista').text('$ ' + rentabilidadPrevista.toFixed(2));

                var rentabilidadDiferencia = parseFloat($('.rentabilidad-diferencia').text().replace(/,/g, '')) || 0;

                var porcentajeReal = (rentabilidadDiferencia / importe) * 100;
                $('.porcentaje-real').text(porcentajeReal.toFixed(2) + '%');
            }
        });
    </script>
@endsection

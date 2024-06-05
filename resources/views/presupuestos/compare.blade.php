@extends('layouts.app')

@section('template_title')
    Comparar Presupuesto y Obra
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Comparar Presupuesto y Obra') }}</div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Pedido N°</th>
                                <th>Cliente</th>
                                <th>Obra</th>
                            </tr>
                            <tr>
                                <td>{{ $presupuesto->ordenDeCompra->numeroOrdenInterna }}</td>
                                <td>{{ $presupuesto->ordenDeCompra->cliente->nombre }}</td>
                                <td>{{ $presupuesto->ordenDeCompra->descripcionTarea }}</td>
                            </tr>
                        </table>
                        <table class="table table-bordered">
                            <tr>
                                <th>Importe Orden de Compra:</th>
                                <td>${{ number_format($importeOrdenCompra, 2) }}</td>
                            </tr>
                        </table>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Realidad de la Obra</th>
                                    <th>Gastado x rubro</th>
                                    <th>Presupuestado</th>
                                    <th>Diferencias</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Cargas Sociales</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Mano de Obra</td>
                                    <td>${{ number_format($manoDeObra, 2) }}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Compras</td>
                                    <td>${{ number_format($compras, 2) }}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Gastos Generales</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Energía</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Gastos Bancarios</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Ingresos Brutos</td>
                                    <td>${{ number_format($ingresosBrutos, 2) }}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Imps SHT</td>
                                    <td>${{ number_format($impsSHT, 2) }}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Impuesto Cheque</td>
                                    <td>${{ number_format($impuestoCheque, 2) }}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Total Gastado</td>
                                    <td>${{ number_format($totalGastado, 2) }}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Saldo Primario</td>
                                    <td>${{ number_format($saldoPrimario, 2) }}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Imp. Ganancias</td>
                                    <td>${{ number_format($impGanancias, 2) }}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Rentabilidad</td>
                                    <td>${{ number_format($rentabilidad, 2) }}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

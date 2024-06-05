<?php
namespace App\Http\Controllers;

use App\Models\Presupuesto;
use App\Models\OrdenesDeCompra;
use App\Models\Insumo;
use App\Models\Proovedore;
use Illuminate\Http\Request;

class PresupuestoController extends Controller
{
    public function index(Request $request)
    {
        $query = Presupuesto::with('obra', 'ordenDeCompra.cliente');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->whereHas('ordenDeCompra.cliente', function ($q) use ($search) {
                    $q->where('nombre', 'like', "%{$search}%");
                })
                ->orWhereHas('ordenDeCompra', function ($q) use ($search) {
                    $q->where('numeroOrdenInterna', 'like', "%{$search}%")
                      ->orWhere('descripcionTarea', 'like', "%{$search}%");
                })
                ->orWhere('numero_legajo', 'like', "%{$search}%");
            });
        }

        if ($request->filled('estado')) {
            $estadoMap = [
                'presupuestado' => 'presupuestado',
                'in_progress' => 'in_progress',
                'en_espera_de_pago' => 'en_espera_de_pago'
            ];
            $estado = $estadoMap[$request->input('estado')] ?? null;
            if ($estado) {
                $query->where('estado', $estado);
            }
        }

        $presupuestos = $query->paginate(10);

        if ($request->ajax()) {
            return view('presupuestos.partials.presupuestos-table', compact('presupuestos'))->render();
        }

        return view('presupuestos.index', compact('presupuestos'));
    }
    

    public function create()
    {
        $ordenesDeCompra = OrdenesDeCompra::all();
        $insumos = Insumo::all();
        $proovedores = Proovedore::all(); // Añadido para el modal
        return view('presupuestos.create', compact('ordenesDeCompra', 'insumos', 'proovedores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'orden_de_compra_id' => 'required',
            'estado' => 'required',
            'numero_legajo' => 'required|unique:presupuestos,numero_legajo',
        ]);

        $presupuesto = Presupuesto::create($request->only('orden_de_compra_id', 'estado', 'numero_legajo'));

        foreach ($request->insumos as $key => $insumoId) {
            $cantidad = $request->cantidades[$key];
            $presupuesto->insumos()->attach($insumoId, ['cantidad' => $cantidad]);
        }

        return redirect()->route('presupuestos.index')->with('success', 'Presupuesto creado exitosamente.');
    }

    public function show(Presupuesto $presupuesto)
    {
        $presupuesto->load('ordenDeCompra.cliente', 'insumos');
        
        // Calcular el total del presupuesto
        $totalPresupuesto = $presupuesto->insumos->sum(function($insumo) {
            return $insumo->pivot->cantidad * $insumo->precio;
        });

        return view('presupuestos.show', compact('presupuesto', 'totalPresupuesto'));
    }


    public function edit(Presupuesto $presupuesto)
    {
        if ($presupuesto->estado == 'in_progress') {
            return redirect()->route('presupuestos.index')->with('error', 'No se puede editar un presupuesto en progreso.');
        }

        $ordenesDeCompra = OrdenesDeCompra::all();
        $insumos = Insumo::all();
        $proovedores = Proovedore::all(); // Añadido para el modal
        return view('presupuestos.edit', compact('presupuesto', 'ordenesDeCompra', 'insumos', 'proovedores'));
    }

    public function update(Request $request, Presupuesto $presupuesto)
    {
        if ($presupuesto->estado == 'in_progress') {
            return redirect()->route('presupuestos.index')->with('error', 'No se puede editar un presupuesto en progreso.');
        }

        $request->validate([
            'orden_de_compra_id' => 'required',
            'estado' => 'required',
            'numero_legajo' => 'required|unique:presupuestos,numero_legajo,' . $presupuesto->id,
        ]);

        $presupuesto->update($request->only('orden_de_compra_id', 'estado', 'numero_legajo'));

        $presupuesto->insumos()->detach();
        foreach ($request->insumos as $key => $insumoId) {
            $cantidad = $request->cantidades[$key];
            $presupuesto->insumos()->attach($insumoId, ['cantidad' => $cantidad]);
        }

        return redirect()->route('presupuestos.index')->with('success', 'Presupuesto actualizado exitosamente.');
    }

    public function compare($id)
    {
        $presupuesto = Presupuesto::with('obra', 'ordenDeCompra.cliente')->findOrFail($id);
        $obra = $presupuesto->obra;

        // Cálculos necesarios
        $importeOrdenCompra = $presupuesto->ordenDeCompra->valorTarea;
        $ingresosBrutos = $importeOrdenCompra * 0.04;
        $impsSHT = $importeOrdenCompra * 0.0045;
        $impuestoCheque = $importeOrdenCompra * 0.012;

        $manoDeObra = $presupuesto->ordenDeCompra->horasPersonals->sum(function($hora) {
            return $hora->cantidad_horas * $hora->precio_por_hora;
        });

        $compras = $obra->insumos->sum('precio_total'); // Ajusta esta línea según tu estructura de datos

        $totalGastado = $manoDeObra + $compras + $ingresosBrutos + $impsSHT + $impuestoCheque;
        $saldoPrimario = $importeOrdenCompra - $totalGastado;
        $impGanancias = $saldoPrimario * 0.35;
        $rentabilidad = $saldoPrimario - $impGanancias;

        return view('presupuestos.compare', compact('presupuesto', 'obra', 'importeOrdenCompra', 'manoDeObra', 'compras', 'ingresosBrutos', 'impsSHT', 'impuestoCheque', 'totalGastado', 'saldoPrimario', 'impGanancias', 'rentabilidad'));
    }



    public function destroy(Presupuesto $presupuesto)
    {
        if ($presupuesto->estado == 'in_progress') {
            return redirect()->route('presupuestos.index')->with('error', 'No se puede eliminar un presupuesto en progreso.');
        }

        $presupuesto->delete();
        return redirect()->route('presupuestos.index')->with('success', 'Presupuesto eliminado exitosamente.');
    }
}

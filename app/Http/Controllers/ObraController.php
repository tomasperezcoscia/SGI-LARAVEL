<?php
namespace App\Http\Controllers;

use App\Models\Obra;
use App\Models\Presupuesto;
use App\Models\Insumo;
use App\Models\Proovedore;
use Illuminate\Http\Request;

class ObraController extends Controller
{
    public function create($presupuestoId)
    {
        $presupuesto = Presupuesto::with('insumos')->find($presupuestoId);
        $proovedores = Proovedore::all(); // Añadido para el modal
        $insumos = Insumo::all(); // Añadido para el select de insumos

        if ($presupuesto->estado != 'in_progress' || $presupuesto->obras()->exists()) {
            return redirect()->route('presupuestos.index')->with('error', 'Solo se pueden crear obras sobre presupuestos en progreso y que no tengan obras asociadas.');
        }

        $obra = new Obra();
        return view('obras.create', compact('obra', 'presupuesto', 'proovedores', 'insumos'));
    }

    public function store(Request $request, $presupuestoId)
    {
        $presupuesto = Presupuesto::with('insumos')->find($presupuestoId);

        if ($presupuesto->estado != 'in_progress' || $presupuesto->obras()->exists()) {
            return redirect()->route('presupuestos.index')->with('error', 'Solo se pueden crear obras sobre presupuestos en progreso y que no tengan obras asociadas.');
        }

        $obra = Obra::create([
            'presupuesto_id' => $presupuestoId,
            'estado' => 'in_progress'
        ]);

        foreach ($presupuesto->insumos as $insumo) {
            $obra->insumos()->attach($insumo->id, ['cantidad' => 0]);
        }

        return redirect()->route('obras.edit', $obra->id)->with('success', 'Obra creada exitosamente.');
    }

    public function edit($id)
    {
        $obra = Obra::with('insumos', 'presupuesto')->find($id);
        $insumos = Insumo::all();
        $proovedores = Proovedore::all(); // Añadido para el modal

        return view('obras.edit', compact('obra', 'insumos', 'proovedores'));
    }

    public function update(Request $request, $id)
    {
        $obra = Obra::find($id);

        foreach ($request->insumos as $key => $insumoId) {
            $cantidad = $request->cantidades[$key];
            $obra->insumos()->syncWithoutDetaching([$insumoId => ['cantidad' => $cantidad]]);
        }

        return redirect()->route('obras.edit', $obra->id)->with('success', 'Obra actualizada exitosamente.');
    }
}

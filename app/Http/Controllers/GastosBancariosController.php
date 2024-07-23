<?php
namespace App\Http\Controllers;

use App\Models\GastosBancarios;
use Illuminate\Http\Request;
use Carbon\Carbon;


class GastosBancariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = GastosBancarios::query();

        // Búsqueda unificada
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('fecha', 'like', '%' . $search . '%')
                  ->orWhere('precio', 'like', '%' . $search . '%');
            });
        }

        $GastosBancarios = $query->paginate(10);

        return view('gastos-bancarios.index', compact('GastosBancarios'))
            ->with('i', (request()->input('page', 1) - 1) * $GastosBancarios->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $gastoBancario = new GastosBancarios();
        return view('gastos-bancarios.create', compact('gastoBancario'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate(GastosBancarios::$rules);

        $gastoBancario = GastosBancarios::create($request->all());

        return response()->json([
            'success' => true,
            'gastoBancario' => $gastoBancario
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $gastoBancario = GastosBancarios::find($id);

        return view('gastos-bancarios.show', compact('gastoBancario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $gastoBancario = GastosBancarios::find($id);

        return view('gastos-bancarios.edit', compact('gastoBancario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        request()->validate(GastosBancarios::$rules);

        $gastoBancario = GastosBancarios::find($id);

        if (!$gastoBancario) {
            return response()->json(['success' => false, 'message' => 'El registro no existe en la base de datos']);
        }

        $updated = $gastoBancario->update($request->all());

        if ($updated) {
            return response()->json(['success' => true, 'gastoBancario' => $gastoBancario]);
        } else {
            return response()->json(['success' => false, 'message' => 'No se pudo actualizar el registro']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $gastoBancario = GastosBancarios::find($id)->delete();

        return redirect()->route('gastos-bancarios.index')
            ->with('success', 'GastosBancarios deleted successfully');
    }

    public function getGastosBancariosFromMonth($mesAnio)
{
    try {
        // Convertir mesAnio a un objeto Carbon
        $date = Carbon::createFromFormat('m-Y', $mesAnio);

        // Obtener el primer y último día del mes
        $startOfMonth = $date->copy()->startOfMonth();
        $endOfMonth = $date->copy()->endOfMonth();

        // Obtener los gastos bancarios del mes
        $gastosBancarios = GastosBancarios::whereBetween('fecha', [$startOfMonth, $endOfMonth])->get();

        // Calcular el total de precios
        $totalPrecio = $gastosBancarios->sum('precio');

        return response()->json([
            'success' => true,
            'gastosBancarios' => $gastosBancarios,
            'totalPrecio' => $totalPrecio
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error al obtener los gastos bancarios',
            'error' => $e->getMessage()
        ], 500);
    }
}


}

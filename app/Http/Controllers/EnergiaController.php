<?php
namespace App\Http\Controllers;

use App\Models\Energia;
use Illuminate\Http\Request;
use Carbon\Carbon;


class EnergiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Energia::query();

        // Búsqueda unificada
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('fecha', 'like', '%' . $search . '%')
                  ->orWhere('precio', 'like', '%' . $search . '%');
            });
        }

        $Energias = $query->paginate(10);

        return view('energia.index', compact('Energias'))
            ->with('i', (request()->input('page', 1) - 1) * $Energias->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $energia = new Energia();
        return view('energia.create', compact('energia'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate(Energia::$rules);

        $energia = Energia::create($request->all());

        return response()->json([
            'success' => true,
            'energia' => $energia
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $energia = Energia::find($id);

        return view('energia.show', compact('energia'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $energia = Energia::find($id);

        return view('energia.edit', compact('energia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $energia = Energia::findOrFail($id);
        $energia->update($request->all());

        return response()->json([
            'success' => true,
            'energia' => $energia
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $energia = Energia::find($id)->delete();

        return redirect()->route('energia.index')
            ->with('success', 'Energia deleted successfully');
    }

    public function getEnergiaFromMonth($mesAnio)
{
    try {
        // Convertir mesAnio a un objeto Carbon
        $date = Carbon::createFromFormat('m-Y', $mesAnio);

        // Obtener el primer y último día del mes
        $startOfMonth = $date->copy()->startOfMonth();
        $endOfMonth = $date->copy()->endOfMonth();

        // Obtener los registros de energía del mes
        $energias = Energia::whereBetween('fecha', [$startOfMonth, $endOfMonth])->get();

        // Calcular el total de precios
        $totalPrecio = $energias->sum('precio');

        return response()->json([
            'success' => true,
            'energias' => $energias,
            'totalPrecio' => $totalPrecio
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error al obtener los registros de energía',
            'error' => $e->getMessage()
        ], 500);
    }
}

}

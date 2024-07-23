<?php

namespace App\Http\Controllers;

use App\Models\CargasSociales;
use Illuminate\Http\Request;
use Carbon\Carbon;

/**
 * Class CargasSocialesController
 * @package App\Http\Controllers
 */
class CargasSocialesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = CargasSociales::query();

        // Búsqueda unificada
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('f931', 'like', '%' . $search . '%')
                  ->orWhere('uocra', 'like', '%' . $search . '%')
                  ->orWhere('fondoDesempleo', 'like', '%' . $search . '%')
                  ->orWhere('ieric', 'like', '%' . $search . '%')
                  ->orWhere('intereses', 'like', '%' . $search . '%');
            });
        }

        $cargasSociales = $query->paginate(10);

        return view('cargas-sociales.index', compact('cargasSociales'))
            ->with('i', (request()->input('page', 1) - 1) * $cargasSociales->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cargasSociales = new CargasSociales();
        return view('cargas-sociales.create', compact('cargasSociales'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(CargasSociales::$rules);

        try {
            $cargasSociales = CargasSociales::create($validatedData);
            return response()->json(['success' => true, 'cargasSociales' => $cargasSociales]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cargasSociales = CargasSociales::find($id);

        return view('cargas-sociales.show', compact('cargasSociales'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cargasSociales = CargasSociales::find($id);

        return view('cargas-sociales.edit', compact('cargasSociales'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  CargasSociales $cargasSociales
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate(CargasSociales::$rules);

        $cargasSociales = CargasSociales::find($id);

        if (!$cargasSociales) {
            return response()->json(['success' => false, 'message' => 'El registro no existe en la base de datos']);
        }

        try {
            $cargasSociales->update($validatedData);
            return response()->json(['success' => true, 'cargasSociales' => $cargasSociales]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'No se pudo actualizar el registro']);
        }
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $cargasSociales = CargasSociales::find($id)->delete();

        return redirect()->route('CargasSociales.index')
        ->with('success', 'Cargas Sociales deleted successfully');   
    }

    public function getCargasSocialesFromMonth($mesAnio)
{
    try {
        // Convertir mesAnio a un objeto Carbon
        $date = Carbon::createFromFormat('m-Y', $mesAnio);

        // Obtener el primer y último día del mes
        $startOfMonth = $date->copy()->startOfMonth();
        $endOfMonth = $date->copy()->endOfMonth();

        // Obtener los gastos bancarios del mes
        $cargasSociales = CargasSociales::whereBetween('fecha', [$startOfMonth, $endOfMonth])->get();

        // Calcular el total de precios
        $f931 = $cargasSociales->sum('f931');
        $uocra = $cargasSociales->sum('uocra');
        $intereses = $cargasSociales->sum('intereses');
        $ieric = $cargasSociales->sum('ieric');
        $fondoDesempleo = $cargasSociales->sum('fondoDesempleo');
        $sumaCargasSociales = $f931 + $uocra + $intereses + $ieric + $fondoDesempleo;


        return response()->json([
            'success' => true,
            'cargasSociales' => $cargasSociales,
            'f931' => $f931,
            'uocra' => $uocra,
            'intereses' => $intereses,
            'ieric' => $ieric,
            'fondoDesempleo' => $fondoDesempleo,
            'sumaCargasSociales' => $sumaCargasSociales,
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

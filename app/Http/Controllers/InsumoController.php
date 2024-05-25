<?php

namespace App\Http\Controllers;

use App\Models\Insumo;
use App\Models\Proovedore;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Log;

/**
 * Class InsumoController
 * @package App\Http\Controllers
 */
class InsumoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Insumo::query();

        // Búsqueda unificada
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('nombre', 'like', '%' . $search . '%')
                  ->orWhere('tipo', 'like', '%' . $search . '%')
                  ->orWhere('precio', 'like', '%' . $search . '%')
                  ->orWhere('inventario', 'like', '%' . $search . '%');
            });
        }

        $insumos = $query->paginate(10);
        $proovedores = Proovedore::all();

        return view('insumo.index', compact('insumos', 'proovedores'))
            ->with('i', (request()->input('page', 1) - 1) * $insumos->perPage());
    }

    public function create()
    {
        $insumo = new Insumo();
        $proovedores = Proovedore::all();
        return view('insumo.create', compact('insumo', 'proovedores'));
    }

    public function store(Request $request)
{
    request()->validate(Insumo::$rules);

    $insumo = Insumo::create($request->all());

    return response()->json([
        'success' => true,
        'insumo' => $insumo
    ]);
}


    public function show($id)
    {
        $insumo = Insumo::find($id);
        return view('insumo.show', compact('insumo'));
    }

    public function edit($id)
    {
        $insumo = Insumo::find($id);
        $proovedores = Proovedore::all();
        return view('insumo.edit', compact('insumo', 'proovedores'));
    }

    
    public function update(Request $request, $id)
    {
        $request->validate(Insumo::$rules);

        $insumo = Insumo::find($id);

        if(!$insumo){
            return response()->json(['success' => false, 'message' => 'El regustro no existe en la base de datos']);

        }

        try {
            $updated = $insumo->update($request->all());
        } catch (\Exception $e) {
            Log::error('Error al actualizar el registro en la base de datos', ['exception' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'No se pudo actualizar el registro']);
        }

        if ($updated) {
            return response()->json(['success' => true, 'insumo' => $insumo]);
        } else {
            return response()->json(['success' => false, 'message' => 'No se pudo actualizar el registro']);
        }
    }

    public function destroy($id)
    {
        $insumo = Insumo::find($id)->delete();
        return redirect()->route('Insumo.index')->with('success', 'Insumo deleted successfully');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\OrdenesDeCompra;
use App\Models\Cliente;
use Illuminate\Http\Request;

/**
 * Class OrdenesDeCompraController
 * @package App\Http\Controllers
 */
class OrdenesDeCompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = OrdenesDeCompra::query();

        // Búsqueda unificada
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('numeroOrdenInterna', 'like', '%' . $search . '%')
                  ->orWhere('numeroOrden', 'like', '%' . $search . '%')
                  ->orWhere('descripcionTarea', 'like', '%' . $search . '%')
                  ->orWhere('valorTarea', 'like', '%' . $search . '%');
            });
        }

        $ordenesDeCompras = $query->paginate(10);

        return view('ordenes-de-compra.index', compact('ordenesDeCompras'))
            ->with('i', (request()->input('page', 1) - 1) * $ordenesDeCompras->perPage())
            ->with('clientes', Cliente::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ordenesDeCompra = new OrdenesDeCompra();
        $clientes = Cliente::all();
        return view('ordenes-de-compra.create', compact('ordenesDeCompra', 'clientes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(OrdenesDeCompra::$rules);

        try {
            $ordenesDeCompra = OrdenesDeCompra::create($validatedData);
            return response()->json(['success' => true, 'ordenesDeCompra' => $ordenesDeCompra]);
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
        $ordenesDeCompra = OrdenesDeCompra::find($id);

        return view('ordenes-de-compra.show', compact('ordenesDeCompra'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ordenesDeCompra = OrdenesDeCompra::find($id);
        $clientes = Cliente::all();

        return view('ordenes-de-compra.edit', compact('ordenesDeCompra', 'clientes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate(OrdenesDeCompra::$rules);

        $ordenesDeCompra = OrdenesDeCompra::find($id);

        if (!$ordenesDeCompra) {
            return response()->json(['success' => false, 'message' => 'El registro no existe en la base de datos']);
        }

        try {
            $ordenesDeCompra->update($validatedData);
            return response()->json(['success' => true, 'ordenesDeCompra' => $ordenesDeCompra]);
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
        $ordenesDeCompra = OrdenesDeCompra::find($id);
        
        if (!$ordenesDeCompra) {
            return response()->json(['success' => false, 'message' => 'Orden de compra not found']);
        }

        try {
            $ordenesDeCompra->delete();
            return response()->json(['success' => true, 'message' => 'Orden de compra deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
        }
    }
}

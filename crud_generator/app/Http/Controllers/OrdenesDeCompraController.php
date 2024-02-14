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
        $search = $request->get('search');
        if ($search) {
            $ordenesDeCompras = OrdenesDeCompra::where('numeroOrdenInterna', 'like', '%' . $search . '%')
                ->orWhere('cliente_id', 'like', '%' . $search . '%')
                ->orWhere('numeroOrden', 'like', '%' . $search . '%')
                ->orWhere('descripcionTarea', 'like', '%' . $search . '%')
                ->orWhere('valorTarea', 'like', '%' . $search . '%')
                ->orWhere('iva', 'like', '%' . $search . '%')
                ->orWhere('valorTareaConIva', 'like', '%' . $search . '%')
                ->paginate(10);
        } else {
            $ordenesDeCompras = OrdenesDeCompra::paginate();
        }

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
        $ordenesDeCompras = new OrdenesDeCompra();
        return view('ordenes-de-compra.create', compact('ordenesDeCompras'))
            ->with('clientes', Cliente::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(OrdenesDeCompra::$rules);
        
            
            $ordenesDeCompras = OrdenesDeCompra::create($request->all());

            return redirect()->route('OrdenesDeCompra.index')
                ->with('success', 'OrdenesDeCompra created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ordenesDeCompras = OrdenesDeCompra::find($id);

        return view('ordenes-de-compra.show', compact('ordenesDeCompras'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ordenesDeCompras = OrdenesDeCompra::find($id);

        return view('ordenes-de-compra.edit', compact('ordenesDeCompras'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  OrdenesDeCompra $ordenesDeCompras
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrdenesDeCompra $ordenesDeCompras)
    {
        request()->validate(OrdenesDeCompra::$rules);

        $ordenesDeCompras->update($request->all());

        return redirect()->route('OrdenesDeCompra.index')
            ->with('success', 'OrdenesDeCompra updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $ordenesDeCompras = OrdenesDeCompra::find($id)->delete();

        return redirect()->route('OrdenesDeCompra.index')
            ->with('success', 'OrdenesDeCompra deleted successfully');
    }
}

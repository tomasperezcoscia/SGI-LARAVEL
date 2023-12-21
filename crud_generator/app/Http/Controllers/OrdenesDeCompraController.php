<?php

namespace App\Http\Controllers;

use App\Models\OrdenesDeCompra;
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
    public function index()
    {
        $ordenesDeCompras = OrdenesDeCompra::paginate();

        return view('ordenes-de-compra.index', compact('ordenesDeCompras'))
            ->with('i', (request()->input('page', 1) - 1) * $ordenesDeCompras->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ordenesDeCompra = new OrdenesDeCompra();
        return view('ordenes-de-compra.create', compact('ordenesDeCompra'));
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

        $ordenesDeCompra = OrdenesDeCompra::create($request->all());

        return redirect()->route('ordenes-de-compras.index')
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

        return view('ordenes-de-compra.edit', compact('ordenesDeCompra'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  OrdenesDeCompra $ordenesDeCompra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrdenesDeCompra $ordenesDeCompra)
    {
        request()->validate(OrdenesDeCompra::$rules);

        $ordenesDeCompra->update($request->all());

        return redirect()->route('ordenes-de-compras.index')
            ->with('success', 'OrdenesDeCompra updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $ordenesDeCompra = OrdenesDeCompra::find($id)->delete();

        return redirect()->route('ordenes-de-compras.index')
            ->with('success', 'OrdenesDeCompra deleted successfully');
    }
}

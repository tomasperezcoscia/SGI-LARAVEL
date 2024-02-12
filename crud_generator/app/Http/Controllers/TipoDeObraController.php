<?php

namespace App\Http\Controllers;

use App\Models\TipoDeObra;
use Illuminate\Http\Request;

/**
 * Class TipoDeObraController
 * @package App\Http\Controllers
 */
class TipoDeObraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoDeObras = TipoDeObra::paginate();

        return view('tipo-de-obra.index', compact('tipoDeObras'))
            ->with('i', (request()->input('page', 1) - 1) * $tipoDeObras->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipoDeObra = new TipoDeObra();
        return view('tipo-de-obra.create', compact('tipoDeObra'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(TipoDeObra::$rules);

        $tipoDeObra = TipoDeObra::create($request->all());

        return redirect()->route('TipoDeObra.index')
            ->with('success', 'TipoDeObra created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipoDeObra = TipoDeObra::find($id);

        return view('tipo-de-obra.show', compact('tipoDeObra'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipoDeObra = TipoDeObra::find($id);

        return view('tipo-de-obra.edit', compact('tipoDeObra'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  TipoDeObra $tipoDeObra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoDeObra $tipoDeObra)
    {
        request()->validate(TipoDeObra::$rules);

        $tipoDeObra->update($request->all());

        return redirect()->route('TipoDeObra.index')
            ->with('success', 'TipoDeObra updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $tipoDeObra = TipoDeObra::find($id)->delete();

        return redirect()->route('TipoDeObra.index')
            ->with('success', 'TipoDeObra deleted successfully');
    }
}

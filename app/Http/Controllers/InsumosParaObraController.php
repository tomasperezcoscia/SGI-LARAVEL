<?php

namespace App\Http\Controllers;

use App\Models\InsumosParaObra;
use Illuminate\Http\Request;

/**
 * Class InsumosParaObraController
 * @package App\Http\Controllers
 */
class InsumosParaObraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $insumosParaObras = InsumosParaObra::paginate();

        return view('insumos-para-obra.index', compact('insumosParaObras'))
            ->with('i', (request()->input('page', 1) - 1) * $insumosParaObras->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $insumosParaObra = new InsumosParaObra();
        return view('insumos-para-obra.create', compact('insumosParaObra'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(InsumosParaObra::$rules);

        $insumosParaObra = InsumosParaObra::create($request->all());

        return redirect()->route('insumos-para-obras.index')
            ->with('success', 'InsumosParaObra created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $insumosParaObra = InsumosParaObra::find($id);

        return view('insumos-para-obra.show', compact('insumosParaObra'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $insumosParaObra = InsumosParaObra::find($id);

        return view('insumos-para-obra.edit', compact('insumosParaObra'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  InsumosParaObra $insumosParaObra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InsumosParaObra $insumosParaObra)
    {
        request()->validate(InsumosParaObra::$rules);

        $insumosParaObra->update($request->all());

        return redirect()->route('insumos-para-obras.index')
            ->with('success', 'InsumosParaObra updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $insumosParaObra = InsumosParaObra::find($id)->delete();

        return redirect()->route('insumos-para-obras.index')
            ->with('success', 'InsumosParaObra deleted successfully');
    }
}

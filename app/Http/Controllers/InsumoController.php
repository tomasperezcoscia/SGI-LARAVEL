<?php

namespace App\Http\Controllers;

use App\Models\Insumo;
use App\Models\Proovedore;
use Illuminate\Http\Request;

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
        $search = $request->get('search');
        if ($search) {
            $insumos = Insumo::where('nombre', 'like', '%' . $search . '%')
                ->orWhere('tipo', 'like', '%' . $search . '%')
                ->orWhere('precio', 'like', '%' . $search . '%')
                ->orWhere('inventario', 'like', '%' . $search . '%')
                ->paginate(10);
        } else {
            $insumos = Insumo::paginate();
        }

        return view('insumo.index', compact('insumos'))
            ->with('i', (request()->input('page', 1) - 1) * $insumos->perPage())
            ->with('proovedores', Proovedore::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $insumo = new Insumo();
        return view('insumo.create', compact('insumo'))->with('proovedores', Proovedore::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Insumo::$rules);

        $insumo = Insumo::create($request->all());

        return redirect()->route('Insumo.index')->with('success', 'Insumo created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $insumo = Insumo::find($id);

        return view('insumo.show', compact('insumo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $insumo = Insumo::find($id);

        return view('insumo.edit', compact('insumo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Insumo $insumo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Insumo $insumo)
    {
        request()->validate(Insumo::$rules);

        $insumo->update($request->all());

        return redirect()->route('Insumo.index')->with('success', 'Insumo updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $insumo = Insumo::find($id)->delete();

        return redirect()->route('Insumo.index')->with('success', 'Insumo deleted successfully');
    }
}

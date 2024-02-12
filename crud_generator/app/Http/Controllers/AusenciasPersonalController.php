<?php

namespace App\Http\Controllers;

use App\Models\AusenciasPersonal;
use App\Models\Personal;
use Illuminate\Http\Request;

/**
 * Class AusenciasPersonalController
 * @package App\Http\Controllers
 */
class AusenciasPersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ausenciasPersonals = AusenciasPersonal::paginate();

        return view('ausencias-personal.index', compact('ausenciasPersonals'))
            ->with('i', (request()->input('page', 1) - 1) * $ausenciasPersonals->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ausenciasPersonal = new AusenciasPersonal();
        return view('ausencias-personal.create', compact('ausenciasPersonal'))
            ->with('personals', Personal::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(AusenciasPersonal::$rules);

        $ausenciasPersonal = AusenciasPersonal::create($request->all());

        return redirect()->route('ausencias-personals.index')
            ->with('success', 'AusenciasPersonal created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ausenciasPersonal = AusenciasPersonal::find($id);

        return view('ausencias-personal.show', compact('ausenciasPersonal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ausenciasPersonal = AusenciasPersonal::find($id);

        return view('ausencias-personal.edit', compact('ausenciasPersonal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  AusenciasPersonal $ausenciasPersonal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AusenciasPersonal $ausenciasPersonal)
    {
        request()->validate(AusenciasPersonal::$rules);

        $ausenciasPersonal->update($request->all());

        return redirect()->route('ausencias-personals.index')
            ->with('success', 'AusenciasPersonal updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $ausenciasPersonal = AusenciasPersonal::find($id)->delete();

        return redirect()->route('ausencias-personals.index')
            ->with('success', 'AusenciasPersonal deleted successfully');
    }
}

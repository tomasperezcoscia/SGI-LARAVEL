<?php

namespace App\Http\Controllers;

use App\Models\HorasPersonal;
use Illuminate\Http\Request;

/**
 * Class HorasPersonalController
 * @package App\Http\Controllers
 */
class HorasPersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $horasPersonals = HorasPersonal::paginate();

        return view('horas-personal.index', compact('horasPersonals'))
            ->with('i', (request()->input('page', 1) - 1) * $horasPersonals->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $horasPersonal = new HorasPersonal();
        return view('horas-personal.create', compact('horasPersonal'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(HorasPersonal::$rules);

        $horasPersonal = HorasPersonal::create($request->all());

        return redirect()->route('HorasPersonal.index')
            ->with('success', 'HorasPersonal created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $horasPersonal = HorasPersonal::find($id);

        return view('horas-personal.show', compact('horasPersonal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $horasPersonal = HorasPersonal::find($id);

        return view('horas-personal.edit', compact('horasPersonal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  HorasPersonal $horasPersonal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HorasPersonal $horasPersonal)
    {
        request()->validate(HorasPersonal::$rules);

        $horasPersonal->update($request->all());

        return redirect()->route('HorasPersonal.index')
            ->with('success', 'HorasPersonal updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $horasPersonal = HorasPersonal::find($id)->delete();

        return redirect()->route('HorasPersonal.index')
            ->with('success', 'HorasPersonal deleted successfully');
    }
}

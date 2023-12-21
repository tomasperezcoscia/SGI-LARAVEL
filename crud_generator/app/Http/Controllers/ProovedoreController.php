<?php

namespace App\Http\Controllers;

use App\Models\Proovedore;
use Illuminate\Http\Request;

/**
 * Class ProovedoreController
 * @package App\Http\Controllers
 */
class ProovedoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proovedores = Proovedore::paginate();

        return view('proovedore.index', compact('proovedores'))
            ->with('i', (request()->input('page', 1) - 1) * $proovedores->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $proovedore = new Proovedore();
        return view('proovedore.create', compact('proovedore'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Proovedore::$rules);

        $proovedore = Proovedore::create($request->all());

        return redirect()->route('proovedores.index')
            ->with('success', 'Proovedore created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $proovedore = Proovedore::find($id);

        return view('proovedore.show', compact('proovedore'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proovedore = Proovedore::find($id);

        return view('proovedore.edit', compact('proovedore'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Proovedore $proovedore
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proovedore $proovedore)
    {
        request()->validate(Proovedore::$rules);

        $proovedore->update($request->all());

        return redirect()->route('proovedores.index')
            ->with('success', 'Proovedore updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $proovedore = Proovedore::find($id)->delete();

        return redirect()->route('proovedores.index')
            ->with('success', 'Proovedore deleted successfully');
    }
}

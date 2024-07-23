<?php

namespace App\Http\Controllers;

use App\Models\Proovedore;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Log;


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
    public function index(Request $request)
    {
        $query = Proovedore::query();

        // Búsqueda unificada
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('legajo', 'like', '%' . $search . '%')
                  ->orWhere('nombre', 'like', '%' . $search . '%')
                  ->orWhere('numeroDeTelefono', 'like', '%' . $search . '%')
                  ->orWhere('tipo', 'like', '%' . $search . '%');
            });
        }

        $proovedores = $query->paginate(10);

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

        return response()->json([
            'success' => true,
            'proovedore' => $proovedore
        ]);
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

    public function update(Request $request, $id)
    {
        $proovedor = Proovedore::findOrFail($id);
        $proovedor->update($request->all());

        return response()->json([
            'success' => true,
            'proovedor' => $proovedor
        ]);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $proovedore = Proovedore::find($id)->delete();

        return redirect()->route('Proovedore.index')
            ->with('success', 'Proovedore deleted successfully');
    }
}

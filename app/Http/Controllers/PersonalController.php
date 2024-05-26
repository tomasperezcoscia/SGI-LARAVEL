<?php

namespace App\Http\Controllers;

use App\Models\Personal;
use Illuminate\Http\Request;

/**
 * Class PersonalController
 * @package App\Http\Controllers
 */
class PersonalController extends Controller
{
    public function index(Request $request)
    {
        $query = Personal::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('legajo', 'like', '%' . $search . '%')
                  ->orWhere('nombre', 'like', '%' . $search . '%')
                  ->orWhere('salario_hora', 'like', '%' . $search . '%')
                  ->orWhere('estado', 'like', '%' . $search . '%');
            });
        }

        $personals = $query->paginate(10);

        return view('personal.index', compact('personals'))
            ->with('i', (request()->input('page', 1) - 1) * $personals->perPage());
    }

    public function create()
    {
        $personal = new Personal();
        return view('personal.create', compact('personal'));
    }

    public function store(Request $request)
    {
        request()->validate(Personal::$rules);

        $personal = Personal::create($request->all());

        return response()->json(['success' => true, 'personal' => $personal]);
    }

    public function show($id)
    {
        $personal = Personal::find($id);

        return view('personal.show', compact('personal'));
    }

    public function edit($id)
    {
        $personal = Personal::find($id);

        return view('personal.edit', compact('personal'));
    }

    public function update(Request $request, $id)
    {
        request()->validate(Personal::$rules);

        $personal = Personal::find($id);

        if (!$personal) {
            return response()->json(['success' => false, 'message' => 'El registro no existe en la base de datos']);
        }

        try {
            $personal->update($request->all());
            return response()->json(['success' => true, 'personal' => $personal]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'No se pudo actualizar el registro']);
        }
    }

    public function destroy($id)
    {
        $personal = Personal::find($id)->delete();

        return response()->json(['success' => true, 'message' => 'Personal deleted successfully']);
    }
}

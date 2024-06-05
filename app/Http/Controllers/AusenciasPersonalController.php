<?php

namespace App\Http\Controllers;

use App\Models\AusenciasPersonal;
use App\Models\Personal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * Class AusenciasPersonalController
 * @package App\Http\Controllers
 */
class AusenciasPersonalController extends Controller
{
    public function index(Request $request)
    {
        $query = AusenciasPersonal::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('tipo', 'like', '%' . $search . '%')
                  ->orWhere('descripcion', 'like', '%' . $search . '%');
            });
        }

        $ausenciasPersonals = $query->paginate(10);
        $personals = Personal::all();

        return view('ausencias-personal.index', compact('ausenciasPersonals', 'personals'))
            ->with('i', (request()->input('page', 1) - 1) * $ausenciasPersonals->perPage());
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate(AusenciasPersonal::$rules);

        try {
            $ausenciasPersonal = AusenciasPersonal::create($validatedData);
            return response()->json(['success' => true, 'ausenciasPersonal' => $ausenciasPersonal]);
        } catch (\Exception $e) {
            Log::error('Error al crear el registro', ['exception' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'No se pudo crear el registro']);
        }
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate(AusenciasPersonal::$rules);

        $ausenciasPersonal = AusenciasPersonal::find($id);

        if(!$ausenciasPersonal){
            return response()->json(['success' => false, 'message' => 'El registro no existe en la base de datos']);
        }

        try {
            $updated = $ausenciasPersonal->update($validatedData);
            return response()->json(['success' => true, 'ausenciasPersonal' => $ausenciasPersonal]);
        } catch (\Exception $e) {
            Log::error('Error al actualizar el registro en la base de datos', ['exception' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'No se pudo actualizar el registro']);
        }
    }

    public function destroy($id)
    {
        $asuenciasPersonal = AusenciasPersonal::find($id)->delete();

        return redirect()->route('AusenciasPersonal.index')
        ->with('success', 'AusenciasPersonal deleted successfully');   
    }
}

<?php

namespace App\Http\Controllers;


$partialStoredRequests = [];

use App\Models\HorasPersonal;
use App\Models\OrdenesDeCompra;
use App\Models\Cliente;
use App\Models\Personal;
use App\Models\Tarea;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Barryvdh\Debugbar\Facade as Debugbar;

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
    public function index(Request $request)
    {
        $search = $request->get('search');
        if ($search) {
            $horasPersonals = HorasPersonal::whereHas('ordenDeCompra', function ($query) use ($search) {
                    $query->where('numeroOrdenInterna', 'like', '%' . $search . '%');
                })
                ->orWhereHas('cliente', function ($query) use ($search) {
                    $query->where('nombre', 'like', '%' . $search . '%');
                })
                ->orWhereHas('personal', function ($query) use ($search) {
                    $query->where('nombre', 'like', '%' . $search . '%');
                })
                ->orWhereHas('tarea', function ($query) use ($search) {
                    $query->where('nombre', 'like', '%' . $search . '%');
                })
                ->paginate(10);
        } else {
            $horasPersonals = HorasPersonal::paginate();
        }

        return view('horas-personal.index', compact('horasPersonals'))
            ->with('i', (request()->input('page', 1) - 1) * $horasPersonals->perPage())
            ->with('ordenesDeCompras', OrdenesDeCompra::all())
            ->with('clientes', Cliente::all())
            ->with('personals', Personal::all())
            ->with('tareas', Tarea::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $horasPersonal = new HorasPersonal();
        return view('horas-personal.create', compact('horasPersonal'))
            ->with('ordenesDeCompras', OrdenesDeCompra::all())
            ->with('clientes', Cliente::all())
            ->with('personals', Personal::all());
    }

    public function partialStore(Request $request)
    {
        global $partialStoredRequests;

        try {
            // Validate the request
            $request->validate(HorasPersonal::$rules);
        } catch (ValidationException $e) {
            // Log the validation exception
            Debugbar::error('Validation Exception: ' . $e->getMessage());

            // Optionally, log the validation errors in detail
            Debugbar::error($e->errors());

            // Continue to push the request into the array even if validation fails
        } catch (\Exception $e) {
            // Log any other exceptions
            Debugbar::error('Exception: ' . $e->getMessage());

            // Optionally, you can handle other exceptions if needed
        }

        // Add the request data to the global array
        $partialStoredRequests[] = $request->all();

        // Debugging line to check if the method is being hit and the content of $partialStoredRequests
        Debugbar::info('Request data added: ' + $request->all());
        Debugbar::info('All stored requests: ' + $partialStoredRequests);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    try {
        $request->validate(HorasPersonal::$rules);

        // Create the HorasPersonal entry
        $horasPersonal = HorasPersonal::create($request->all());

        // Return the response with additional client name
        return response()->json([
            'success' => true,
            'horasPersonal' => $horasPersonal,
            'personal_nombre' => Personal::find($horasPersonal->personal_id)->nombre,
            'numeroOrdenInterna' => OrdenesDeCompra::find($horasPersonal->orden_de_compra_id)->numeroOrdenInterna,
            'descripcionTarea' => OrdenesDeCompra::find($horasPersonal->orden_de_compra_id)->descripcionTarea,
        ]);
    } catch (\Exception $e) {
        // Log error for debugging
        \Log::error('Error: ', ['message' => $e->getMessage()]);

        return response()->json([
            'success' => false,
            'error' => $e->getMessage(),
        ], 500);
    }
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

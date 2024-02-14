<?php

namespace App\Http\Controllers;

use App\Models\Personal;
use App\Models\Cliente;
use App\Models\OrdenesDeCompra;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $personals = Personal::all();
        $clientes = Cliente::all();
        $ordenesDeCompra = OrdenesDeCompra::all();

        return view('home', compact('personals', 'clientes', 'ordenesDeCompra'));
    }
}

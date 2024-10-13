<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use Illuminate\Http\Request;

class RifaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Pago::select('numero', 'cliente_id', 'monto', 'user_id')
            ->where('estatus', 'comprado')
            ->distinct() // Seleccionar números únicos
            ->with('cliente') // Cargar la relación del cliente
            ->with('user')
            ->get();
        return response()->json([
            'status' => 'ok',
            'data' => $data
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $cliente_id, string $numero)
    {
        // // Agrupar por 'numero' y sumar el 'monto', incluyendo las relaciones de cliente y usuario
        $data = Pago::where("cliente_id", $cliente_id)
            ->where("numero", $numero)
            ->where("estatus", 'comprado')
            ->orderBy('numero', 'asc')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $cliente_id, string $numero)
    {
        $data = Pago::where('cliente_id', $cliente_id)
            ->where('numero', $numero)
            ->update(['estatus' => 'liberado']);
        // ->delete();
        return response()->json([
            'status' => 'ok',
            'message' => "data eliminada con éxito",
            'data' => $data
        ], 200);
    }
    public function list()
    {
        $data = Pago::all();
        return view('admin.rifas.index', compact('data'));
    }
}

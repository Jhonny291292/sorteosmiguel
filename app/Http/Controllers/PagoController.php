<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Pago;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Agrupar por 'numero' y sumar el 'monto', incluyendo las relaciones de cliente y usuario
        // $data = Pago::with(['cliente', 'user'])
        //     ->select('numero', 'cliente_id', 'user_id')
        //     ->selectRaw('SUM(monto) as total_pagado')
        //     ->groupBy('numero', 'cliente_id', 'user_id')
        //     ->get();

        // Agrupar por cliente y contar los números únicos comprados
        $data = Pago::select('cliente_id')
            ->selectRaw('COUNT(DISTINCT numero) as numeros_comprados')
            ->selectRaw('SUM(monto) as total_pagado')
            ->with('cliente') // Cargar la relación del cliente
            ->groupBy('cliente_id')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
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
        $cliente = Cliente::where('cedula', $request->cedula)->first();

        $data = Pago::create([
            'cliente_id' => $cliente->id,
            'numero' => $request->number,
            'user_id' => $request->user_id,
            'monto' => $request->monto
        ]);
        return response()->json([
            'status' => 'ok',
            'data' => $data
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Agrupar por 'numero' y sumar el 'monto', incluyendo las relaciones de cliente y usuario
        $data = Pago::with(['cliente', 'user'])
            ->where("cliente_id",$id)
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
    public function destroy(string $id)
    {
        $data = Pago::find($id)->delete();
        return response()->json([
            'status' => 'ok',
            'message' => "data eliminada con éxito"
        ], 200);
    }

    public function list()
    {
        $data = Pago::all();
        return view('admin.pagos.index', compact('data'));
    }
}

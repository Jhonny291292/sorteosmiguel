<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Pago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VentasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(string $id)
    {
        // Agrupar por 'numero' y sumar el 'monto', incluyendo las relaciones de cliente y usuario
        $data = Pago::with(['cliente', 'user'])
            ->select('numero', 'cliente_id', 'user_id')
            ->selectRaw('SUM(monto) as total_pagado')
            ->selectRaw('MAX(fecha) as fecha') // Trae la fecha más reciente
            ->selectRaw('MAX(estatus) as estatus') // Trae el estatus más reciente
            ->groupBy('numero', 'cliente_id', 'user_id')
            ->where("user_id", $id)
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
        //
    }

    public function list()
    {
        $usuarioId = Auth::id();
        $data = Cliente::with('user')->where('user_id', $usuarioId)->get();

        return view('admin.ventas.index', compact('data'));
    }
}

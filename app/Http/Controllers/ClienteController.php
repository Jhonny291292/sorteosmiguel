<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Cliente::all();
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
        $data = Cliente::create([
            'cedula' => $request->cedula,
            'nombre' => $request->nombre,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion
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
        $data = Cliente::where(function($query) use ($id) {
            $query->where('id', $id)
                  ->orWhere('cedula', $id);
        })->get();
        if ($data->isNotEmpty()) {
            return response()->json([
                'status' => 'ok',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Registro no encontrado'
            ], 404);
        }
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
        $data = Cliente::find($id);

        $data->fill([
            'cedula' => $request->cedula,
            'nombre' => $request->nombre,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion
        ])->save();

        return response()->json([
            'status' => 'ok',
            'data' => $request->email
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Cliente::find($id)->delete();
        return response()->json([
            'status' => 'ok',
            'message' => "data eliminada con éxito"
        ], 200);
    }
    public function list()
    {
        $data = Cliente::all();
        return view('admin.clientes.index', compact('data'));
    }
}

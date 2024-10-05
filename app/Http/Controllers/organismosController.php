<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organismo;

class organismosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Organismo::all();
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
        $data = Organismo::create([
            'nombre' => $request->nombre,
            'responsable' => $request->responsable,
            'telefono' => $request->telefono
            
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
        $data = Organismo::where('id', $id)->get();
        if ($data) {
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
        $data = Organismo::find($id)->fill($request->all())->save();
        return response()->json([
           'status' => 'ok',
            'data' => $data
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Organismo::find($id)->delete();
        return response()->json([
            'status' => 'ok',
            'message' => "data eliminada con éxito"
        ], 200);
    }

    public function list()
    {
        $data = Organismo::all();
        return view('admin.organismos.index', compact('data'));
    }
}

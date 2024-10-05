<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parroquia;
use App\Models\Municipio;

class parroquiasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $municipios = Municipio::where('estado_id', 19)->get();
        if ($municipios->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No se encontraron municipios con estado_id 19'
            ], 404);
        }
        $data = Parroquia::whereIn('municipio_id', $municipios->pluck('id'))->get();

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
    public function show(string $id)
    {
        $data = Parroquia::where('municipio_id', $id)->get();
        if ($data->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No se encontraron parroquias con municipio_id ' . $id
            ], 404);
        }
        return response()->json([
            'status' => 'ok',
            'data' => $data
        ], 200);
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
}

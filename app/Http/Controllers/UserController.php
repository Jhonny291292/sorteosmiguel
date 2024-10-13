<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public $rules = [
        'name' => 'required|string|max:255|unique:users,name',
        'email' => 'required|string|email|max:255|unique:users,email',
        'password' => 'string|min:8'
    ];

    public $messages = [
        'name.required' => 'Agrega un nombre',
        'name.unique' => 'Nombre de Usuario Repetido',
        'email.unique' => 'Email Repetido',
        'password.min' => 'Mínimo 8 caracteres para la contraseña'
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::all();
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

        try {
            // validación utilizando el método validate()
            $validatedData = $request->validate($this->rules, $this->messages);
        } catch (ValidationException $e) {
            // Obtiene los errores de validación
            $errors = $e->errors();
            return response()->json(
                [
                    'errors' => $errors
                ]
                ,
                422
            );
        }

        $data = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'rol' => $request->rol,
            'password' => Hash::make($request->password)
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
        $data = Pago::with(['cliente', 'user'])
            ->select('numero', 'cliente_id', 'user_id')
            ->selectRaw('SUM(monto) as total_pagado')
            ->groupBy('numero', 'cliente_id', 'user_id')
            ->where("user_id",$id)
            ->get();
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

        $rules = [
            'name' => 'required|string|max:255|unique:users,name,' . $id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8'
        ];

        $messages = [
            'name.required' => 'Agrega un nombre',
            'name.unique' => 'Nombre de Usuario Repetido',
            'email.unique' => 'Email Requerido',
            'email.required' => 'Email Repetido',
            'password.min' => 'Mínimo 8 caracteres para la contraseña'
        ];

        try {
            // validación utilizando el método validate()
            $validatedData = $request->validate($rules, $messages);
        } catch (ValidationException $e) {
            // Obtiene los errores de validación
            $errors = $e->errors();
            return response()->json(
                [
                    'errors' => $errors
                ]
                ,
                422
            );
        }

        $data = User::find($id);

        $data->fill(['name' => $request->name, 'email' => $request->email, 'rol' => $request->rol])->save();
        if ($request->password != "") {

            // try {
            //     // validación utilizando el método validate()
            //     // $validatedData = $request->validate($rules_pass, $messages_pass);
            // } catch (ValidationException $e) {
            //     // Obtiene los errores de validación
            //     $errors = $e->errors();
            //     return response()->json(
            //         [
            //             'errors' => $errors
            //         ]
            //         ,
            //         422
            //     );
            // }
            $data->fill(['password' => Hash::make($request->password)])->save();
        }
        // $data = User::find($id)->fill($request->all())->save();
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
        $data = User::find($id)->delete();
        return response()->json([
            'status' => 'ok',
            'message' => "data eliminada con éxito"
        ], 200);
    }

    public function list()
    {
        $data = User::all();
        return view('admin.usuarios.index', compact('data'));
    }
}

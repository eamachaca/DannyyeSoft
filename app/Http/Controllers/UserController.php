<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->api(Usuario::all(), 200, config('api.codes.list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make( $request->all(),$this->getRules($request->method()));
        if ($validator->fails())
            return response()->api($validator->errors(),406,config('api.codes.request'),config('api.messages.request'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Usuario $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Usuario $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuario $usuario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Usuario $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuario $usuario)
    {
        //
    }

    private function getRules($method)
    {
        $default = [
            "username" => "required",
            "email" => "required|email|unique:usuarios",
            "S_Nombre" => "nullable|string",
            "S_Apellidos" => "nullable|string",
            "S_FotoPerfilUrl" => "nullable|active_url",
            "password" => "required|min:6|max:16",
            "verified" => "required",
            "verification_token"=>'nullable',
        ];
        switch ($method) {
            case 'POST':
                $default = array_merge($default, ['S_Nombre' => 'required|string', 'S_Apellidos' => 'required|string']);
        }
        return $default;
    }
}

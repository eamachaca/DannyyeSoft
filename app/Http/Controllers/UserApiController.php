<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserApiController extends Controller
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
        $validator = Validator::make($request->all(), $this->getRules($request->method()));
        if ($validator->fails())
            return response()->api($validator->errors(), 406, config('api.codes.request'), config('api.messages.request'));
        try {
            $user = Usuario::create($this->getUserCreateApi($validator->validated()));
            return response()->api($user, 201, config('api.codes.create'), config('api.messages.create'));
        } catch (\Exception $ignored) {
            return response()->api(null, 403, config('api.codes.error'), config('api.messages.error'));
        }
    }

    private function getUserCreateApi($requested)
    {
        return $requested + ['S_Activo' => 1, 'S_Apellidos' => null, 'S_Nombre' => null, 'S_FotoPerfilUrl' => null, 'verified' => Str::random()];
    }

    /**
     * Display the specified resource.
     *
     * @param integer $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            return response()->api(Usuario::findOrFail($id), 202);
        } catch (\Exception $ignored) {
            return response()->api(null, 418, config('api.codes.request'), config('api.messages.request'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param integer $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), $this->getRules($request->method()));
        if ($validator->fails()) {
            return response()->api($validator->errors(), 406, config('api.codes.request'), config('api.messages.request'));
        }
        try {
            $user = Usuario::findOrFail($id);
            $user->update($this->removeNullValuesFromArray($validator->validated()));
            return response()->api($user, 201, config('api.codes.update'), config('api.messages.update'));
        } catch (\Exception $ignored) {
            return response()->api(null, 403, config('api.codes.error'), config('api.messages.error'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param integer $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            return response()->api(Usuario::findOrFail($id)->delete(), 202);
        } catch (\Exception $ignored) {
            return response()->api(null, 418, config('api.codes.request'), config('api.messages.request'));
        }
    }

    private function getRules($method)
    {
        if ($method == 'PATCH' || $method == 'PUT')
            $default = [
                'S_Nombre' => 'nullable|string',
                'S_Apellidos' => 'nullable|string',
                "S_FotoPerfilUrl" => "nullable|active_url",
                "S_Activo" => 'nullable|integer',
                "password" => "nullable|min:6|max:16"
            ];
        else
            $default = [
                "username" => "required|unique:usuarios",
                "email" => "required|email|unique:usuarios",
                "S_Nombre" => "nullable|string",
                "S_Apellidos" => "nullable|string",
                "S_FotoPerfilUrl" => "nullable|active_url",
                "password" => "required|min:6|max:16",
                "verified" => "required",
                "verification_token" => 'nullable',
            ];
        return $default;
    }

    private function removeNullValuesFromArray($array)
    {
        $result = [];
        foreach ($array as $key => $value) {
            if (!is_null($value))
                $result[$key] = $value;
        }
        return $result;
    }
}

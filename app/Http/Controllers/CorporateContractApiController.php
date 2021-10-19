<?php

namespace App\Http\Controllers;

use App\Models\ContratosCorporativo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CorporateContractApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->api(ContratosCorporativo::all(), 200, config('api.codes.list'));
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
            $corporateContract = ContratosCorporativo::create($validator->validated());
            return response()->api($corporateContract, 201, config('api.codes.create'), config('api.messages.create'));
        } catch (\Exception $ignored) {
            return response()->api(null, 510, config('api.codes.error'), config('api.messages.error'));
        }
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
            return response()->api(ContratosCorporativo::findOrFail($id), 202);
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
            $corporateContract = ContratosCorporativo::findOrFail($id);
            $corporateContract->update($this->removeNullValuesFromArray($validator->validated()));
            return response()->api($corporateContract, 201, config('api.codes.update'), config('api.messages.update'));
        } catch (\Exception $ignored) {
            return response()->api(null, 510, config('api.codes.error'), config('api.messages.error'));
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
            return response()->api(ContratosCorporativo::findOrFail($id)->delete(), 202);
        } catch (\Exception $ignored) {
            return response()->api(null, 418, config('api.codes.request'), config('api.messages.request'));
        }
    }

    private function getRules($method)
    {
        if ($method == 'PATCH' || $method == 'PUT')
            $default = [
                "D_FechaFin" => 'nullable|date',
                "S_URLContrato" => 'nullable|active_url',
            ];
        else
            $default = [
                "D_FechaInicio" => 'required|date',
                "D_FechaFin" => 'required|date',
                "S_URLContrato" => 'required|active_url',
                "tw_corporativos_id" => 'required|exists:corporativos,id',
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

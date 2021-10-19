<?php

namespace App\Http\Controllers;

use App\Models\EmpresasCorporativo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CompanyApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->api(EmpresasCorporativo::all(), 200, config('api.codes.list'));
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
            $company = EmpresasCorporativo::create($this->getCompanyCreateApi($validator->validated()));
            return response()->api($company, 201, config('api.codes.create'), config('api.messages.create'));
        } catch (\Exception $ignored) {
            return response()->api(null, 510, config('api.codes.error'), config('api.messages.error'));
        }
    }

    private function getCompanyCreateApi($requested)
    {
        return $requested + [ 'S_Activo' => 1,];
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
            return response()->api(EmpresasCorporativo::findOrFail($id), 202);
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
            $company = EmpresasCorporativo::findOrFail($id);
            $company->update($this->removeNullValuesFromArray($validator->validated()));
            return response()->api($company, 201, config('api.codes.update'), config('api.messages.update'));
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
            return response()->api(EmpresasCorporativo::findOrFail($id)->delete(), 202);
        } catch (\Exception $ignored) {
            return response()->api(null, 418, config('api.codes.request'), config('api.messages.request'));
        }
    }

    private function getRules($method)
    {
        if ($method == 'PATCH' || $method == 'PUT')
            $default = [
                'S_RazonSocial' => 'nullable|string',
                'S_RFC' => 'nullable|string',
                'S_Pais' => 'nullable|string',
                'S_Estado' => 'nullable|string',
                'S_Municipio' => 'nullable|string',
                'S_ColoniaLocalidad' => 'nullable|string',
                'S_Domicilio' => 'nullable|string',
                'S_CodigoPostal' => 'nullable|string',
                'S_UsoCFDI' => 'nullable|string',
                'S_UsoRFC' => 'nullable|string',
                'S_UrlActaConstitutiva' => 'nullable|active_url',
                "S_Activo" => 'nullable|integer',
                'S_Comentarios' => 'nullable|string',
            ];
        else
            $default = [
                'S_RazonSocial' => 'required|string',
                'S_RFC' => 'required|string',
                'S_Pais' => 'nullable|string',
                'S_Estado' => 'nullable|string',
                'S_Municipio' => 'nullable|string',
                'S_ColoniaLocalidad' => 'nullable|string',
                'S_Domicilio' => 'nullable|string',
                'S_CodigoPostal' => 'nullable|string',
                'S_UsoCFDI' => 'nullable|string',
                'S_UsoRFC' => 'nullable|string',
                'S_UrlActaConstitutiva' => 'nullable|active_url',
                'S_Comentarios' => 'nullable|string',
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

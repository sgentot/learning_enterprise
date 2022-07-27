<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CmEnterprise;
use App\Http\Resources\CmEnterpriseResource;
use Validator;


class CmEnterpriseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $enterprises = CmEnterprise::all();
        $message = 'Empresas obtenidos correctamente';
        $response = [
            'success' => true,
            'data'    => CmEnterpriseResource::collection($enterprises),
            'message' => $message,
        ];
        return response()->json($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $inputEnterprise = $request->all();
        $validator = Validator::make($inputEnterprise, [
          'enterprise' => ['required', 'unique:cm_enterprise', 'max:255'],
          'description' => ['required'],
          'contact' => ['required', 'max:25'],
        ]);
        if($validator->fails()){
          $response = [
            'success' => false,
            'message' => 'Validation Error.'
          ];
          if(!empty($validator->errors())){
            $response['data'] = $validator->errors();
          }
          return response()->json($response, 404);
        }
        $enterprise = CmEnterprise::create($inputEnterprise);
        $message = 'Empresa creada correctamente.';
        $response = [
          'success' => true,
          'data'    => new CmEnterpriseResource($enterprise),
          'message' => $message,
        ];
        return response()->json($response, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $enterprise = CmEnterprise::find($id);
        if (is_null($enterprise)) {
            return response()->json(
                        $response = [
                        'success' => false,
                        'message' => 'No se ha encontrado la empresa.'
                        ],
                        404);
        }
        $message = 'Empresa encontrada.';
        $response = [
            'success' => true,
            'data'    => new CmEnterpriseResource($enterprise),
            'message' => $message,
        ];
        return response()->json($response, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $enterprise = CmEnterprise::find($id);
    if (is_null($enterprise)) {
        return response()->json(
        $response = [
        'success' => false,
        'message' => 'Empresa no encontrado.'
        ],
        404);
    } else {
        $inputEnterprise = $request->all();
        $validator = Validator::make($inputEnterprise, [
        'enterprise' => ['required', 'unique:cm_enterprise', 'max:255'],
        'description' => ['required'],
        'contact' => ['required', 'max:25'],
        ]);
        if($validator->fails()){
        $response = [
            'success' => false,
            'dataIn' => $inputEnterprise,
            'id-pasado' =>$id,
            'message' => 'Validation Error.'
        ];
        if(!empty($validator->errors())){
            $response['data'] = $validator->errors();
        }
        return response()->json($response, 404);
        }
        $enterprise->enterprise = $request->input('enterprise');
        $enterprise->description = $request->input('description');
        $enterprise->contact = $request->input('contact');
        $enterprise->estate = $request->input('estate');
        $enterprise->elanguage = $request->input('elanguage');
        $enterprise->country = $request->input('country');
        $enterprise->currency = $request->input('currency');
        $enterprise->save();
        $message = 'Empresa actualizada.';
        $response = [
        'success' => true,
        'data'    => new CmEnterpriseResource($enterprise),
        'message' => $message,
        ];
        return response()->json($response, 200);
    }
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            //
            $enterprise = CmEnterprise::find($id);
            if (is_null($enterprise)) {
                return response()->json(
                    $response = [
                        'success' => false,
                        'message' => 'Empresa no encontrada para eliminar.'
                    ],
                    404);
            } else {
                $lenterprise = $enterprise->enterprise;
                  
                $numCustomers = 0;
                // Necesitamos comprobar la integridad del borrado, si se utiliza en clientes no se puede borrar.
                if ($numCustomers > 0) {
                    return response()->json(
                        $response = [
                            'success' => false,
                            'message' => 'La empresa '.$lenterprise.' no se puede borrar porque está siendo utilizado en clientes',
                        ], 304);
                } else {
                    $enterprise->delete();
                    $response = [
                        'success' => true,
                        'message' => 'La empresa '.$lenterprise.' se ha borrado correctamente',
                    ];
                    return response()->json($response, 204);
                }
            }
        }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CmCustomerResource;
use Illuminate\Http\Request;
use App\Models\CmCustomer;
use App\Models\CmEnterprise;
use Validator;


class CmCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $customers = CmCustomer::all();
        $message = 'Clientes obtenidos correctamente';
        $response = [
            'success' => true,
            'data'    => CmCustomerResource::collection($customers),
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
        $inputCustomer = $request->all();
 
        $validator = Validator::make($inputCustomer, [
            'customer' => ['required', 'unique:cm_customer', 'max:255'],
            'contact' => ['required', 'max:15'],
            'identerprise' => ['required'],
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
        $enterprise = CmEnterprise::find($inputCustomer['identerprise']);
        if (!isset($enterprise)) {
            $response = [
                'success' => false,
                'message' => 'Enterprise not exists.'
            ];
            return response()->json($response, 404);
        }
     
        $customer = CmCustomer::create($inputCustomer);
     
        $message = 'Cliente creado correctamente.';
        $response = [
            'success' => true,
            'data'    => new CmCustomerResource($customer),
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
        $customer = CmCustomer::find($id);
    if (is_null($customer)) {
        return response()->json(
            $response = [
                    'success' => false,
                    'message' => 'No se ha encontrado el cliente.'
                ],
                404);
    }
    $message = 'Cliente encontrado.';
    $response = [
        'success' => true,
        'data'    => new CmCustomerResource($customer),
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
        $customer = CmCustomer::find($id);
    if (is_null($customer)) {
        return response()->json(
        $response = [
                'success' => false,
                'message' => 'Cliente no encontrado.'
            ],
            404);
    } else {
        $inputCustomer = $request->all();
        $validator = Validator::make($inputCustomer, [
            'customer' =>  ['required', Rule::unique('cm_customer')->ignore($customer)],
            'contact' => ['required', 'max:250'],
            'identerprise' => ['required'],
        ]);
        if($validator->fails()) {
            $response = [
                'success' => false,
                'dataIn' => $inputCustomer,
                'id-pasado' =>$id,
                'message' => 'Validation Error.'
            ];
            if(!empty($validator->errors())){
                $response['data'] = $validator->errors();
            }
            return response()->json($response, 404);
        }
        $customer->identerprise = $request->input('identerprise');
        $customer->customer = $request->input('customer');
        $customer->contact = $request->input('contact');
        $customer->customerstate = $request->input('customerstate');
        $customer->paymentmethod = $request->input('paymentmethod');
        $customer->elanguage = $request->input('elanguage');
        $customer->country = $request->input('country');
        $customer->currency = $request->input('currency');
        $customer->address = $request->input('address');
        $customer->save();
        $message = 'Cliente actualizado.';
        $response = [
            'success' => true,
            'data'    => new CmCustomerResource($customer),
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
        public function destroy($idcustomer)
        {
            //
            $customer = CmCustomer::find($idcustomer);
            $lcustomer = $customer->customer; 
            // No podremos borrar el cliente si tiene pedidos asignados (lo veremos en el futuro)
            $customer->delete(); 
            $response = [
              'success' => true,
              'message' => 'El cliente '.$lcustomer.' se ha borrado correctamente',
            ];
            return response()->json($response, 200);
        }
}

<?php

namespace App\Http\Controllers\Customer;

use App\Enums\UserType;
use App\Http\Controllers\Controller;
use App\Http\Repository\UtilityRepository;
use App\Models\Customer\CmnCustomer;
use App\Models\Booking\SchServiceBooking;
use App\Models\CmnCitas;
use App\Models\Customer\CmAntecedente;
use App\Models\Customer\CmInmu;
use App\Models\Customer\CmCirugia;
use App\Models\Customer\CmDespa;
use App\Models\Customer\CmPeluqueria;
use App\Models\Customer\CmnPet;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function customer()
    {
        return view('customer.customer');
    }

    public function customerStore(Request $data)
    {
        Log::info($data->all());
        try {
            $validator = Validator::make($data->all(), [
                'full_name' => ['required', 'string'],
                'email' => ['required', 'string', 'unique:cmn_customers,email'],
                'phone_no' => ['required', 'string', 'unique:cmn_customers,phone_no', 'max:20']
            ]);
            if (!$validator->fails()) {
                $data['user_id'] =  $data['user_id']=UtilityRepository::emptyToNull($data->user_id);               
                //create new user
                if ($data->user_id == 0) {
                    $userId =   User::create(
                        [
                            'name' => $data->full_name,
                            'username' => $data->email,
                            'password' => Hash::make('123456'),
                            'email' => $data->email,
                            'email_verified_at' => Carbon::now(),
                            'is_sys_adm' => 0,
                            'status' => 1,
                            'user_type' => UserType::WebsiteUser
                        ]
                    );
                    $data['user_id'] = $userId->id;
                }


                $data['id'] = null;
                $data['created_at'] = auth()->id();
                $data['dob']=UtilityRepository::emptyToNull($data->dob);
                $rtr = CmnCustomer::create($data->all());
                $customerId =$rtr->id;
                $savePet= [
                    'id_dueno' => $customerId ,
                    'nombre' => $data->pet_name,
                    'especie' => $data->especie,
                    'sexo' => $data->sex,
                    'otro_esp' => $data->otro_especie,
                    'created_by' => 1,
                    'raza' => $data->raza,
                    //'color' => $data->color,
                    'estado_repro' => $data->repro,
                    'pet_birth_date' => $data->nac 
                    
                ];
                $petRtn = CmnPet::create($savePet);
                $petId = $petRtn->id;
                return $this->apiResponse(['status' => '1', 'data' => ['cmn_customer_id' => $rtr->id, 'petdropdown' => $petId]], 200);
            }
            Log::info($data->all());
            return $this->apiResponse(['status' => '500', 'data' => $validator->errors()], 400);
        } catch (Exception $ex) {
            Log::info($ex);
            return $this->apiResponse(['status' => '501', 'data' => $ex], 400);
        }
    }

    public function citaStore(Request $request)
{   
    // dd($request->all());
    //$mascota = CmnCustomer::findOrFail($request->cmn_pet_idconsu);
    // Validación de los datos del formulario
    if ($request->tieneconsu == 0) {
        // Crear una nueva cita
        $cita = new CmnCitas;
    } else {
        // Actualizar una cita existente
        // Asegúrate de que tienes un identificador único para buscar la cita existente
        $cita = CmnCitas::findOrFail($request->id);
    }

    // Asignar los valores del formulario a la cita
    $cita->id_cliente = $request->serviceIdconsu;
    $cita->id_pet  = $request->cmn_pet_idconsu;
    $cita->peso = $request->peso;
    $cita->vive_otros = $request->vive_otros;
    $cita->vive_otrosn = $request->vive_otrosn;
    $cita->tipo_alim = $request->tipo_alim;
    $cita->tipo_alim_marca = $request->tipo_alim_marca;
    $cita->depo = $request->depo;
    $cita->obs = $request->reason;
    $cita->temperatura = $request->temperatura;
    $cita->ganglios_r = $request->ganglios_r;
    $cita->ganglios_p = $request->ganglios_p;
    $cita->fonendo = $request->fonendo;
    $cita->palpitacion_abd = $request->palpitacion_abd;
    $cita->piel = $request->piel;
    $cita->peso_2 = $request->peso_2;
    $cita->obeso = $request->obeso;
    $cita->imagenes = $request->imagenes;
    //consulta
    $cita->razon = $request->razon;
    $cita->anamnesis = $request->anamnesis;
    $cita->notas_anam = $request->notas_anam;
    				//prediag

                    $cita->notas_prediag = $request->notas_prediag;
                    //examen fisico

                    $cita->mucosa = $request->mucosa;
                    $cita->timpo_cap = $request->timpo_cap;
                    $cita->frecuencia_resp = $request->frecuencia_resp;
                    $cita->frecuencia_car = $request->frecuencia_car;
                    $cita->presion = $request->presion;
                    $cita->condicion_corp = $request->condicion_corp;
                    $cita->desidra = $request->desidra;
                    $cita->ndesidra = $request->ndesidra;
                    //examenes

                    $cita->examen = $request->examen;
                    $cita->notas_examen = $request->notas_examen;
                    //tratamientos
                
                    $cita->notas_trata = $request->notas_trata;

                    //Diagnostico

                    $cita->notas_diag = $request->notas_diag;

    // Guardar la cita
    $cita->save();


   // $booking = SchServiceBooking::findOrFail($request->serviceId);
    // $booking->status = 1;
    // $booking->save();

    // Redireccionar con un mensaje de éxito
    return back()->with('success', $request->tieneconsu == 0 ? 'Consulta creada exitosamente' : 'Consulta actualizada exitosamente');
}

    public function inmuStore(Request $request)
    {   //dd($request->all());

        if ($request->tieneinmu == 0) {
            // Crear una nueva cita
            $cita = new CmInmu;
        } else {
            // Actualizar una cita existente
            // Asegúrate de que tienes un identificador único para buscar la cita existente
            $cita = CmInmu::findOrFail($request->idinmu);
        }
        Log::info('Validacion variable tiene'.$request->tiene );
        // Asignar los valores del formulario a la cita
        $cita->id_cliente = $request->serviceIdinmu;
        $cita->id_pet  = $request->cmn_pet_idinmu;
        $cita->nombre_vacuna = $request->nombre_vacuna;
        $cita->n_serie = $request->n_serie;
        $cita->cantidad = $request->inmu_cant;
        $cita->unidad = $request->inmu_unidad;
        $cita->notas_inmu = $request->notas_inmu;

        // Guardar la cita
        $cita->save();
        Log::info('Se guarda el registro0' );

        // $booking = CmInmu::findOrFail($validatedData['serviceIdinmu']);
        // $booking->status = 1;
        // $booking->save();

        // Redireccionar con un mensaje de éxito
        return back()->with('success', $request->tiene == 0 ? 'Consulta creada exitosamente' : 'Consulta actualizada exitosamente');
    }

    public function despaStore(Request $request)
    {   //dd($request->all());
        Log::info('se valida lael id0');
        if ($request->tienedespa == 0) {
            // Crear una nueva cita
            $cita = new Cmdespa;
        } else {
            // Actualizar una cita existente
            // Asegúrate de que tienes un identificador único para buscar la cita existente
            $cita = Cmdespa::findOrFail($request->iddespa);
        }
        Log::info('Validacion variable tiene');
        // Asignar los valores del formulario a la cita
        $cita->id_cliente = $request->serviceIddespa;
        $cita->id_pet  = $request->cmn_pet_iddespa;
        $cita->nombre_despa = $request->nombre_despa;
        $cita->dosis = $request->dosis;
        $cita->presentacion = $request->presentacion;
        $cita->cantidad = $request->despa_cant;
        $cita->unidad = $request->despa_unidad;
        $cita->notas_despa = $request->notas_despa;
        $cita->anti_in = $request->anti_in;
        $cita->anti_ex = $request->anti_ex;
        $cita->anti_recorda = $request->anti_recorda;

        // Guardar la cita
        $cita->save();
        Log::info('Se guarda el registro0' );

        // $booking = CmInmu::findOrFail($validatedData['serviceIdinmu']);
        // $booking->status = 1;
        // $booking->save();

        // Redireccionar con un mensaje de éxito
        return back()->with('success', $request->tiene == 0 ? 'Consulta creada exitosamente' : 'Consulta actualizada exitosamente');
    }

    public function cirugiaStore(Request $request)
    {   //dd($request->all());
        // Validación de los datos del formulario

        Log::info('se valida lael id0');
        if ($request->tienecirugia == 0) {
            // Crear una nueva cita
            $cita = new CmCirugia;
        } else {
            // Actualizar una cita existente
            // Asegúrate de que tienes un identificador único para buscar la cita existente
            $cita = CmCirugia::findOrFail($request->idcirugia);
        }

        // Asignar los valores del formulario a la cita
        $cita->id_cliente = $request->serviceIdcirugia;
        $cita->id_pet  = $request->cmn_pet_idcirugia;
        $cita->nombre_cirugia = $request->nombre_cirugia;
        $cita->notas_cirugia = $request->notas_cirugia;
        $cita->eval_anestesica = $request->eval_anestesica;
        $cita->eval_asa = $request->eval_asa;
        $cita->updated_at = now();
        // $cita->notas_despa = $request->notas_despa;
        // $cita->anti_in = $request->anti_in;
        // $cita->anti_ex = $request->anti_ex;
        // $cita->anti_recorda = $request->anti_recorda;
        Log::info('se guarda la cita');
        // Guardar la cita
        $cita->save();

        // Redireccionar con un mensaje de éxito
        return back()->with('success', $request->tienecirugia == 0 ? 'Consulta creada exitosamente' : 'Consulta actualizada exitosamente');
    }

    public function peluStore(Request $request)
    {   //dd($request->all());
        // Validación de los datos del formulario
        Log::info('se valida lael id0');
        if ($request->tienepelu == 0) {
            // Crear una nueva cita
            $cita = new CmPeluqueria;
        } else {
            // Actualizar una cita existente
            // Asegúrate de que tienes un identificador único para buscar la cita existente
            $cita = CmPeluqueria::findOrFail($request->idpelu);
        }
        Log::info('se valida la actializacion');
        // Asignar los valores del formulario a la cita
        $cita->id_cliente = $request->serviceIdpelu;
        $cita->id_pet  = $request->cmn_pet_idpelu;
        $cita->tipo_corte = $request->tipo_corte;
        $cita->notas_pelu = $request->notas_pelu;
        $cita->tipo_bano = $request->tipo_bano;

        $cita->updated_at = now();
        // $cita->notas_despa = $request->notas_despa;
        // $cita->anti_in = $request->anti_in;
        // $cita->anti_ex = $request->anti_ex;
        // $cita->anti_recorda = $request->anti_recorda;
        Log::info('se guarda la cita');
        // Guardar la cita
        $cita->save();

        // Redireccionar con un mensaje de éxito
        return back()->with('success', $request->tienepelu == 0 ? 'Consulta creada exitosamente' : 'Consulta actualizada exitosamente');
    }

    public function cliStore(Request $request)
    {   //dd($request->all());

        if ($request->tienecli == 0) {
            // Crear una nueva cita
            $cita = new CmnCustomer;
            $pet = new CmnPet;
        } else {
            // Actualizar una cita existente
            // Asegúrate de que tienes un identificador único para buscar la cita existente
            $cita = CmnCustomer::findOrFail($request->id_dueno);
            $pet = CmnPet::findOrFail($request->cmn_pet_idcli);
        }
        Log::info('Validacion variable tiene'.$request->tienecli);
        // Asignar los valores del formulario a la cita
        $cita->full_name = $request->nombrecli;
        $cita->direccion = $request->direccioncli;
        $cita->phone_no = $request->phone_nocli;
        
        $pet->especie  = $request->especiecli;
        $pet->nombre=$request->nombrepet;
        $pet->raza=$request->razacli;
        $pet->sexo  = $request->sexocli;
        $pet->pet_birth_date=$request->pet_birth_datecli;
        $pet->color  = $request->colorcli;
        $pet->micro_num=$request->microcli;
        $pet->estado_repro=$request->estado_reprocli;

        // Guardar la cita
        $cita->save();
        $pet->save();
        Log::info('Se guarda el registro0' );

        // $booking = CmInmu::findOrFail($validatedData['serviceIdinmu']);
        // $booking->status = 1;
        // $booking->save();

        // Redireccionar con un mensaje de éxito
        return back()->with('success', $request->tiene == 0 ? 'Consulta creada exitosamente' : 'Consulta actualizada exitosamente');
    }

    public function anteStore(Request $request)
    {   //dd($request->all());

        if ($request->tieneante == 0) {
            // Crear una nueva cita
            $cita = new CmAntecedente;
            Log::info('Se verifica que no tiene registro' );
        } else {
            // Actualizar una cita existente
            // Asegúrate de que tienes un identificador único para buscar la cita existente
            $cita = CmAntecedente::findOrFail($request->id_petante);
        }
        Log::info('Validacion variable tiene'.$request->tieneante);
        // Asignar los valores del formulario a la cita
        $cita->id_pet = $request->cmn_pet_idante;
        $cita->origen = $request->origenante;
        $cita->habitat = $request->habitatante;
        $cita->comportamiento = $request->comportamientoante;
        $cita->enfermedades = $request->enfermedadesante;
        $cita->alergias = $request->alergiasante;
        


        // Guardar la cita
        $cita->save();
        Log::info('Se guarda el registro0' );

        // $booking = CmInmu::findOrFail($validatedData['serviceIdinmu']);
        // $booking->status = 1;
        // $booking->save();

        // Redireccionar con un mensaje de éxito
        return back()->with('success', $request->tiene == 0 ? 'Consulta creada exitosamente' : 'Consulta actualizada exitosamente');
    }





    public function obtenerCita($serviceId)
    {
        // Busca los datos en tu modelo, por ejemplo, CMN_CITAS
        // $datos = CmnCitas::where('id_cliente', $serviceId)->first();
        $datos =  CmnCitas::select('cmn_citas.*', 'cmn_pets.id as pet_id', 'cmn_pets.pet_birth_date')
        ->join('cmn_pets', 'cmn_citas.id_pet', '=', 'cmn_pets.id')
        ->where('cmn_citas.id_cliente', $serviceId)
        ->first();
        if ($datos) {
            return response()->json($datos);
        } else {
            return response()->json(null);
        }
    }

    public function obtenerInmu($serviceId)
    {
        // Busca los datos en tu modelo, por ejemplo, CMN_CITAS
        // $datos = CmnCitas::where('id_cliente', $serviceId)->first();
        $datos =  CmInmu::select('cm_inmu.*', 'cmn_pets.id as pet_id', 'cmn_pets.pet_birth_date')
        ->join('cmn_pets', 'cm_inmu.id_pet', '=', 'cmn_pets.id')
        ->where('cm_inmu.id_cliente', $serviceId)
        ->first();
        if ($datos) {
            return response()->json($datos);
        } else {
            return response()->json(null);
        }
    }
    public function obtenerDespa($serviceId)
    {
        // Busca los datos en tu modelo, por ejemplo, CMN_CITAS
        // $datos = CmnCitas::where('id_cliente', $serviceId)->first();
        $datos =  CmDespa::select('cm_despa.*', 'cmn_pets.id as pet_id', 'cmn_pets.pet_birth_date')
        ->join('cmn_pets', 'cm_despa.id_pet', '=', 'cmn_pets.id')
        ->where('cm_despa.id_cliente', $serviceId)
        ->first();
        if ($datos) {
            return response()->json($datos);
        } else {
            return response()->json(null);
        }
    }

    public function obtenerCirugia($serviceId)
    {
        // Busca los datos en tu modelo, por ejemplo, CMN_CITAS
        // $datos = CmnCitas::where('id_cliente', $serviceId)->first();
        $datos =  CmCirugia::select('cm_cirugia.*', 'cmn_pets.id as pet_id', 'cmn_pets.pet_birth_date')
        ->join('cmn_pets', 'cm_cirugia.id_pet', '=', 'cmn_pets.id')
        ->where('cm_cirugia.id_cliente', $serviceId)
        ->first();
        if ($datos) {
            return response()->json($datos);
        } else {
            return response()->json(null);
        }
    }

    public function obtenerPelu($serviceId)
    {
        // Busca los datos en tu modelo, por ejemplo, CMN_CITAS
        // $datos = CmnCitas::where('id_cliente', $serviceId)->first();
        $datos =  CmPeluqueria::select('cm_peluqueria.*', 'cmn_pets.id as pet_id', 'cmn_pets.pet_birth_date')
        ->join('cmn_pets', 'cm_peluqueria.id_pet', '=', 'cmn_pets.id')
        ->where('cm_peluqueria.id', $serviceId)
        ->first();
        if ($datos) {
            return response()->json($datos);
        } else {
            return response()->json(null);
        }
    }

    /* datos desde el detalle de las <mascotas */ 

    
    public function obtenerInmupet($serviceId)
    {
        // Busca los datos en tu modelo, por ejemplo, CMN_CITAS
        // $datos = CmnCitas::where('id_cliente', $serviceId)->first();
        $datos =  CmInmu::select('cm_inmu.*', 'cmn_pets.id as pet_id', 'cmn_pets.pet_birth_date')
        ->join('cmn_pets', 'cm_inmu.id_pet', '=', 'cmn_pets.id')
        ->where('cm_inmu.id', $serviceId)
        ->first();
        if ($datos) {
            return response()->json($datos);
        } else {
            return response()->json(null);
        }
    }

    public function obtenerDespapet($serviceId)
    {
        // Busca los datos en tu modelo, por ejemplo, CMN_CITAS
        // $datos = CmnCitas::where('id_cliente', $serviceId)->first();
        $datos =  CmDespa::select('cm_despa.*', 'cmn_pets.id as pet_id', 'cmn_pets.pet_birth_date')
        ->join('cmn_pets', 'cm_despa.id_pet', '=', 'cmn_pets.id')
        ->where('cm_despa.id', $serviceId)
        ->first();
        if ($datos) {
            return response()->json($datos);
        } else {
            return response()->json(null);
        }
    }
    public function obtenerCirugiapet($serviceId)
    {
        // Busca los datos en tu modelo, por ejemplo, CMN_CITAS
        // $datos = CmnCitas::where('id_cliente', $serviceId)->first();
        $datos =  CmCirugia::select('cm_cirugia.*', 'cmn_pets.id as pet_id', 'cmn_pets.pet_birth_date')
        ->join('cmn_pets', 'cm_cirugia.id_pet', '=', 'cmn_pets.id')
        ->where('cm_cirugia.id', $serviceId)
        ->first();
        if ($datos) {
            return response()->json($datos);
        } else {
            return response()->json(null);
        }
    }

    public function obtenerPelupet($serviceId)
    {
        // Busca los datos en tu modelo, por ejemplo, CMN_CITAS
        // $datos = CmnCitas::where('id_cliente', $serviceId)->first();
        $datos =  CmPeluqueria::select('cm_peluqueria.*', 'cmn_pets.id as pet_id', 'cmn_pets.pet_birth_date')
        ->join('cmn_pets', 'cm_peluqueria.id_pet', '=', 'cmn_pets.id')
        ->where('cm_peluqueria.id', $serviceId)
        ->first();
        if ($datos) {
            return response()->json($datos);
        } else {
            return response()->json(null);
        }
    }

    public function obtenerConsu($serviceId)
    {
        // Busca los datos en tu modelo, por ejemplo, CMN_CITAS
        // $datos = CmnCitas::where('id_cliente', $serviceId)->first();
        $datos =  CmnCitas::select('cmn_citas.*', 'cmn_customers.id as customer_id', 'cmn_pets.pet_birth_date')
        ->join('cmn_pets', 'cmn_citas.id_pet', '=', 'cmn_pets.id')
        ->join('cmn_customers', 'cmn_pets.id_dueno', '=', 'cmn_customers.id')
        ->where('cmn_citas.id', $serviceId)
        ->first();

        if ($datos) {
            return response()->json($datos);
        } else {
            return response()->json(null);
        }
    }
    //Datos Cliente y mascota

    public function obtenerPet($serviceId)
    {
        // Busca los datos en tu modelo, por ejemplo, CMN_CITAS
        // $datos = CmnCitas::where('id_cliente', $serviceId)->first();
        $datos = CmnPet::select('cmn_pets.*', 'cmn_pets.id as pet_id', 'cmn_customers.*')
        ->join('cmn_customers', 'cmn_pets.id_dueno', '=', 'cmn_customers.id')
        ->where('cmn_pets.id', $serviceId)
        ->first();
        if ($datos) {
            return response()->json($datos);
        } else {
            return response()->json(null);
        }
    }

    public function obtenerantePet($serviceId)
    {
        // Busca los datos en tu modelo, por ejemplo, CMN_CITAS
        // $datos = CmnCitas::where('id_cliente', $serviceId)->first();
        $datos = CmnPet::select('cmn_pets.*', 'cmn_pets.id as pet_id', 'cm_antecedentes.*')
        ->join('cm_antecedentes', 'cmn_pets.id', '=', 'cm_antecedentes.id')
        ->where('cm_antecedentes.id_pet', $serviceId)
        ->first();
        if ($datos) {
            return response()->json($datos);
        } else {
            return response()->json(null);
        }
    }
    


     /* findatos desde el detalle de las <mascotas */ 


    public function customerUpdate(Request $data)
    {
        try {
            $validator = Validator::make($data->all(), [
                'full_name' => ['required', 'string'],
                'email' => ['required', 'string', 'unique:cmn_customers,email,' . $data->id . ',id'],
                'phone_no' => ['required', 'string', 'unique:cmn_customers,phone_no,' . $data->id . ',id', 'max:20'],
                'street_address' => ['required', 'string']
            ]);
            if (!$validator->fails()) {
                //create new user
                $data['user_id']=UtilityRepository::emptyToNull($data->user_id);
                if ($data->user_id == 0) {
                    $userId =   User::create(
                        [
                            'name' => $data->full_name,
                            'username' => $data->phone_no,
                            'password' => Hash::make('12345678'),
                            'email' => $data->email,
                            'email_verified_at' => Carbon::now(),
                            'is_sys_adm' => 0,
                            'status' => 1,
                            'user_type' => UserType::WebsiteUser
                        ]
                    );
                    $data['user_id'] = $userId->id;
                } else {
                    $savedUser = User::where('id', $data->user_id)->first();
                    if ($savedUser != null) {
                        $savedUser->email = $data->email;
                        $data->name = $data->full_name;
                        $savedUser->update();
                    }
                }
                $data['dob']=UtilityRepository::emptyToNull($data->dob);
                CmnCustomer::where('id', $data->id)->update($data->toArray());
                return $this->apiResponse(['status' => '1', 'data' => ''], 200);
            }
            return $this->apiResponse(['status' => '500', 'data' => $validator->errors()], 400);
        } catch (Exception $ex) {
            return $this->apiResponse(['status' => '501', 'data' => $ex], 400);
        }
    }

    public function customerDelete(Request $data)
    {
        try {
            $rtr = CmnCustomer::where('id', $data->id)->delete();
            return $this->apiResponse(['status' => '1', 'data' => $rtr], 200);
        } catch (Exception $ex) {
            return $this->apiResponse(['status' => '501', 'data' => $ex], 400);
        }
    }

    public function getAllCustomer()
    {
        try {
            $data = CmnCustomer::select(
                '*'
            )->get();
            return $this->apiResponse(['status' => '1', 'data' => $data], 200);
        } catch (Exception $qx) {
            return $this->apiResponse(['status' => '403', 'data' => $qx], 400);
        }
    }
}
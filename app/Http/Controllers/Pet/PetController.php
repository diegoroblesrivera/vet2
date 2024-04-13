<?php

namespace App\Http\Controllers\Pet;

use App\Enums\UserType;
use App\Http\Controllers\Controller;
use App\Http\Repository\UtilityRepository;
use App\Models\Customer\CmnPet;
use App\Models\Customer\CmAntecedente;
use App\Models\Customer\CmExamenes;
use App\Models\Customer\CmFiles;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;
use Imagick;
use Illuminate\Support\Facades\Storage;


class PetController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    // public function pet()
    // {
    //     return view('pet.pet');
    // }


    public function pet()
    {
        return view('pet.pet');
    }
    public function pets()
    {
        return view('pet.pets');
    }

    public function petdeta($id)
    {
        $query = "
        (SELECT con.id as conid,con.id_pet, 'Consulta' AS tipo_evento, con.razon, con.notas_anam, con.created_at
        FROM cmn_citas con
        JOIN cmn_pets pe ON pe.id = con.id_pet
        WHERE con.id_pet = ?)

        UNION ALL

        (SELECT c.id as peluid,c.id_pet, 'Peluqueria' AS tipo_evento, c.tipo_corte, c.tipo_bano, c.created_at
        FROM cm_peluqueria c
        WHERE c.id_pet = ?)

        UNION ALL

        (SELECT d.id as despaid,d.id_pet, 'Desparasitación' AS tipo_evento, d.nombre_despa, d.dosis, d.created_at
        FROM cm_despa d
        WHERE d.id_pet = ?)

        UNION ALL

        (SELECT ci.id as ciruid,ci.id_pet, 'Cirugía' AS tipo_evento, ci.nombre_cirugia, ci.eval_anestesica, ci.created_at
        FROM cm_cirugia ci
        WHERE ci.id_pet = ?)

        UNION ALL

        (SELECT i.id as inmuid, i.id_pet, 'Inmunización' AS tipo_evento, i.nombre_vacuna, i.n_serie, i.created_at
        FROM cm_inmu i
        WHERE i.id_pet = ?)
        order by created_at DESC
    ";

    $eventos = DB::select(DB::raw($query), [$id, $id, $id, $id, $id]);

        // Asumiendo que estás dentro de un método de un controlador

            // Obtener la mascota por su id con el dueño relacionado
            $pets = CmnPet::with('owner')->findOrFail($id);

            // Ahora $pet contiene la información de la mascota y $pet->owner contiene la información del dueño

            $ant = optional(CmAntecedente::where('id_pet', $id)->first());
            $examenes = CmExamenes::all();

            $files = CmFiles::where('id_pet', $id)
                ->orderBy('created_at', 'desc')
                ->get();
          

            //dd($pets);
            return view('pet.show', ['id' => $id], compact('pets', 'eventos', 'ant','examenes', 'files' ));
    }

        // Método para actualizar el estado de la mascota
        public function actualizarEstado(Request $request)
        {
            // Obtén el ID de la mascota y el nuevo estado de la solicitud AJAX
            $idMascota = $request->input('id');
            $nuevoEstado = $request->input('nuevo_estado');
    
            // Busca la mascota en la base de datos por su ID
            $mascota = CmnPet::find($idMascota);
    
            // Si la mascota existe
            if ($mascota) {
                // Actualiza el estado de la mascota
                $mascota->estado_pet = $nuevoEstado;
                $mascota->save();
    
                // Devuelve una respuesta JSON con el nuevo estado
                return response()->json(['nuevo_estado' => $nuevoEstado]);
            } else {
                // Si no se encuentra la mascota, devuelve un error
                return response()->json(['error' => 'Mascota no encontrada'], 404);
            }
        }
    


    public function actualizarImagen(Request $request, $id) {
        // Obtener la mascota por su ID
        $pet = CmnPet::findOrFail($id);
    
        // Validar la solicitud y guardar la imagen
        if($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
    
            // Obtener el año y mes actual
            $anoMesActual = date('Y/m');
    
            // Crear la ruta de la carpeta donde se guardarán las imágenes
            $rutaCarpeta = 'uploadfiles/' . $anoMesActual;
    
            // Verificar si la carpeta no existe y crearla si es necesario
            if (!Storage::exists($rutaCarpeta)) {
                Storage::makeDirectory($rutaCarpeta, 0777, true);
            }
    
            // Generar un nombre único para la imagen
            $nombreImagen = time() . '.' . $imagen->getClientOriginalExtension();
    
            // Ruta completa donde se guardará la imagen (incluyendo la carpeta del mes y año)
            $rutaImagen = $rutaCarpeta . '/' . $nombreImagen;
    
            // Redimensionar y guardar la imagen utilizando Intervention Image
            $imagenRedimensionada = Image::make($imagen)->fit(100, 100);
            $imagenRedimensionada->save(public_path($rutaImagen));
    
            // Actualizar la ruta de la imagen en la mascota
            $pet->imagen_pet = $rutaImagen;
            $pet->save();
        }
    
        return redirect()->back()->with('success', 'Imagen de la mascota actualizada correctamente.');
    }
    
    

    public function petdeta2($id)
    {
        $query = "
        (SELECT con.id_pet, 'Consulta' AS tipo_evento, con.razon, con.notas_anam, con.created_at
        FROM cmn_citas con
        JOIN cmn_pets pe ON pe.id = con.id_pet
        WHERE con.id_pet = ?)

        UNION ALL

        (SELECT c.id_pet, 'Peluqueria' AS tipo_evento, c.tipo_corte, c.tipo_bano, c.created_at
        FROM cm_peluqueria c
        WHERE c.id_pet = ?)

        UNION ALL

        (SELECT d.id_pet, 'Desparasitación' AS tipo_evento, d.nombre_despa, d.dosis, d.created_at
        FROM cm_despa d
        WHERE d.id_pet = ?)

        UNION ALL

        (SELECT ci.id_pet, 'Cirugía' AS tipo_evento, ci.nombre_cirugia, ci.nombre_cirugia, ci.created_at
        FROM cm_cirugia ci
        WHERE ci.id_pet = ?)

        UNION ALL

        (SELECT i.id_pet, 'Inmunización' AS tipo_evento, i.nombre_vacuna, i.n_serie, i.created_at
        FROM cm_inmu i
        WHERE i.id_pet = ?)
        order by created_at DESC
    ";

    $eventos = DB::select(DB::raw($query), [$id, $id, $id, $id, $id]);

            $pets = CmnPet::findOrFail($id);
            //dd($pets);
            return view('pet.show2', compact('pets', 'eventos'));
    }



    public function getpet($id_dueno)
    {
        // Obtiene todas las mascotas asociadas al id_dueno proporcionado
        // $pets = CmnPet::where('id_dueno', $id_dueno)->get();
        // $pets='Echolas';

        try {
            $data = CmnPet::where('id_dueno', $id_dueno)->get();
            return $this->apiResponse(['status' => '1', 'data' => $data], 200);
        } catch (Exception $qx) {
            return $this->apiResponse(['status' => '403', 'data' => $qx], 400);
        }
        

        // Retorna la vista con las mascotas asociadas a ese dueño
        //return view('pet.pet', compact('pets'));
    }

    
    public function getpets()
    {
        // Obtiene todas las mascotas asociadas al id_dueno proporcionado
        // $pets = CmnPet::where('id_dueno', $id_dueno)->get();
        // $pets='Echolas';
        Log::info('Lllega ahsta la funcion');
        try {
            $data = CmnPet::all();
            return $this->apiResponse(['status' => '1', 'data' => $data], 200);
        } catch (Exception $qx) {
            return $this->apiResponse(['status' => '403', 'data' => $qx], 400);
        }
        

        // Retorna la vista con las mascotas asociadas a ese dueño
        //return view('pet.pet', compact('pets'));
    }

    public function getdet($id_pet)
    {
        // Obtiene todas las mascotas asociadas al id_dueno proporcionado
        // $pets = CmnPet::where('id_dueno', $id_dueno)->get();
        // $pets='Echolas';

        try {
            $data = CmnPet::where('id', $id_pet)->get();
            return $this->apiResponse(['status' => '1', 'data' => $data], 200);
        } catch (Exception $qx) {
            return $this->apiResponse(['status' => '403', 'data' => $qx], 400);
        }
        

        // Retorna la vista con las mascotas asociadas a ese dueño
        //return view('pet.pet', compact('pets'));
    }

    public function actualizar(Request $request)
{
    $antecedente = CmAntecedente::where('id_pet', $request->id_pet)->first();
    
    if ($antecedente) {
        $antecedente->update([
            $request->field => $request->value,
        ]);
        
        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false], 404);
}
public function petStore(Request $request)
{   //dd($request->all());
    // Validación de los datos del formulario
    Log::info('se valida lael id0');
    if ($request->tienepet == 0) {
        // Crear una nueva cita
        $cita = new CmnPet;
    } else {
        // Actualizar una cita existente
        // Asegúrate de que tienes un identificador único para buscar la cita existente
        $cita = CmnPet::findOrFail($request->idpelu);
    }
    Log::info('se valida la actializacion');
    // Asignar los valores del formulario a la cita
    $cita->id_dueno = $request->id_dueno;
    $cita->id  = $request->id_pet;
    $cita->nombre = $request->nombre;
    $cita->sexo = $request->sex;
    $cita->especie = $request->specie;

    $cita->updated_at = now();
    $cita->otro_esp = $request->otro_esp;
    $cita->color = $request->color;
    // $cita->anti_ex = $request->anti_ex;
    $cita->estado_repro = $request->state;
    Log::info('se guarda la cita');
    // Guardar la cita
    $cita->save();

    // Redireccionar con un mensaje de éxito
    return back()->with('success', $request->tienepet == 0 ? 'Consulta creada exitosamente' : 'Consulta actualizada exitosamente');
}



    public function customerStore(Request $data)
    {
        try {
            $validator = Validator::make($data->all(), [
                'full_name' => ['required', 'string'],
                'email' => ['required', 'string', 'unique:cmn_customers,email'],
                'phone_no' => ['required', 'string', 'unique:cmn_customers,phone_no', 'max:20'],
                'street_address' => ['required', 'string']
            ]);
            if (!$validator->fails()) {
                $data['user_id'] =  $data['user_id']=UtilityRepository::emptyToNull($data->user_id);               
                //create new user
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
                }

                $data['id'] = null;
                $data['created_at'] = auth()->id();
                $data['dob']=UtilityRepository::emptyToNull($data->dob);
                $rtr = CmnPet::create($data->all());
                return $this->apiResponse(['status' => '1', 'data' => ['cmn_customer_id' => $rtr->id]], 200);
            }
            return $this->apiResponse(['status' => '500', 'data' => $validator->errors()], 400);
        } catch (Exception $ex) {
            return $this->apiResponse(['status' => '501', 'data' => $ex], 400);
        }
    }

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
                CmnPet::where('id', $data->id)->update($data->toArray());
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
            $rtr = CmnPet::where('id', $data->id)->delete();
            return $this->apiResponse(['status' => '1', 'data' => $rtr], 200);
        } catch (Exception $ex) {
            return $this->apiResponse(['status' => '501', 'data' => $ex], 400);
        }
    }

    public function getAllCustomer()
    {
        try {
            $data = CmnPet::select(
                '*'
            )->get();
            return $this->apiResponse(['status' => '1', 'data' => $data], 200);
        } catch (Exception $qx) {
            return $this->apiResponse(['status' => '403', 'data' => $qx], 400);
        }
    }
}
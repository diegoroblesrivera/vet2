<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Repository\Booking\BookingRepository;
use App\Http\Repository\Dashboard\DashboardRepository;
use App\Models\Booking\SchServiceBooking;
use App\Models\Settings\CmnBranch;
use Carbon\Carbon;
use ErrorException;
use Exception;
use Illuminate\Http\Request;
use App\Models\Customer\CmnCustomer;
use App\Models\Customer\CmExamenes;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Mail\WelcomeUserMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;


class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    { 

        $examenes = CmExamenes::all();
        return view('dashboard.dashboard', compact('examenes'), ['tipoVista' => 'home']);
    }


    public function homeExpo()
    {
        return view('exploracion.exploracion', ['tipoVista' => 'home-expo']);
    }


    public function confirmaciones()
    {
        return view('exploracion.confirmaciones');
    }


    public function getDashboardCommonData()
    {
       try {
            $dashboardRepo = new DashboardRepository();
            $rtrData = [
                'bookingStatus' => $dashboardRepo->getBookingStatus(),
                'incomAndOtherStatistics' => $dashboardRepo->getIncomeAndOtherStatistics(),
                'topService' => $dashboardRepo->getTopServices()
            ];
            return $this->apiResponse(['status' => '1', 'data' => $rtrData], 200);
        } catch (Exception $ex) {
            return $this->apiResponse(['status' => '403', 'data' => $ex], 400);
        }
    }
    public function getBookingInfo(Request $request)
    {
        try {
            $dashboardRepo = new DashboardRepository();
            $rtrData = $dashboardRepo->getBookingInfo($request->serviceStatus, $request->duration);
            return $this->apiResponse(['status' => '1', 'data' => $rtrData], 200);
        } catch (Exception $ex) {
            return $this->apiResponse(['status' => '403', 'data' => $ex], 400);
        }
    }

    public function changeBookingStatus(Request $request)
    {
        $bookingId = $request->id; // Asegúrate de obtener este valor correctamente
        $booking = SchServiceBooking::find($bookingId);
        if (!$booking) {
            // Manejar el caso en que la cita no exista
            return;
        }
    
        $customerId = $booking->cmn_customer_id;
        $customer = CmnCustomer::find($customerId);
        if (!$customer) {
            // Manejar el caso en que el cliente no exista
            return;
        }
    
        $email = $customer->email;
        $name= $customer->full_name;
        //$username= $customer->email;
        if (!$email) {
            // Manejar el caso en que el cliente no tenga email
            return;
        }
    
        // Verificar si ya existe un usuario con el email
        $user = User::where('email', $email)->first();
    
        if (!$user) {
            // Crear el usuario si no existe
            $user = new User();
            $user->email = $email;
            $user->name = $name;
            $user->username = $email;
            $user->password = Hash::make(123456); // Generar una contraseña segura
            // Configurar cualquier otro campo requerido para tu modelo User
            $user->save();


            Mail::to($email)->send(new WelcomeUserMail($user));
    
            // Opcional: Enviar email al usuario con instrucciones para iniciar sesión
        }
        try {
            $bookingRepo = new BookingRepository();
            $rtrData = $bookingRepo->ChangeBookingStatusAndReturnBookingData($request->id,$request->status,1);
            return $this->apiResponse(['status' => '1', 'data' => $rtrData], 200);
        }catch (ErrorException $ex) {
            return $this->apiResponse(['status' => '-501', 'data' => $ex->getMessage()], 400);
        } catch (Exception $ex) {
            return $this->apiResponse(['status' => '501', 'data' => $ex], 400);
        }
    }


}

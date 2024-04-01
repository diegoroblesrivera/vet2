<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Pet\PetController;
use App\Models\Customer\CmnPet;
use App\Models\Customer\CmnCustomer;
use App\Http\Repository\Booking\BookingRepository;
use App\Http\Repository\Dashboard\DashboardRepository;
use App\Http\Repository\Pet\PetRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientPendingBookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function clientPendingBooking()
    {
      return view('site.client.client-pending-booking');
    }

    public function clientPetsListing()
    
    {

        $userId = Auth::id();

        // Buscar el cliente con el user_id del usuario logueado
        $cliente = CmnCustomer::where('user_id', $userId)->value('id');


        // Cargar las mascotas del usuario logueado
        $pets = CmnPet::where('id_dueno', $cliente)->get();
      return view('site.client.client-pending-booking', ['pets' => $pets], ['cliente' => $cliente]);
    }

    public function getPendingBooking()
    {
        try {
            $dashboardRepo = new PetRepository();
            $rtrData = $dashboardRepo->getPets(auth()->id());
            return $this->apiResponse(['status' => '1', 'data' => $rtrData], 200);
        } catch (Exception $ex) {


            return $this->apiResponse(['status' => '403', 'data' => $ex->getMessage()], 400);
        }
    }
}

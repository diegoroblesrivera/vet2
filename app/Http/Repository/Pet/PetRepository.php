<?php

namespace App\Http\Repository\Pet;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Pet\PetController;

use App\Models\User;
use App\Models\Customer\CmnPet;


class PetRepository
{

    /**
     * cancel booking with check is available to cancel
     * emailNotify=1 for send service notification by email otherwise not send email
     */
    public function getPets($user=null)
    {


            //SMS notification
            $updateStatus = CmnPet::all();
            $data = CmnPet::where('id_dueno', $user)->get();


            return $data;
    }


}

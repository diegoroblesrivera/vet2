<?php

namespace App\Http\Controllers\Site;
use App\Models\Employee\SchEmployee;
use App\Models\Employee\SchEmployeeOffday;
use App\Models\Employee\SchEmployeeSchedule;
use App\Models\Employee\SchEmployeeService;
use App\Models\Employee\SchSalary;
use App\Models\Customer\CmnPet;
use App\Models\Customer\CmnCustomer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebsiteBookingControllerr extends Controller
{
    public function appoinmentBooking(){
        $employees = $this->getEmployee();
        return view('site.booking', compact('employees'));
    }

    public function appoinmentBooking1(){
        $employees = $this->getEmployee();
        $userId = Auth::id();

        // Buscar el cliente con el user_id del usuario logueado
        $cliente = CmnCustomer::where('user_id', $userId)->value('id');


        // Cargar las mascotas del usuario logueado
        $pets = CmnPet::where('id_dueno', $cliente)->get();
        return view('site.booking1', compact('employees',  'pets'));
    }

    public function appoinmentBooking2(){
        $employees = $this->getEmployee();
        $userId = Auth::id();

        // Buscar el cliente con el user_id del usuario logueado
        $cliente = CmnCustomer::where('user_id', $userId)->value('id');


        // Cargar las mascotas del usuario logueado
        $pets = CmnPet::where('id_dueno', $cliente)->get();
        return view('site.booking1', compact('employees',  'pets'));
    }
    public function from(){
        $employees = $this->getEmployee();
        return view('site.from', compact('employees'));
    }

    public function getEmployee()
    { 
        try {
            $data = SchEmployee::join('cmn_branches', 'sch_employees.cmn_branch_id', '=', 'cmn_branches.id')->select(
                'sch_employees.id',
                'sch_employees.user_id',
                'sch_employees.image_url',
                'sch_employees.employee_id',
                'sch_employees.cmn_branch_id',
                'sch_employees.full_name',
                'sch_employees.email_address',
                'sch_employees.country_code',
                'sch_employees.contact_no',
                'sch_employees.present_address',
                'sch_employees.permanent_address',
                'sch_employees.gender',
                'sch_employees.dob',
                'sch_employees.hrm_department_id',
                'sch_employees.hrm_designation_id',
                'sch_employees.specialist',
                'sch_employees.note',
                'sch_employees.status',
                'cmn_branches.name as branch',
                'sch_employees.salary',
                'sch_employees.commission',
                'sch_employees.pay_commission_based_on',
                'sch_employees.target_service_amount',
                'sch_employees.id_card',
                'sch_employees.passport'
            )
            ->where('sch_employees.status', '=', 1)
            ->get();
            return $data;
                } catch (Exception $e) {
                    // Manejar la excepción como prefieras
                    return [];
                }
    }


}

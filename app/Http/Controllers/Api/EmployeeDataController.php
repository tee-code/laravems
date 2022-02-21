<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeStoreRequest;
use App\Models\Country;
use App\Models\Department;
use App\Models\Employee;
use App\Models\State;
use Illuminate\Http\Request;

class EmployeeDataController extends Controller
{

    public function countries(){

        $countries = Country::all();

        return response()->json($countries);
    }

    public function departments(){

        $departments = Department::all();

        return response()->json($departments);

    }

    public function states(Country $country){

        $states  = $country->states;

        return response()->json($states);

    }

    public function cities(State $state){

        $cities = $state->cities;

        return response()->json($cities);

    }


}

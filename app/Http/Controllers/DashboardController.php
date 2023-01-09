<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\CarModel;
use App\Models\Make;
use App\Models\City;
use App\Models\Country;
use App\Models\Port;
use App\Models\Driver;
use App\Models\Customer;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','permission:dashboard']);
    }
    
    public function index()
    {
        $customers = Customer::all()->count();
        $drivers = Driver::all()->count();
        $vehicles = Vehicle::all()->count();
        $delivered_vehicles = Vehicle:: where('status','Delivered')->get()->count();
        $data = Vehicle::join('makes','vehicles.make','=','makes.id')
           
            ->select('products.*','countrys.country','citys.city','car_models.model','makes.name','ports.port','customers.name AS customer_name','drivers.name AS driver_name')->get();

        return view('admin.index', get_defined_vars());
    }
}
